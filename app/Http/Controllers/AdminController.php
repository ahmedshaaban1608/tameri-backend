<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Tourist;
use App\Models\Order;
use App\Models\Review;
use App\Models\Tourguide;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Dashboard.admin', ['users' => $users]);
    }

    public function showUsers()
    {
        $users = User::all();
        return view('Dashboard.admin', ['users' => $users]);
    }

    public function showTourists()
    {
        $tourists = Tourist::all();
        return view('Dashboard.admin', ['tourists' => $tourists]);
    }
    public function showOrders()
    {
        $orders = Order::all();
        return view('Dashboard.admin', ['orders' => $orders]);
    }
 
    public function showReviews()
    {
    $reviews = Review::all();
    return view('Dashboard.admin', ['reviews' => $reviews]);
    }

    public function showTourguides()
    {
    $tourguides = Tourguide::all();
    return view('Dashboard.admin', ['tourguides' => $tourguides]);
    }

}