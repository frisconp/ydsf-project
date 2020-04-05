@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Tambah Admin</h3>
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

        <form action="{{ route('admin.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <label for="avatar" class="form-control-label">Foto</label>
                <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror">
            </div>
            <div class="form-group">
                <label for="title" class="form-control-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="address" class="form-control-label">Alamat</label>
                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan alamat" rows="3">{{ old('address') }}</textarea>
            </div>
            <div class="form-group">
                <label for="phone_number" class="form-control-label">Nomor Telepon</label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Masukkan nomor telepon" value="{{ old('phone_number') }}">
            </div>
            <div class="form-group">
                <label for="email" class="form-control-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="role" class="form-control-label">Peran</label>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="office" class="form-control-label">Kantor</label>
                <select name="office" id="office" class="form-control @error('office') is-invalid @enderror">
                    @foreach ($offices as $office)
                    <option value="{{ $office->id }}">{{ $office->title }}</option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary btn-icon" role="button" aria-pressed="true">Batal</a>
            <button type="submit" class="btn btn-default btn-icon">
                <span class="btn-inner--icon"><i class="fas fa-plus-square"></i></span>
                <span class="btn-inner--text">Tambah</span>
            </button>
        </form>
    </div>
</div>
@endsection
