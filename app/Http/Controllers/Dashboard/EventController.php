<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * عرض قائمة الأحداث.
     */
    public function index()
    {
        $events = Event::all();
        return view('dashboard.events.index', compact('events'));
    }

    /**
     * عرض صفحة إنشاء حدث جديد.
     */
    public function create()
    {
        return view('dashboard.events.create');
    }

    /**
     * تخزين حدث جديد في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'images' => 'nullable|array',
            'videos' => 'nullable|array',
        ]);

        $images = $request->file('images');
        $videos = $request->file('videos');

        // تخزين الصور والفيديوهات باستخدام ImageHelper أو طريقة خاصة بك
        if ($request->has('images')) {
            $imageHelper = new ImageHelper;
            $imagePaths = [];
            foreach ($images as $image) {
                $imagePaths[] = $imageHelper->storeImageInPublicDirectory($image, '/uploads/events/images', 600, 400);
            }
        }

        if ($request->has('videos')) {
            $videoPaths = [];
            foreach ($videos as $video) {
                $videoPaths[] = $video->store('/uploads/events/videos', 'public');
            }
        }

        // إنشاء الحدث وتخزين بيانات الصور والفيديوهات
        $event = Event::create($request->except(['images', 'videos']));
        $event->images = $imagePaths ?? [];
        $event->videos = $videoPaths ?? [];
        $event->save();

        return redirect()->route('dashboard.events.index');
    }

    /**
     * عرض صفحة تعديل الحدث.
     */
    public function edit(Event $event)
    {
        return view('dashboard.events.edit', compact('event'));
    }

    /**
     * تحديث بيانات الحدث في قاعدة البيانات.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'images' => 'nullable|array',
            'videos' => 'nullable|array',
        ]);

        // معالجة الصور والفيديوهات إذا تم تحميل أي منها
        if ($request->has('images')) {
            $imageHelper = new ImageHelper;
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $imageHelper->storeImageInPublicDirectory($image, '/uploads/events/images', 600, 400);
            }
            $event->images = $imagePaths;
        }

        if ($request->has('videos')) {
            $videoPaths = [];
            foreach ($request->file('videos') as $video) {
                $videoPaths[] = $video->store('/uploads/events/videos', 'public');
            }
            $event->videos = $videoPaths;
        }

        $event->update($request->except(['images', 'videos']));
        $event->save();

        return redirect()->route('dashboard.events.index');
    }

    /**
     * حذف حدث من قاعدة البيانات.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('dashboard.events.index');
    }
}
