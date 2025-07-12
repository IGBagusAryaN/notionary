<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->query('user', 1);
        $page = $request->query('page', 1);
        $perPage = 6;
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        if (!$response->successful()) {
            abort(500, 'Failed to fetch posts');
        }

        $posts = collect($response->json())->where('userId', $userId)->values();

        $userResponse = Http::get("https://jsonplaceholder.typicode.com/users/{$userId}");

        if (!$userResponse->successful()) {
            abort(500, 'Failed to fetch user');
        }

        $user = $userResponse->json(); 

        $paginated = new LengthAwarePaginator(
            $posts->forPage($page, $perPage),
            $posts->count(),
            $perPage,
            $page,
            ['path' => url('/'), 'query' => $request->query()]
        );

        return view('home', [
            'posts' => $paginated,
            'userId' => $userId,
            'user' => $user, 
        ]);
    }
}
