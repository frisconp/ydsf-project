<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return $this->sendResponse($posts, 'Berhasil mendapatkan data artikel.');
    }

    public function show(Post $post)
    {
        if (empty($post)) {
            return $this->sendError('Artikel tidak ditemukan.');
        }

        return $this->sendResponse($post, 'Berhasil mendapatkan detail artikel.');
    }
}
