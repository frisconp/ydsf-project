@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
</div>
@endif
<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Rekening Donasi</h3>
            </div>
            <div class="col text-right">
                <a href="{{ route('rekening.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-square mr-2"></i>Tambah Rekening</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Account Number</th>
                    <th scope="col">Type</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>   
            <tbody>
                @if ($donation_accounts->count() == 0)
                <tr>
                    <td colspan="5">Belum ada data rekening, <a href="{{ route('rekening.create') }}">buat sekarang</a>.</td>
                </tr>
                @else
                @foreach ($donation_accounts as $rekening)
                <tr>
                    <th scope="row">
                        {{ $rekening->name}}
                    </th>
                    <td>
                        {{ $rekening->account_number }}
                    </td>
                    <td>
                        {{ $rekening->type }}
                    </td>
                    <td>
                    <a href="{{ route('rekening.destroy', $rekening->id) }}" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt mr-2"></i>Hapus</a>
                    <a href="{{ route('rekening.edit', $rekening->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>
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

@section('script')
<script>
    $('#deleteModal').on('show.bs.modal', function (e) {
        $('#delete-form').attr('action', e.relatedTarget.getAttribute('href'));
    });
</script>
@endsection
