<?php

namespace App\Http\Controllers;

use App\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Majalah';
        $ebooks = Ebook::all();

        return view('pages.ebook.index', compact('title', 'ebooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Unggah Majalah/Ebook';

        return view('pages.ebook.create', compact('title'));
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
            'title.required' => 'Judul majalah tidak boleh kosong.',
            'description.required' => 'Deskripsi majalah tidak boleh kosong.',
            'edition.required' => 'Edisi Majalah tidak boleh kosong',
            'publication_year.required' => 'Tahun Terbit tidak boleh kosong',
            'thumbnail.required' => 'Harap pilih gambar untuk post ini.',
            'thumbnail.image' => 'Format gambar yang diterima: JPG/PNG.',
            'file.required' => 'File Ebook harus dipilih terlebih dahulu.',
            'file.file' => 'File Ebook tidah valid.',
            'file.mimes' => 'File Ebook harus dalam format PDF, DOC, atau DOCX.',
        ];

        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required'],
            'edition' => ['required'],
            'publication_year' => ['required'],
            'thumbnail' => ['required', 'image'],
            'file' => ['required', 'file', 'mimes:pdf,docx,doc'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('ebook.create')->withErrors($validator)->withInput();
        }

        $ebook = new Ebook();
        $ebook->title = $request->title;
        $ebook->description = $request->description;
        $ebook->edition = $request->edition;
        $ebook->publication_year = $request->publication_year;
        $ebook->thumbnail = $request->file('thumbnail')->store('ebooks');
        $ebook->file = $request->file('file')->store('ebooks');
        $ebook->admin_id = Auth::guard('admin')->user()->id;
        $ebook->save();

        return redirect()->route('ebook.index')->with('success', 'Berhasil mengunggah majalah baru.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Ebook $ebook)
    {
        $title = 'Detail Majalah';
        return view('pages.ebook.show', compact('title', 'ebook'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Ebook $ebook)
    {
        $title = 'Edit Majalah';

        return view('pages.ebook.edit', compact('title', 'ebook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ebook $ebook)
    {
        $messages = [
            'title.required' => 'Judul majalah tidak boleh kosong.',
            'description.required' => 'Deskripsi majalah tidak boleh kosong.',
            'edition.required' => 'Edisi Majalah tidak boleh kosong',
            'publication_year.required' => 'Tahun Terbit tidak boleh kosong',
            'thumbnail.image' => 'Harap pilih gambar untuk post ini.',
            'thumbnail.image' => 'Format gambar yang diterima: JPG/PNG.',
            'file.file' => 'File Ebook harus dipilih terlebih dahulu.',
            'file.file' => 'File Ebook tidah valid.',
            'file.mimes' => 'File Ebook harus dalam format PDF, DOC, atau DOCX.',
        ];

        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required'],
            'edition' => ['required'],
            'publication_year' => ['required'],
            'thumbnail' => ['nullable', 'image'],
            'file' => ['nullable', 'file', 'mimes:pdf,docx,doc'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('ebook.edit', $ebook->id)->withErrors($validator)->withInput();
        }

        $ebook->title = $request->title;
        $ebook->description = $request->description;
        $ebook->edition = $request->edition;
        $ebook->publication_year = $request->publication_year;
        
        if ($request->file('thumbnail')) {
            $ebook->thumbnail = $request->file('thumbnail')->store('ebooks');
        }
        if ($request->file('file')) {
            $ebook->file = $request->file('file')->store('ebooks');
        }
        $ebook->admin_id = Auth::guard('admin')->user()->id;
        $ebook->save();

        return redirect()->route('ebook.index')->with('success', 'Berhasil memperbarui data majalah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebook $ebook)
    {
        $ebookTitle = $ebook->title;
        $ebook->delete();

        return redirect()->route('ebook.index')->with('success', 'Berhasil menghapus majalah ' . $ebookTitle . '.');
    }
}
