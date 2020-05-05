<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Program';
        $programs = Program::where('branch_office_id', Auth::guard('admin')->user()->branch_office_id)->get();

        return view('pages.program.index', compact('title', 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Buat Program';
        $type = ['BNI','Mandiri'];

        return view('pages.program.create', compact('title','type'));
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
            'featured_image.required' => 'Harap pilih gambar untuk program ini.',
            'featured_image.image' => 'Format gambar yang diterima: JPG/PNG.',
            'title.required' => 'Judul program tidak boleh kosong.',
            'description.required' => 'Deskripsi program tidak boleh kosong.',
            'location.required' => 'Lokasi tidak boleh kosong.',
            'amount.required' => 'Jumlah donasi tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
            'featured_image' => ['required', 'image'],
            'title' => ['required'],
            'description' => ['required'],
            'location' => ['required'],
            'amount' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('program.create')->withErrors($validator)->withInput();
        }

        $program = new Program();
        $program->title = $request->title;
        $program->description = $request->description;
        $program->location = $request->location;
        $program->amount = $request->amount;
        $program->featured_image = $request->file('featured_image')->store('programs');
        $program->held_on = $request->held_on;
        $program->status = 'menerima donasi';
        $program->branch_office_id = Auth::guard('admin')->user()->branch_office_id;
        $program->admin_id = Auth::guard('admin')->user()->id;
        $program->save();

        return redirect()->route('program.index')->with('success', 'Berhasil menambahkan program baru.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        $title = 'Detail Program';
        return view('pages.program.show', compact('title', 'program'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $title = 'Edit Program';
        return view('pages.program.edit', compact('title', 'program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $messages = [
            'featured_image.image' => 'Format gambar yang diterima: JPG/PNG.',
            'title.required' => 'Judul program tidak boleh kosong.',
            'description.required' => 'Deskripsi program tidak boleh kosong.',
            'location.required' => 'Lokasi tidak boleh kosong.',
            'amount.required' => 'Jumlah donasi tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
            'featured_image' => ['nullable', 'image'],
            'title' => ['required'],
            'description' => ['required'],
            'location' => ['required'],
            'amount' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('program.edit', $program->id)->withErrors($validator)->withInput();
        }

        $program->title = $request->title;
        $program->description = $request->description;
        $program->held_on = $request->held_on;
        $program->location = $request->location;
        $program->amount = $request->amount;

        if ($request->file('featured_image')) {
            $program->featured_image = $request->file('featured_image')->store('programs');
        }

        $program->save();

        return redirect()->route('program.index')->with('success', 'Berhasil memperbarui program '.$program->title.'.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $programTitle = $program->title;
        $program->delete();

        return redirect()->route('program.index')->with('success', 'Berhasil menghapus program '.$programTitle.'.');
    }
}
