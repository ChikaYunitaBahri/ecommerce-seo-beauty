<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        $totalProducts = Product::count();
        $cartItems = [];

        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        }

        return view('home', compact('products', 'cartItems', 'totalProducts'));
    }
}
