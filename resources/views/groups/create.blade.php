@extends('layouts.app')

@section('title', 'Daftar Grup')

@section('content')
<div class="container">
    <h1 class="text-center text-primary mb-4">Daftar Grup</h1>

    <!-- Form untuk membuat grup -->
    <div class="mb-4">
        <h3>Buat Grup Baru</h3>
        <form action="{{ route('groups.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Grup</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Mata Pelajaran</label>
                <input type="text" name="subject" id="subject" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-success">Buat Grup</button>
            </div>
        </form>
    </div>

    <!-- Daftar Grup -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nama Grup</th>
                <th>Deskripsi</th>
                <th>Mata Pelajaran</th>
                <th>Anggota Maksimum</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($groups as $group)
            <tr>
                <td>{{ $group->name }}</td>
                <td>{{ $group->description }}</td>
                <td>{{ $group->subject }}</td>
                <td>{{ $group->max_members }}</td>
                <td>
                    <form action="{{ route('groups.join', $group->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Gabung</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada grup tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-container d-flex justify-content-center">
        {{ $groups->links() }}
    </div>
</div>
@endsection
