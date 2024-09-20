<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Add this line

class PostController extends Controller
{   
    //=================listing of posts =================//
    public function index()
    {
        // Retrieve all posts
        $posts = Post::where('status', false)->latest()->get();
        $posts = PostResource::collection($posts);
        // Return posts as a JSON response
        return response()->json(['success' => true, 'data' => $posts]);
    }

    //=====================Create posts=====================//
    public function store(PostRequest $request)
    {
        Post::store($request);
        return response()->json(['success' => true, 'message' => "Post created successfully"], 201);
    }

    //====================Update psots =================//
    public function update(PostRequest $request, $id)
    {

        Post::store($request, $id);
        return response()->json(['success'=>true, 'message' => 'Post updated successfully'], 200);
    }

    //====================Show specific posts =================//
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json(['success' => true, 'data' => $post]);
    }



    //===================Remove posts =================//
    public function destroy($id)
    {
        // Find the post by ID
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        // Delete the logo file if exists
        if ($post->logo && Storage::exists('public/' . $post->logo)) {
            Storage::delete('public/' . $post->logo);
        }

        // Delete the post
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }

    //====================Update post status =================//
    public function updatePostStatus($id)
    {
        $post = Post::find($id);
        $post->status = true;
        $post->save();
        return response()->json(['message' => 'Post status updated successfully'], 200);
    }
}
