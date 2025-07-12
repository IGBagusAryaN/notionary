<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $search = $request->query('search');
        $user = $request->query('user');

        $posts = $this->postService->getPosts(10, $page, $search, $user);

        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        $comments = $this->postService->getCommentsByPost($id);

        return view('posts.show', compact('post', 'comments'));
    }

    public function create()
    {
        return view('posts.form', ['post' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $validated['userId'] = 1;

        $response = Http::post('https://jsonplaceholder.typicode.com/posts', $validated);

        if ($response->successful()) {
            notify()->success('Successfully added post!');
            return redirect()->route('home');
        }

        return back()->withErrors('Failed to create post.')->withInput();
    }

    public function edit($id)
    {
        $post = $this->postService->getPostById($id);
        return view('posts.form', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $this->postService->updatePost($id, $data);

        notify()->success('Post updated successfully!');

        return redirect()->route('posts.show', $id);
    }

    public function destroy($id)
    {
        $response = Http::delete("https://jsonplaceholder.typicode.com/posts/{$id}");

        if ($response->successful()) {
            notify()->success('Post deleted successfully!', 'Success');
        } else {
            notify()->error('Failed to delete the post.', 'Error');
        }


        return redirect()->route('home');
    }

    public function favorites(Request $request)
    {
        $favoriteIds = json_decode($request->cookie('favorite_posts'), true) ?? [];

        $posts = collect();

        foreach ($favoriteIds as $id) {
            $response = Http::get("https://jsonplaceholder.typicode.com/posts/{$id}");
            if ($response->successful()) {
                $posts->push($response->json());
            }
        }

        return view('posts.favorites', compact('posts'));
    }
}
