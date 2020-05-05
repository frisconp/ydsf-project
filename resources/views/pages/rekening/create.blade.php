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
                <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Yayasan"
                    value="{{ old('name') }}" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="number" class="form-control-label">Account Number</label>
                <input type="text" class="form-control" name="number" placeholder="Masukkan nomor rekening"
                    value="{{ old('number') }}" autocomplete="off">
            </div>
            <div class="form-group">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Type</label>
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="type">
                    <option value="Bank BNI">BNI</option>
                    <option value="Bank Mandiri">Mandiri</option>
                    <option value="Bank BCA">BCA</option>
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

@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-ui/jquery-ui.css') }}">
@endsection

@section('script')
<script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/vendor/ckeditor5/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            removePlugins: ['Heading', 'Link'],
            toolbar: ['bold', 'italic']
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