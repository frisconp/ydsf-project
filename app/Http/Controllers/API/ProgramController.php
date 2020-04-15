<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function getAll()
    {
        $programs = Program::all();

        return $this->sendResponse($programs, 'Data program berhasil didapatkan.');
    }

    public function getById(Program $program)
    {
        return $this->sendResponse($program, 'Data program berhasil didapatkan.');
    }
}
