<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('user')
                ->orderBy('id', 'desc')
                ->paginate(10);
    }

    public function show($id)
    {
        return Post::where('id', $id)->with('user')->first();
    }

    public function store(PostRequest $request)
    {
        $user = Auth::user();
        if ($user->cant('create', Post::class)) {
            return abort(401);
        }

        $post = $user->posts()->create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return response()->json($post, 201);
    }

    public function update(PostRequest $request, Post $post)
    {
        if (Auth::user()->cant('updateAndDelete', $post)) {
            return abort(401);
        }

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return response()->json($post, 200);
    }

    public function delete(Post $post)
    {
        if (Auth::user()->cant('updateAndDelete', $post)) {
            return abort(401);
        }

        $post = $post->delete();

        return response()->json($post, 200);
    }
}
