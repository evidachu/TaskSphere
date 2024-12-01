<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajemen Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .progress-bar-dynamic {
            background-color: #28a745;
            height: 100%;
            border-radius: 5px;
            transition: width 0.5s ease-in-out;
        }
        .badge {
            padding: 5px 10px;
            font-size: 0.9rem;
        }
        table thead {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Dashboard Tracking Proyek</h1>

        <!-- Progress Bar -->
        <div class="progress mb-4" style="height: 25px;">
            <div class="progress-bar-dynamic" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
        </div>

        <!-- Form Menambahkan Tugas -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Tambah Tugas Baru</h5>
                <form id="add-task-form">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Tugas</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="assignee_name" class="form-label">Penanggung Jawab (Nama)</label>
                        <input type="text" class="form-control" id="assignee_name" name="assignee_name" required>
                        <div id="error-message" class="text-danger mt-2" style="display: none;"></div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="Belum Dimulai">Belum Dimulai</option>
                            <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah Tugas</button>
                </form>
            </div>
        </div>

        <!-- Tabel Tugas -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nama Tugas</th>
                        <th>Penanggung Jawab</th>
                        <th>Deadline</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="task-table-body">
                    @foreach ($tasks as $task)
                    <tr>
                        <td><a href="{{ route('task.show', $task->id) }}" class="text-decoration-none text-primary">{{ $task->name }}</a></td>
                        <td>{{ $task->assignee_id }} - {{ $task->assignee_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}</td>
                        <td><span class="badge {{ $task->status == 'Belum Dimulai' ? 'bg-warning' : ($task->status == 'Sedang Dikerjakan' ? 'bg-info' : 'bg-success') }}">{{ $task->status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add-task-form').on('submit', function(e) {
                e.preventDefault(); // Mencegah form untuk submit secara tradisional

                // Ambil data form
                var formData = $(this).serialize();

                // Kirim request AJAX
                $.ajax({
                    url: "{{ route('task.store') }}",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Menampilkan pesan sukses
                        alert(response.success);

                        // Menambahkan tugas baru ke tabel tanpa me-reload halaman
                        var newRow = `
                            <tr>
                                <td><a href="/task/${response.task.id}" class="text-decoration-none text-primary">${response.task.name}</a></td>
                                <td>${response.task.assignee_id} - ${response.task.assignee_name}</td>
                                <td>${response.task.deadline}</td>
                                <td><span class="badge bg-success">${response.task.status}</span></td>
                            </tr>
                        `;
                        $('#task-table-body').append(newRow);

                        // Kosongkan form
                        $('#add-task-form')[0].reset();
                    },
                    error: function(xhr) {
                        // Menampilkan pesan error jika penanggung jawab tidak ditemukan
                        if (xhr.status === 404) {
                            $('#error-message').text(xhr.responseJSON.error).show();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
