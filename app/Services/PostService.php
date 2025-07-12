<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PostService
{
    protected $baseUrl = 'https://jsonplaceholder.typicode.com';


public function getPosts($perPage = 10, $page = 1, $search = null, $user = null)
{
    $response = Http::get('https://jsonplaceholder.typicode.com/posts');

    if (!$response->successful()) {
        return new LengthAwarePaginator([], 0, $perPage, $page);
    }

    $posts = collect($response->json());

    // Filter by search
    if ($search) {
        $posts = $posts->filter(function ($post) use ($search) {
            return str_contains(strtolower($post['title']), strtolower($search)) ||
                   str_contains(strtolower($post['body']), strtolower($search));
        });
    }

    // Optional: filter by user (kalau masih dipakai)
    if ($user) {
        $posts = $posts->where('userId', $user);
    }

    $filtered = $posts->values(); // reset keys

    return new LengthAwarePaginator(
        $filtered->forPage($page, $perPage),
        $filtered->count(),
        $perPage,
        $page,
        ['path' => url()->current(), 'query' => request()->query()]
    );
}
    public function getPostById($id)
    {
        return Cache::remember("post-{$id}", 60, function () use ($id) {
            $response = Http::get("{$this->baseUrl}/posts/{$id}");
            if ($response->failed()) abort(404, 'Post not found');
            return $response->json();
        });
    }

    public function getCommentsByPost($postId)
    {
        return Cache::remember("comments-post-{$postId}", 60, function () use ($postId) {
            $response = Http::get("{$this->baseUrl}/posts/{$postId}/comments");
            if ($response->failed()) return [];
            return $response->json();
        });
    }

    public function getUserById($id)
    {
        return Cache::remember("user-{$id}", 60, function () use ($id) {
            $response = Http::get("{$this->baseUrl}/users/{$id}");
            if ($response->failed()) abort(404, 'User not found');
            return $response->json();
        });
    }

    public function getPostsByUser($userId)
    {
        return Cache::remember("user-posts-{$userId}", 60, function () use ($userId) {
            $response = Http::get("{$this->baseUrl}/posts", [
                'userId' => $userId
            ]);

            if ($response->failed()) return [];
            return $response->json();
        });
    }
    public function createPost($data)
    {
        $response = Http::post("{$this->baseUrl}/posts", $data);
        if ($response->failed()) abort(500, 'Failed to create post');
        return $response->json();
    }

    public function updatePost($id, $data)
    {
        $response = Http::put("{$this->baseUrl}/posts/{$id}", $data);
        if ($response->failed()) abort(500, 'Failed to update post');
        return $response->json();
    }

    public function deletePost($id)
    {
        return Http::delete("https://jsonplaceholder.typicode.com/posts/{$id}");
    }
}
