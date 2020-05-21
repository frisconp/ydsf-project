<?php

namespace App\Http\Controllers\API;

use App\Ebook;
use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ebooks = Ebook::all();

        return $this->sendResponse($ebooks, 'Berhasil mendapatkan data majalah.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Ebook $ebook)
    {
        if (is_null($ebook)) {
            return $this->sendError('Data majalah tidak ditemukan.');
        }

        return $this->sendResponse($ebook, 'Berhasil mendapatkan detail majalah.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Ebook $ebook)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebook $ebook)
    {
        //
    }

    public function searchByTitle(Request $request)
    {
        $ebooks = Ebook::where('title', 'like', '%'.$request->title.'%')->get();

        if ($ebooks->count() > 0) {
            return $this->sendResponse($ebooks, 'Berhasil mendapatkan data majalah');
        } else {
            return $this->sendError('Data majalah tidak ditemukan.');
        }

    }
}
