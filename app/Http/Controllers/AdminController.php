<?php

namespace App\Http\Controllers;

use App\Admin;
use App\BranchOffice;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Admin';
        $admins = Admin::orderBy('name')->get()->except(['role_id' => 1]);

        return view('pages.admin.index', compact('title', 'admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Admin';
        $roles = Role::all();
        $offices = BranchOffice::orderBy('title')->get();

        return view('pages.admin.create', compact('title', 'roles', 'offices'));
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
            'name.required' => 'Nama lengkap tidak boleh kosong.',
            'address.required' => 'Alamat tidak boleh kosong',
            'phone_number.required' => 'Nomor telepon tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Alamat email tidak valid.',
            'email.unique' => 'Alamat sudah dipakai, gunakan email yang lain.',
            'avatar.image' => 'Foto harus dalam format gambar.',
            'role.required' => 'Peran tidak boleh kosong.',
            'office.required' => 'Kantor Cabang tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'email' => ['required', 'email', 'unique:admins'],
            'avatar' => ['image'],
            'role' => ['required'],
            'office' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('admin.create')->withErrors($validator)->withInput();
        }

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->address = $request->address;
        $admin->phone_number = $request->phone_number;
        $admin->email = $request->email;
        $admin->password = Hash::make(Str::random(8));
        $admin->role_id = $request->role;
        $admin->branch_office_id = $request->office;
        $admin->avatar = $request->file('avatar')->store('avatars');
        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Berhasil menambahkan admin baru.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $title = 'Edit Admin';
        $roles = Role::all();
        $offices = BranchOffice::all();

        return view('pages.admin.edit', compact('title', 'admin', 'roles', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Admin $admin, Request $request)
    {
        $messages = [
            'name.required' => 'Nama lengkap tidak boleh kosong.',
            'address.required' => 'Alamat tidak boleh kosong',
            'phone_number.required' => 'Nomor telepon tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Alamat email tidak valid.',
            'email.unique' => 'Alamat sudah dipakai, gunakan email yang lain.',
            'avatar.image' => 'Foto harus dalam format gambar.',
            'role.required' => 'Peran tidak boleh kosong.',
            'office.required' => 'Kantor Cabang tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'email' => ['required', 'email', 'unique:admins,email,'.$admin->id],
            'avatar' => ['nullable', 'image'],
            'role' => ['required'],
            'office' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('admin.edit', $admin->id)->withErrors($validator)->withInput();
        }

        $admin->name = $request->name;
        $admin->address = $request->address;
        $admin->phone_number = $request->phone_number;
        $admin->email = $request->email;
        $admin->role_id = $request->role;
        $admin->branch_office_id = $request->office;

        if ($request->file('avatar')) {
            $admin->avatar = $request->file('avatar')->store('avatars');
        }

        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Berhasil memperbarui data admin.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Berhasil menghapus akun admin.');
    }
}
