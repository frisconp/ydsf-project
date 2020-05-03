<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    //

    public function index()
    {
        $title = 'Post';
        $posts = Post::all();

        return view('pages.post.index', compact('title', 'posts'));
    }

    public function create()
    {
        $title = 'Buat Post';

        return view('pages.post.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'featured_image.required' => 'Harap pilih gambar untuk post ini.',
            'featured_image.image' => 'Format gambar yang diterima: JPG/PNG.',
            'title.required' => 'Judul post tidak boleh kosong.',
            'slug.required' => 'Slug tidak boleh kosong.',
            'short_description.required' => 'Deskripsi post tidak boleh kosong.',
            'content.required' => 'Content untuk post tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
            'featured_image' => ['required', 'image'],
            'title' => ['required'],
            'slug' => ['required'],
            'short_description' => ['required'],
            'content' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('post.index')->withErrors($validator)->withInput();
        }

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->short_description = $request->short_description;
        $post->content = $request->content;
        $post->featured_image = $request->file('featured_image')->store('posts');
        $post->admin_id = Auth::guard('admin')->user()->id;
        $post->save();

        return redirect()->route('post.index')->with('success', 'Berhasil menambahkan post baru.');
    }

    public function show(Post $post)
    {
        $title = 'Detail Post';
        return view('pages.post.show', compact('title', 'post'));
    }

    public function edit(Post $post)
    {
        $title = 'Edit Post';
        return view('pages.post.edit', compact('title', 'post'));
    }

    public function update(Request $request, Post $post)
    {
        $messages = [
            'featured_image.image' => 'Harap pilih gambar untuk post ini.',
            'featured_image.image' => 'Format gambar yang diterima: JPG/PNG.',
            'title.required' => 'Judul post tidak boleh kosong.',
            'slug.required' => 'Slug tidak boleh kosong.',
            'short_description.required' => 'Deskripsi post tidak boleh kosong.',
            'content.required' => 'Content untuk post tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
            'featured_image' => ['nullable', 'image'],
            'title' => ['required'],
            'slug' => ['required'],
            'short_description' => ['required'],
            'content' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('post.edit', $post->id)->withErrors($validator)->withInput();
        }

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->short_description = $request->short_description;
        $post->content = $request->content;
       
        if ($request->file('featured_image')) {
            $post->featured_image = $request->file('featured_image')->store('posts');
        }
        $post->admin_id = Auth::guard('admin')->user()->id;
        $post->save();

        return redirect()->route('post.index')->with('success', 'Berhasil Memperbarui Post.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $postTitle = $post->title;
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Berhasil menghapus post '.$postTitle.'.');
    }
}
