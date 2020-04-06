@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-header border-0">
        <div class="align-items-center">
            <h3 class="mb-0">Data Pengguna</h3>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Verifikasi</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @if ($users->count() == 0)
                <tr>
                    <td colspan="5">Belum ada data pengguna, <a href="#">buat sekarang</a>.</td>
                </tr>
                @else
                @foreach ($users as $user)
                <tr>
                    <th scope="row">
                        {{ $user->name }}
                    </th>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->city }}
                    </td>
                    <td>
                        {{ $user->email_verified_at ? 'Aktif' : 'Tidak Aktif' }}
                    </td>
                    <td>
                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat</a>
                        {{-- <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a> --}}
                        {{-- <a href="{{ route('user.destroy', $user->id) }}" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i> Hapus</a> --}}
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
