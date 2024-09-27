<?php

namespace App\Services;

use Phpml\Classification\RandomForest;
use Phpml\ModelManager;
use App\Models\Booking;
use App\Models\Event;
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

    // Gather training data from bookings and events
    $bookings = Booking::with('event')->get();

    foreach ($bookings as $booking) {
        $samples[] = [$booking->event->category]; // Use the event's category as a feature
        // Get suggested categories (make sure to extract just one category for simplicity)
        $relatedCategories = $this->getSuggestedCategories($booking->event->category);
        $labels[] = $relatedCategories[0] ?? 'other'; // Use the first related category as a label
    }

    // Train the model
    $randomForest = new EnsembleRandomForest(100);
    $randomForest->train($samples, $labels);

    // Save the trained model
    $modelManager = new ModelManager();
    $modelManager->saveToFile($randomForest, storage_path('app/event_recommendation_model.phpml'));
}

public function suggestEvents($userId)
{
    $userBookings = Booking::with('event')->where('user_id', $userId)->get();
    if ($userBookings->isEmpty()) {
        return ['message' => 'No bookings found for this user.'];
    }
    $suggestions = [];
    foreach ($userBookings as $booking) {
        $predictedCategories = $this->model->predict([$booking->event->category]);

        // Ensure predictions are valid before proceeding
        if (isset($predictedCategories[0])) {
            $suggestions = array_merge($suggestions, $this->getSuggestedCategories($booking->event->category));
        }
    }
    return $suggestions;
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
