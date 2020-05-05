@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Tambah Rekening</h3>
    </div>
    <div class="card-body">
        <!-- @csrf -->
        <form action="{{ route('rekening.update', $rekening->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="form-control-label">Nama</label>
                <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Yayasan" value="{{ old('name') ?? $rekening->name}}" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="number" class="form-control-label">Nomor Rekening</label>
                <input type="text" class="form-control" name="account_number" placeholder="Masukkan nomor rekening" value="{{ old('account_number') ?? $rekening->account_number}}" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="type" class="form-control-label">Jenis Akun</label>
                <select class="form-control" id="type" name="type">
                    <option value="Bank BNI" {{ old('type') ?? $rekening->type == 'Bank BNI' ? 'selected' : null }}>Bank BNI</option>
                    <option value="Bank Mandiri" {{ old('type') ?? $rekening->type == 'Bank Mandiri' ? 'selected' : null }}>Bank Mandiri</option>
                    <option value="Bank BCA" {{ old('type') ?? $rekening->type == 'Bank BNI' ? 'selected' : null }}>Bank BCA</option>
                </select>
            </div>
            <a href="{{ route('rekening.index') }}" class="btn btn-secondary btn-icon" role="button" aria-pressed="true">Batal</a>
            <button type="submit" class="btn btn-default btn-icon">
                <span class="btn-inner--icon"><i class="fas fa-plus-square"></i></span>
                <span class="btn-inner--text">Perbaruhi</span>
            </button>
        </form>
    </div>
</div>
@endsection
