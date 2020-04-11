@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">{{ $program->title }}</h3>
    </div>
    <div class="card-body">
        <div class="text-center mb-4">
            <img src="{{ asset('storage/'.$program->featured_image) }}" height="300">
        </div>
        <div class="col-md-8 mx-auto">
            <div id="description">
                {!! $program->description !!}
            </div>
            <div>
                <a href="{{ route('program.edit', $program->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('program.destroy', $program->id) }}" data-toggle="modal" data-target="#deleteModal" class="btn btn-light">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="delete-form">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Ya, hapus sekarang!</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
