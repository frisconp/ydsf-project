@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Tambah Kantor Cabang</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('branch-office.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title" class="form-control-label">Nama Kantor</label>
                <input type="text" class="form-control" name="title" placeholder="Masukkan nama kantor" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="address" class="form-control-label">Alamat Kantor</label>
                <textarea name="address" id="address" class="form-control" placeholder="Masukkan alamat kantor" rows="3">{{ old('address') }}</textarea>
            </div>
            <div class="form-group">
                <label for="city" class="form-control-label">Kota</label>
                <input type="text" class="form-control" name="city" placeholder="Masukkan nama kota" value="{{ old('city') }}">
            </div>
            <div class="form-group">
                <label for="phone_number" class="form-control-label">Nomor Telepon</label>
                <input type="text" class="form-control" name="phone_number" placeholder="Masukkan nomor telepon" value="{{ old('phone_number') }}">
            </div>
            <a href="{{ route('branch-office.index') }}" class="btn btn-secondary btn-icon" role="button" aria-pressed="true">Batal</a>
            <button type="submit" class="btn btn-default btn-icon">
                <span class="btn-inner--icon"><i class="fas fa-plus-square"></i></span>
                <span class="btn-inner--text">Tambah</span>
            </button>
        </form>
    </div>
</div>
@endsection
