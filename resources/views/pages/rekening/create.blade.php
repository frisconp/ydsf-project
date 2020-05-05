@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Tambah Rekening</h3>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('rekening.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="form-control-label">Nama</label>
                <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Yayasan" value="{{ old('name') }}" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="account_number" class="form-control-label">Nomor Rekening</label>
                <input type="text" class="form-control" name="number" placeholder="Masukkan nomor rekening" value="{{ old('number') }}" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="type" class="form-control-label">Jenis Akun</label>
                <select class="form-control" id="type" name="type">
                    <option value="Bank BNI">Bank BNI</option>
                    <option value="Bank Mandiri">Bank Mandiri</option>
                    <option value="Bank BCA">Bank BCA</option>
                </select>
            </div>
            <a href="{{ route('rekening.index') }}" class="btn btn-secondary btn-icon" role="button"
                aria-pressed="true">Batal</a>
            <button type="submit" class="btn btn-default btn-icon">
                <span class="btn-inner--icon"><i class="fas fa-plus-square"></i></span>
                <span class="btn-inner--text">Tambah</span>
            </button>
        </form>
    </div>
</div>
@endsection
