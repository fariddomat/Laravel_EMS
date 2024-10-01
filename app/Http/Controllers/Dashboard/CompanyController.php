<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * عرض قائمة الشركات.
     */
    public function index()
    {
        // Check if the user has the 'owner' role
        if (auth()->user()->hasRole('company')) {
            // Get only the companies owned by the authenticated user
            $companies = auth()->user()->companies;
        } else {
            // For other roles, return all companies
            $companies = Company::all();
        }

        return view('dashboard.companies.index', compact('companies'));
    }


    /**
     * عرض صفحة إنشاء شركة جديدة.
     */
    public function create()
    {
        $users = User::all();
        return view('dashboard.companies.create', compact('users'));
    }

    /**
     * تخزين شركة جديدة في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'images' => 'required',
            'videos' => 'nullable',
            'roles' => 'required',
            'type' => 'required|in:person,website'
        ]);

        $images = $request->file('images');
        $videos = $request->file('videos');

        // $coverPath
        if ($request->has('cover')) {
            $imageHelper = new ImageHelper;
            $image = $request->file('cover');
            $coverPath = '';
            $coverPath = $imageHelper->storeImageInPublicDirectory($image, '/uploads/companies/images', 600, 400);
        }
        // تخزين الصور والفيديوهات باستخدام ImageHelper أو طريقة خاصة بك
        if ($request->has('images')) {
            $imageHelper = new ImageHelper;
            $imagePaths = [];
            foreach ($images as $image) {
                $imagePaths[] = $imageHelper->storeImageInPublicDirectory($image, '/uploads/companies/images', 600, 400);
            }
        }

        if ($request->has('videos')) {
            $videoPaths = [];
            foreach ($request->file('videos') as $index => $video) {
                // Define the path where you want to save the video (in public folder)
                $destinationPath = public_path('uploads/companies/videos');

                // Ensure the directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Define a unique file name for each video
                $videoName = time() . '_' . $index . '.' . $video->getClientOriginalExtension();

                // Move the file to the public folder
                $video->move($destinationPath, $videoName);

                // Save the video path relative to the public folder
                $videoPaths[$index] = 'uploads/companies/videos/' . $videoName;
            }

        }

        // إنشاء الشركة وتخزين بيانات الصور والفيديوهات
        $company = Company::create($request->except(['images', 'videos']));
        $company->cover = $coverPath ?? '';
        $company->images = $imagePaths ?? [];
        $company->videos = json_encode($videoPaths) ?? [];
        $company->save();

        return redirect()->route('dashboard.companies.index');
    }

    /**
     * عرض صفحة تعديل الشركة.
     */
    public function edit(Company $company)
    {
        $users = User::all();
        return view('dashboard.companies.edit', compact('company', 'users'));
    }

    /**
     * تحديث بيانات الشركة في قاعدة البيانات.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'images' => 'nullable',
            'videos' => 'nullable',
            'roles' => 'required',
            'type' => 'required|in:person,website'
        ]);

        // $coverPath
        if ($request->has('cover')) {
            $imageHelper = new ImageHelper;
            $image = $request->file('cover');
            $coverPath = '';
            $coverPath = $imageHelper->storeImageInPublicDirectory($image, '/uploads/companies/images', 600, 400);
            $company->cover = $coverPath;
        }
        // معالجة الصور والفيديوهات إذا تم تحميل أي منها
        if ($request->has('images')) {
            $imageHelper = new ImageHelper;
            $imagePaths = [];
            foreach ($request->file('images') as $index=>$image) {
                $imagePaths[$index] = $imageHelper->storeImageInPublicDirectory($image, '/uploads/companies/images', 600, 400);
            }
            $company->images = $imagePaths;
        }

        if ($request->has('videos')) {
            $videoPaths = [];
            foreach ($request->file('videos') as $index => $video) {
                // Define the path where you want to save the video (in public folder)
                $destinationPath = public_path('uploads/companies/videos');

                // Ensure the directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Define a unique file name for each video
                $videoName = time() . '_' . $index . '.' . $video->getClientOriginalExtension();

                // Move the file to the public folder
                $video->move($destinationPath, $videoName);

                // Save the video path relative to the public folder
                $videoPaths[$index] = 'uploads/companies/videos/' . $videoName;
            }

            // Store the paths in the database
            $company->videos = json_encode($videoPaths);
        }


        $company->update($request->except(['images', 'videos', 'cover']));

        $company->save();

        return redirect()->route('dashboard.companies.index');
    }

    /**
     * حذف شركة من قاعدة البيانات.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('dashboard.companies.index');
    }
}
