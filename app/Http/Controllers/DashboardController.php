<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Daily;
use App\Models\Exclusivity;
use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index() 
    {
        $articles = Article::where('type', 'ARTICLE')->count();
        $podcasts = Article::where('type', 'PODCAST')->count();
        $dailies = Daily::count();
        $questions = Question::count();
        $exclusivities = Exclusivity::count();

        $banners = Banner::count();
        $categories = Category::count();
        return view('dashboard', compact('articles', 'podcasts', 'dailies', 'banners', 'categories', 'questions', 'exclusivities'));
    }
}
