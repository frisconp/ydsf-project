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
                <h3 class="mb-0">Data Admin</h3>
            </div>
            <div class="col text-right">
                <a href="{{ route('admin.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-square mr-2"></i>Tambah</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Peran</th>
                    <th scope="col">Kantor</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @if ($admins->count() == 0)
                <tr>
                    <td colspan="5">Belum ada data admin/staff, <a href="#">buat sekarang</a>.</td>
                </tr>
                @else
                @foreach ($admins as $admin)
                <tr>
                    <th scope="row">
                        {{ $admin->name }}
                    </th>
                    <td>
                        {{ $admin->email }}
                    </td>
                    <td>
                        {{ $admin->role->title }}
                    </td>
                    <td>
                        {{ $admin->office->title ?? '' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <a href="{{ route('admin.destroy', $admin->id) }}" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i> Hapus</a>
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
