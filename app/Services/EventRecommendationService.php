<?php

namespace App\Services;

use Phpml\Classification\RandomForest;
use Phpml\ModelManager;
use App\Models\Booking;
use App\Models\Event;
use App\Models\favorite;
use Phpml\Classification\Ensemble\RandomForest as EnsembleRandomForest;

class EventRecommendationService
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->loadModel();
    }

    public function trainModel()
    {
        $samples = [];
        $labels = [];

        // جمع البيانات من الحجوزات والأحداث
        $bookings = Booking::with('event', 'user')->get();

        foreach ($bookings as $booking) {
            $event = $booking->event;
            // جمع ميزات متعددة مثل الفئة والموقع والتاريخ والسعر والشعبية وعمر المستخدم
            $samples[] = [
                $event->category,          // فئة الحدث
                $event->price,             // سعر الحدث
            ];
            // الحصول على الفئات المقترحة
            $relatedCategories = $this->getSuggestedCategories($event->category);
            $labels[] = $relatedCategories[0] ?? 'other';  // استخدام أول فئة مقترحة كتصنيف
        }

        // تقسيم البيانات إلى 80% للتدريب و 20% للاختبار
        $trainSize = floor(0.8 * count($samples));
        $trainSamples = array_slice($samples, 0, $trainSize);
        $trainLabels = array_slice($labels, 0, $trainSize);
        $testSamples = array_slice($samples, $trainSize);
        $testLabels = array_slice($labels, $trainSize);

        // تدريب النموذج باستخدام RandomForest
        $randomForest = new EnsembleRandomForest(200); // زيادة عدد الأشجار لتحسين الأداء
        $randomForest->train($trainSamples, $trainLabels);

        // اختبار النموذج باستخدام مجموعة الاختبار
        $predictions = $randomForest->predict($testSamples);

        // حساب الدقة باستخدام مجموعة الاختبار
        $correct = 0;
        for ($i = 0; $i < count($testLabels); $i++) {
            if ($testLabels[$i] == $predictions[$i]) {
                $correct++;
            }
        }

        $accuracy = $correct / count($testLabels);
        echo "Model Accuracy: " . ($accuracy * 100) . "%";
        // حفظ النموذج المدرب
        $modelManager = new ModelManager();
        $modelManager->saveToFile($randomForest, storage_path('app/event_recommendation_model.phpml'));
        echo "Model trained and saved successfully.";
    }


    public function suggestEvents($userId)
    {
        // استرجاع الأحداث المحجوزة والمفضلة للمستخدم
        $userBookings = Booking::with('event')->where('user_id', $userId)->get();
        $userFavorites = favorite::with('event')->where('user_id', $userId)->get();

        if ($userBookings->isEmpty() && $userFavorites->isEmpty()) {
            // إذا لم يكن لدى المستخدم حجوزات أو مفضلات، تقديم أحداث عشوائية
            $suggestedEvents = Event::inRandomOrder()->take(3)->get();
            return $suggestedEvents;
        }

        $suggestedEvents = [];

        // إعطاء الأولوية للأحداث المفضلة في التنبؤات
        foreach ($userFavorites as $favorite) {
            $predictedCategories = $this->model->predict([$favorite->event->category]);

            if (isset($predictedCategories[0])) {
                $suggestedCategories = $this->getSuggestedCategories($favorite->event->category);
                foreach ($suggestedCategories as $category) {
                    $randomEvent = Event::where('category', $category)->inRandomOrder()->first();
                    if ($randomEvent) {
                        $suggestedEvents[] = $randomEvent;
                    }
                }
            }
        }

        // إضافة تنبؤات بناءً على الحجوزات السابقة أيضًا
        foreach ($userBookings as $booking) {
            $predictedCategories = $this->model->predict([$booking->event->category]);

            if (isset($predictedCategories[0])) {
                $suggestedCategories = $this->getSuggestedCategories($booking->event->category);
                foreach ($suggestedCategories as $category) {
                    $randomEvent = Event::where('category', $category)->inRandomOrder()->first();
                    if ($randomEvent) {
                        $suggestedEvents[] = $randomEvent;
                    }
                }
            }
        }

        return $suggestedEvents;
    }


    protected function loadModel()
    {

        $modelPath = storage_path('app/event_recommendation_model.phpml');
        if (file_exists($modelPath)) {
            $modelManager = new ModelManager();
            return $modelManager->restoreFromFile($modelPath);
        } else {
            throw new \Exception('Model file not found. Please train the model first.');
        }
    }
    protected function getSuggestedCategories($category)
    {

        // Define rules for related categories with multiple suggestions
        $relatedCategories = [
            'Salon' => ['makeup', 'hair care', 'nail art', 'skin care', 'spa services'],
            'restaurant' => ['food delivery', 'catering', 'event planning', 'dining experiences'],
            'skin care' => ['makeup', 'spa', 'wellness', 'facials', 'beauty treatments'],
            'makeup' => ['skin care', 'beauty products', 'cosmetics', 'makeup classes', 'bridal makeup'],
            'clothes' => ['accessories', 'shoes', 'fashion', 'styling services', 'personal shopping'],
            'photography' => ['videography', 'photo booth', 'event coverage', 'family portraits', 'wedding photography'],
            'fitness' => ['yoga', 'nutrition', 'personal training', 'fitness classes', 'wellness retreats'],
            'wellness' => ['spa', 'meditation', 'aromatherapy', 'holistic therapies', 'nutrition coaching'],
            'accessories' => ['jewelry', 'bags', 'hats', 'fashion accessories', 'footwear', 'other'],
            'catering' => ['event planning', 'restaurant', 'bakery', 'food tasting', 'cooking classes'],
            'Entertainment ' => ['catering', 'venues', 'decor', 'party supplies'],
            'baking' => ['cooking classes', 'catering', 'dessert bars', 'baking supplies', 'cake decorating'],
            'music' => ['concerts', 'live performances', 'music lessons', 'DJ services', 'karaoke nights'],
            'art' => ['exhibitions', 'workshops', 'craft fairs', 'art supplies', 'art classes'],
            'floral' => ['event decor', 'wedding planning', 'gifts', 'floral arrangements', 'bouquets'],
            'travel' => ['tours', 'hotel bookings', 'travel packages', 'local experiences', 'adventure trips'],
            'technology' => ['IT services', 'software development', 'tech workshops', 'digital marketing', 'gadgets'],
            'education' => ['tutoring', 'online courses', 'workshops', 'educational materials', 'study groups'],
            'home services' => ['cleaning', 'landscaping', 'renovation', 'interior design', 'handyman services'],
            // Add more categories as needed
        ];

        foreach ($relatedCategories as $key => $values) {
            if (in_array($category, $values)) {
                // If found, return all related categories (the key and values)
                return array_merge([$key], $values);
            }
        }

        // If not found, return an empty array
        return [];
    }
}
