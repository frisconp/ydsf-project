@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Unggah Majalah/Ebook</h3>
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
        <form action="{{ route('ebook.update', $ebook->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title" class="form-control-label">Judul Majalah</label>
                <input type="text" class="form-control" name="title" placeholder="Masukkan judul majalah" value="{{ old('title') ?? $ebook->title }}">
            </div>
            <div class="form-group">
                <label for="description" class="form-control-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" placeholder="Masukkan deskripsi majalah" rows="3">{{ old('description') ?? $ebook->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="file" class="form-control-label">File</label>
                <input type="file" class="form-control" name="file" id="file">
                <small>Kosongkan jika tidak ingin mengganti.</small>
            </div>
            <a href="{{ route('ebook.index') }}" class="btn btn-secondary btn-icon" role="button" aria-pressed="true">Batal</a>
            <button type="submit" class="btn btn-default btn-icon">
                <span class="btn-inner--icon"><i class="fas fa-plus-square"></i></span>
                <span class="btn-inner--text">Simpan</span>
            </button>
        </form>
    </div>
</div>
@endsection
