<?php

namespace App\Http\Controllers\API;

use App\Donation;
use App\Http\Controllers\API\BaseController as Controller;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function addDonation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'program_id' => ['required'],
            'donation_account_id' => ['required'],
            'message' => ['max:255'],
            'amount' => ['required'],
        ], [
            'program_id.required' => 'ID Program tidak boleh kosong.',
            'donation_account_id.required' => 'ID Rekening tidak boleh kosong.',
            'message.max' => 'Pesan terlalu panjang, maksimal 255 karakter.',
            'amount.required' => 'Jumlah donasi tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Gagal menyimpan data donasi.', $validator->errors(), 400);
        } else {
            $uniqueToken = false;

            while (!$uniqueToken) {
                $token = Str::random(16);

                $checkToken = Donation::where('token', $token)->exists();

                if (!$checkToken) {
                    $uniqueToken = true;
                }
            }

            $donation = new Donation();
            $donation->user_id = Auth::user()->id;
            $donation->program_id = $request->program_id;
            $donation->donation_account_id = $request->donation_account_id;
            $donation->unique_number = rand(100, 999);
            $donation->token = $token;
            $donation->show_as_anonymous = $request->show_as_anonymous ? true : false;
            $donation->message = $request->message;
            $donation->amount = $request->amount;
            $donation->status = 'waiting';
            $donation->save();

            return $this->sendResponse($donation, 'Donasi berhasil ditambahkan.');
        }
    }

    public function detail($token)
    {
        $donation = Donation::where('token', $token)->with('user', 'program', 'donationAccount')->first();

        if (!$donation) {
            return $this->sendError('Maaf, informasi donasi tidak ditemukan.');
        } else {
            return $this->sendResponse($donation, 'Berhasil mendapatkan data donasi.');
        }
    }

    public function getAllDonation()
    {
        $donation = Donation::where('status', 'accepted')->sum('amount');

        return $this->sendResponse($donation, 'Berhasil mendapatkan total donasi yang terkumpul.');
    }

    public function getByProgramId($programId)
    {
        $program = Program::find($programId);

        if ($program) {
            $donations = Donation::where([
                'program_id' => $programId,
                'status' => 'accepted',
            ])->with('user')->get();

            $data = [
                'amount' => $donations->count(),
                'donation_list' => $donations
            ];

            return $this->sendResponse($data, 'Data donasi berhasil didapatkan.');
        } else {
            return $this->sendError('Data donasi tidak ditemukan.');
        }
    }

    public function history ()
    {
        $history = Donation::where('user_id', Auth::user()->id)->get();

        if($history->count() == 0){
            return $this->sendError('Belum pernah melakukan donasi');
        }else{
            return $this->sendResponse($history->load('program'), 'Berhasil menampilkan data history donasi');
        }
    }

    public function upload(Request $request, Donation $donation)
    {
        $messages = [
            'proof_of_payment.required' => 'Harap pilih gambar untuk post ini.',
            'proof_of_payment.image' => 'Format gambar yang diterima: JPG/PNG.',
        ];

        $validator = Validator::make($request->all(), [
            'proof_of_payment' => ['required', 'image'],

        ], $messages);

        $user = Auth::user()->id;
        if($user){
            if ($validator->fails()) {
                return $this->sendError('Gagal mengirimkan bukti', $validator->errors(), 400);
            } else {

                $donation->proof_of_payment = $request->file('proof_of_payment')->store('bukti');
                $donation->save();

                return $this->sendResponse($donation, 'Berhasil mengupload bukti transfer');
            }
        }
    }
}