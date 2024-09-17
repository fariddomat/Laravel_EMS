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
        $companies = Company::all();
        return view('dashboard.companies.index', compact('companies'));
    }

    /**
     * عرض صفحة إنشاء شركة جديدة.
     */
    public function create()
    {
        $users=User::all();
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
            foreach ($videos as $video) {
                $videoPaths[] = $video->store('/uploads/companies/videos', 'public');
            }
        }

        // إنشاء الشركة وتخزين بيانات الصور والفيديوهات
        $company = Company::create($request->except(['images', 'videos']));
        $company->images = $imagePaths ?? [];
        $company->videos = $videoPaths ?? [];
        $company->save();

        return redirect()->route('dashboard.companies.index');
    }

    /**
     * عرض صفحة تعديل الشركة.
     */
    public function edit(Company $company)
    {
        $users=User::all();
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

        // معالجة الصور والفيديوهات إذا تم تحميل أي منها
        if ($request->has('images')) {
            $imageHelper = new ImageHelper;
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $imageHelper->storeImageInPublicDirectory($image, '/uploads/companies/images', 600, 400);
            }
            $company->images = $imagePaths;
        }

        if ($request->has('videos')) {
            $videoPaths = [];
            foreach ($request->file('videos') as $video) {
                $videoPaths[] = $video->store('/uploads/companies/videos', 'public');
            }
            $company->videos = $videoPaths;
        }

        $company->update($request->except(['images', 'videos']));
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
