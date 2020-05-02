<?php

namespace App\Http\Controllers;

use App\DonationAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RekeningController extends Controller
{
    //
    public function index()
    {
        $title = 'Rekening';
        $donation_accounts = DonationAccount::all();

        return view('pages.rekening.index', compact('title', 'donation_accounts'));
    }

    public function create()
    {
        $title = 'Tambah Rekening';

        return view('pages.rekening.create', compact('title'));
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Nama tidak boleh kosong.',
            'number.required' => 'Nomor Rekening tidak boleh kosong.',
            'type.required' => 'Type tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'number' => ['required'],
            'type' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('rekening.index')->withErrors($validator)->withInput();
        }

        $donation_accounts = new DonationAccount();
        $donation_accounts->name = $request->name;
        $donation_accounts->account_number = $request->number;
        $donation_accounts->type = $request->type;
        $donation_accounts->branch_office_id = Auth::guard('admin')->user()->branch_office_id;
        $donation_accounts->save();

        return redirect()->route('rekening.index')->with('success', 'Berhasil menambahkan rekening baru.');
    }

    public function show(DonationAccount $rekening)
    {
        $title = 'Detail Rekening';
        return view('pages.rekening.show', compact('title', 'rekening'));
    }


    public function edit(DonationAccount $rekening)
    {
        $title = 'Edit Rekening';
        return view('pages.rekening.edit', compact('title', 'rekening'));
    }

    public function update(Request $request, DonationAccount $rekening)
    {
        $messages = [
            'name.required' => 'Nama tidak boleh kosong.',
            'account_number.required' => 'Nomor Rekening tidak boleh kosong.',
            'type.required' => 'Type tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'account_number' => ['required'],
            'type' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('rekening.edit', $rekening->id)->withErrors($validator)->withInput();
        }

        $rekening->name = $request->name;
        $rekening->account_number = $request->account_number;
        $rekening->type = $request->type;
        $rekening->branch_office_id = Auth::guard('admin')->user()->branch_office_id;
        $rekening->save();

        return redirect()->route('rekening.index')->with('success', 'Berhasil menambahkan rekening baru.');
    }


    public function destroy(DonationAccount $rekening)
    {
        $namaRekening = $rekening->name;
        $rekening->delete();

        return redirect()->route('rekening.index')->with('success', 'Berhasil menghapus Rekening '.$namaRekening.'.');
    }

}
