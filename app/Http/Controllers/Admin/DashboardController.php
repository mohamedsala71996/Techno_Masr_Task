<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SiteVisitor;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();
        $totalUsers = User::count();
        $joinedThisMonth = User::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();
        $joinedThisYear = User::whereYear('created_at', $now->year)->count();
        $activeThisMonth = User::whereYear('updated_at', $now->year)
            ->whereMonth('updated_at', $now->month)
            ->count();

        // Unique site visitors
        $uniqueVisitors = SiteVisitor::distinct('ip_address')->count('ip_address');

        // Posts
        $totalPosts = Post::count();
        $postsThisMonth = Post::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        // Categories with post count
        $categories = Category::withCount('posts')->get();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'joinedThisMonth',
            'joinedThisYear',
            'activeThisMonth',
            'uniqueVisitors',
            'totalPosts',
            'postsThisMonth',
            'categories',
        ));
    }
}
