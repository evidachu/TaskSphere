@extends('layouts.app')

@section('title', 'Detail Tugas')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Detail Tugas Anda</h1>

        <div class="card shadow-lg">
            <div class="card-body">
                <!-- Nama Tugas -->
                <h4 class="card-title text-primary mb-3"><strong>Nama Tugas: </strong>{{ $task->name }}</h4>
                
                <!-- Penanggung Jawab -->
                <p class="card-text"><strong>Penanggung Jawab: </strong> 
                    <span class="badge bg-info">{{ $task->assignee_name }}</span>
                </p>

                <!-- Deadline -->
                <p class="card-text"><strong>Deadline: </strong>
                    <span class="text-muted">{{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}</span>
                </p>

                <!-- Status -->
                <p class="card-text"><strong>Status: </strong>
                    <span class="badge bg-{{ $task->status == 'Belum Dimulai' ? 'warning' : ($task->status == 'Sedang Dikerjakan' ? 'info' : 'success') }}">
                        {{ $task->status }}
                    </span>
                </p>

                <!-- Form untuk Update Status -->
                <form action="{{ route('task.update', $task->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="status" class="form-label">Pilih Status Pengerjaan:</label>
                        <select name="status" id="status" class="form-select">
                            <option value="Belum Dimulai" {{ $task->status == 'Belum Dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                            <option value="Sedang Dikerjakan" {{ $task->status == 'Sedang Dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                            <option value="Selesai" {{ $task->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <!-- Hasil Tugas -->
                    <div class="mb-3">
                        <label for="result" class="form-label">Hasil Tugas:</label>
                        <textarea name="result" id="result" rows="5" class="form-control">{{ $task->result }}</textarea>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Kembali ke Dashboard -->
        <div class="mt-4 text-center">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
@endsection
