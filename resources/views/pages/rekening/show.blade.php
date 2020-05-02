@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Detail Rekening</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered w-100">
            <tr>
                <th>Judul</th>
                <td>{{ $rekening->name }}</td>
            </tr>
            <tr>
                <th>Tanggal Pelaksanaan</th>
                <td>{{ $rekening->account_number }}</td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td>{{ $rekening->type }}</td>
            </tr>
        </table>
        <div>
            <a href="{{ route('rekening.edit', $rekening->id) }}" class="btn btn-primary"><i class="fas fa-edit mr-2"></i>Edit</a>
            <a href="{{ route('rekening.destroy', $rekening->id) }}" class="btn btn-secondary" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt mr-2"></i>Hapus</a>
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle mr-2"></i>Batalkan</button>
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-trash-alt mr-2"></i>Ya, saya yakin!</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
