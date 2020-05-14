<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();

        return $this->sendResponse($programs->load('office'), 'Data program berhasil didapatkan.');
    }

    public function show(Program $program)
    {
        return $this->sendResponse($program->load('updates'), 'Data program berhasil didapatkan.');
    }

    public function getBySlug($slug)
    {
        $program = Program::where('slug', $slug)->first();

        return $this->sendResponse($program->load('office', 'updates'), 'Data program berhasil didapatkan.');
    }

    public function getCompletedProgram()
    {
        $program = Program::where('status', 'Terlaksana')->count();

        return $this->sendResponse($program, 'Berhasil mendapatkan jumlah program terlaksana');
        
    }
    
}
