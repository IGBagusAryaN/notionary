<?php
namespace App\Http\Controllers;

use App\Services\PostService;

class UserController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function show($id)
    {
        $user = $this->postService->getUserById($id);
        $posts = $this->postService->getPostsByUser($id);

        return view('users.show', compact('user', 'posts'));
    }
}
