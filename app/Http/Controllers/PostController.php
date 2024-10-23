<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    /**
     * Display a search.
    */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::with(['user', 'category'])->where('title', 'like', '%'.$query.'%')
                     ->orWhere('content', 'like', '%'.$query.'%')
                     ->latest()
                     ->paginate(20); 

                     return inertia('Posts/Index', ['posts' => $posts]);
    }

    /**
     * Display a search by Date.
    */

    public function searchByDate(Request $request)
    {
        $date = $request->input('date');

        $posts = Post::with(['user', 'category'])->whereDate('created_at', $date)->latest()->paginate(20);

        $posts->appends(['date' => $date]);

        return inertia('Posts/Index', ['posts' => $posts]);
    }


    /**
     * Display a listing of the resource by category.
    */

    public function postsByCategory(Category $category)
    {
        
        $posts = Post::with(['user', 'category'])
            ->where('category_id', $category->id)->latest()
            ->paginate(20); 

        return inertia('Posts/Index', [
            'posts' => $posts, 
            'category' => $category->title, 
        ]);
    }

    /**
     * Display a listing of the resource by user.
    */

    public function postsByUser(User $user)
    {
        $posts = Post::with(['category', 'user'])
            ->where('user_id', $user->id)->latest()
            ->paginate(20);

        return inertia('Posts/Index', [
            'posts' => $posts, 
            'user' => $user->name, 
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'category'])->latest()->paginate(20);
        // $posts = Post::latest()
        //             ->paginate(3);
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        
        return Inertia::render('Posts/Create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nulable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->input('category_id');
        $post->title = $request->title;
        $post->content = $request->content;
    
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['category', 'user']);
        return Inertia::render('Posts/Show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::all();

        return Inertia::render('Posts/Edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->authorize('update', $post);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->input('category_id');
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();
        return redirect()->route('posts.index');
    }
}
