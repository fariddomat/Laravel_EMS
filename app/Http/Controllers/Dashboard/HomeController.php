<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Course;
use App\Models\order;
use App\Models\Property;
use App\Models\Train;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function contact()
    {
        $contacts = Contact::all();
        return view('dashboard.contact', compact('contacts'));
    }

    public function statistics()
    {
        $totalUsers = User::count();
        $totalProperties = Property::count();
        $totalOrders = order::count();
        $activeUsers = User::where('status', 'active')->count();
        $inactiveUsers = User::where('status', 'inactive')->count();


        return view('dashboard.statistics.index', compact('totalUsers', 'totalProperties', 'totalOrders', 'activeUsers', 'inactiveUsers'));
    }

}
