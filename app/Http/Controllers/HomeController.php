<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        $featuredProducts = Product::with('category')
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $latestPosts = Post::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $testimonials = Testimonial::visible()
            ->latest()
            ->take(6)
            ->get();

        $settings = Schema::hasTable('settings')
            ? Setting::pluck('value', 'key')->all()
            : [];

        return view('home', compact('categories', 'featuredProducts', 'latestPosts', 'testimonials', 'settings'));
    }

    public function about()
    {
        $settings = Schema::hasTable('settings')
            ? Setting::pluck('value', 'key')->all()
            : [];

        $featuredProducts = Product::with('category')
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        return view('about', compact('settings', 'featuredProducts'));
    }
}


