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
                <h3 class="mb-0">Artikel</h3>
            </div>
            <div class="col text-right">
                <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-square mr-2"></i>Tambah Post</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Short Description</th>
                    <th scope="col">Diperbarui</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>   
            <tbody>
                @if ($posts->count() == 0)
                <tr>
                    <td colspan="5">Belum ada data Post, <a href="{{ route('post.create') }}">buat sekarang</a>.</td>
                </tr>
                @else
                @foreach ($posts as $post)
                <tr>
                    <th scope="row" class="column">
                        {{ $post->title}}
                    </th>
                    <td class="column">
                        {{ $post->short_description }}
                    </td>
                    <td>
                        {{ $post->updated_at }}
                    </td>
                    <td>
                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye mr-2"></i>Lihat</a>
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-2"></i>Edit</a>
                    <a href="{{ route('post.destroy', $post->id) }}" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt mr-2"></i>Hapus</a>
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
