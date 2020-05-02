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
                <label for="number" class="form-control-label">Account Number</label>
                <input type="text" class="form-control" name="account_number" placeholder="Masukkan nomor rekening" value="{{ old('account_number') ?? $rekening->account_number}}" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="type" class="form-control-label">Type</label>
                     <input type="text" class="form-control" name="type" placeholder="Masukkan Jenis Transfer" value="{{ old('type') ?? $rekening->type}}" autocomplete="off">
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