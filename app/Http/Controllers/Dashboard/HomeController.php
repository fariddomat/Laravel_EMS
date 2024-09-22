<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Event;
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
        $activeUsers = User::where('status', 'active')->count();
        $inactiveUsers = User::where('status', 'inactive')->count();
        $companies = Company::count();
        $events = Event::count();
        $bookings = Booking::count();


        return view('dashboard.statistics.index', compact('totalUsers', 'activeUsers', 'inactiveUsers', 'companies', 'events','bookings'));
    }

}
