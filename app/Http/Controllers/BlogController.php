<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\BlogCreatedEvent;
use App\Events\BlogDeletedEvent;
use App\Events\BlogUpdatedEvent;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $blogs = Blog::latest()->get();

        return view('blog', compact('blogs', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $user = $request->user();
        $blog = $user->blogs()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        event(new BlogCreatedEvent($blog));

        return redirect()->back()->with('success', 'Blog created successfully');
    }

    public function update(Blog $blog, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $user = $request->user();

        if ($user->id !== $blog->user_id) redirect()->back()->with('error', 'You are not authorized to update this blog');

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        event(new BlogUpdatedEvent($blog));
        return redirect()->back()->with('success', 'Blog updated successfully');
    }


    public function destroy(Blog $blog, Request $request)
    {
        $user = $request->user();
        if ($user->id !== $blog->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this blog');
        }

        $blog->delete();
        event(new BlogDeletedEvent($blog->id));
        return redirect()->back()->with('success', 'Blog deleted successfully');
    }
}
