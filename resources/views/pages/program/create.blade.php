@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Tambah Program</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('program.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <label for="featured_image" class="form-control-label">Gambar</label>
                <input type="file" class="form-control" name="featured_image" id="featured_image">
            </div>
            <div class="form-group">
                <label for="title" class="form-control-label">Judul Program</label>
                <input type="text" class="form-control" name="title" placeholder="Masukkan judul program" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="held_on" class="form-control-label">Tanggal Pelaksanaan</label>
                <input type="text" class="form-control datepicker" name="held_on" placeholder="Pilih tanggal pelaksanaan" value="{{ old('held_on') }}">
            </div>
            <div class="form-group">
                <label for="description" class="form-control-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="location" class="form-control-label">Lokasi</label>
                <input type="text" class="form-control" name="location" placeholder="Masukkan alamat lokasi" value="{{ old('location') }}">
            </div>
            <div class="form-group">
                <label for="amount" class="form-control-label">Jumlah donasi yang dibutuhkan</label>
                <input type="text" class="form-control" name="amount" placeholder="Masukkan jumlah donasi" value="{{ old('amount') }}">
            </div>
            <a href="{{ route('program.index') }}" class="btn btn-secondary btn-icon" role="button" aria-pressed="true">Batal</a>
            <button type="submit" class="btn btn-default btn-icon">
                <span class="btn-inner--icon"><i class="fas fa-plus-square"></i></span>
                <span class="btn-inner--text">Tambah</span>
            </button>
        </form>
    </div>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-ui/jquery-ui.css') }}">
@endsection

@section('script')
<script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/vendor/ckeditor5/ckeditor.js') }}"></script>
<script>
    ClassicEditor
    .create(document.querySelector('#description'), {
        removePlugins: [ 'Heading', 'Link' ],
        toolbar: [ 'bold', 'italic' ]
    })
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.log(error);
    });

    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
    });
</script>
{{-- <script>
    function readImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#featured_image').change(function () {
        readImage(this);
    });
</script> --}}
@endsection
