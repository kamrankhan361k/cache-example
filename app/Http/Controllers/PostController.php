<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
class PostController extends Controller
{
    public function index()
    {
        // Cache key
        $cacheKey = 'posts';

        // Check if the cache exists
        $posts = Cache::remember($cacheKey, 60, function () {
            // If not cached, retrieve data from the database
            return Post::all();
        });

        return response()->json($posts);
    }

    // Clear the cache
    public function clearCache()
    {
        Cache::forget('posts');
        return response()->json(['message' => 'Cache cleared!']);
    }

}
