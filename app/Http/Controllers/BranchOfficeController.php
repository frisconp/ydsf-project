<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kantor Cabang';
        $branchOffices = BranchOffice::all();

        return view('pages.branch_office.index', compact('title', 'branchOffices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Kantor Cabang';

        return view('pages.branch_office.create', compact('title'));
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
            'title.required' => 'Nama kantor tidak boleh kosong.',
            'title.max' => 'Nama kantor terlalu panjang, maksimal 255 karakter.',
            'address.required' => 'Alamat kantor tidak boleh kosong.',
            'city.required' => 'Nama kota tidak boleh kosong.',
            'phone_number' => 'Nomor telepon kantor tidak boleh kosong.'
        ];

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:255'],
            'address' => ['required'],
            'city' => ['required'],
            'phone_number' => ['required']
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('branch-office.create')->withErrors($validator)->withInput();
        }

        BranchOffice::create($request->all());
        return redirect()->route('branch-office.index')->with('success', 'Berhasil menambahkan data kantor baru.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function show(BranchOffice $branchOffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function edit(BranchOffice $branchOffice)
    {
        $title = 'Edit Kantor Cabang';
        $office = $branchOffice;

        return view('pages.branch_office.edit', compact('title', 'office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BranchOffice $branchOffice)
    {
        $messages = [
            'title.required' => 'Nama kantor tidak boleh kosong.',
            'title.max' => 'Nama kantor terlalu panjang, maksimal 255 karakter.',
            'address.required' => 'Alamat kantor tidak boleh kosong.',
            'city.required' => 'Nama kota tidak boleh kosong.',
            'phone_number' => 'Nomor telepon kantor tidak boleh kosong.'
        ];

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:255'],
            'address' => ['required'],
            'city' => ['required'],
            'phone_number' => ['required']
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('branch-office.create')->withErrors($validator)->withInput();
        }

        $branchOffice->title = $request->title;
        $branchOffice->address = $request->address;
        $branchOffice->city = $request->city;
        $branchOffice->phone_number = $request->phone_number;
        $branchOffice->save();

        return redirect()->route('branch-office.index')->with('success', 'Berhasil memperbarui data kantor.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(BranchOffice $branchOffice)
    {
        $branchOffice->delete();

        return redirect()->route('branch-office.index')->with('success', 'Berhasil menghapus data kantor.');
    }
}
