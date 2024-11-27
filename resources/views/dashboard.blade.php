<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Kolaborasi Web</title>

    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome (via CDN) untuk icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS (optional, jika perlu custom style) -->
    <style>
        .container-dashboard {
            margin-top: 100px;
        }

        .card {
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f8f9fa;
        }

        .card-body {
            padding: 20px;
        }

        .typing-effect {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            width: 0;
            animation: typing 4s steps(40) 1s forwards;
        }

        @keyframes typing {
            0% { width: 0; }
            100% { width: 100%; }
        }

        .typing-effect:after {
            content: '';
            display: none;
        }

        /* Custom Header Styling */
        .header-bar {
            background-color: #007bff;
            padding: 10px 20px;
            color: #fff;
        }

        .header-bar .nav-item {
            margin-right: 20px;
        }

        .header-bar .nav-item a {
            color: #fff;
            text-decoration: none;
        }

        .header-bar .nav-item a:hover {
            color: #f8f9fa;
        }
    </style>
</head>
<body>
<!-- Header with User Info and Logout -->
<div class="header-bar">
    <div class="container d-flex justify-content-between align-items-center">
        <h4>Dashboard Kolaborasi Web</h4>
        <div class="d-flex align-items-center">
            <!-- Menampilkan Nama Pengguna -->
            <span class="me-3">Halo, {{ Auth::user()->name }}</span>

            <!-- Tombol Profil -->
            <a href="#" class="btn btn-light btn-sm me-2">Profil</a>

            <!-- Form Logout -->
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</div>


    <div class="container-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="typing-effect">Selamat datang di Dashboard Kolaborasi Web!</h1>
                    <p class="lead">Halo, {{ Auth::user()->name }}. Anda berhasil login ke sistem kolaborasi ini.</p>
                </div>
            </div>
            
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

    <div class="row g-4">

        <!-- Card 1: Project Collaboration -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Project Collaboration</h4>
                </div>
                <div class="card-body">
                    <p>Mulai kerjakan project kolaborasi Anda dengan tim di sini.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal">Lihat Project</button>
                </div>
            </div>
        </div>

        @extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Dashboard</h1>

    <!-- Card Task Management -->
    <div class="card mb-4">
        <div class="card-header">
            Task Management
        </div>
        <div class="card-body">
            <!-- Button to trigger the "View Tasks" modal -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal">Lihat Tugas</button>
        </div>
    </div>

    <!-- Modal for Task Management -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Task Management</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="taskTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="task-list-tab" data-bs-toggle="tab" href="#task-list" role="tab" aria-controls="task-list" aria-selected="true">Daftar Tugas</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="task-calendar-tab" data-bs-toggle="tab" href="#task-calendar" role="tab" aria-controls="task-calendar" aria-selected="false">Kalender Tugas</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3" id="taskTabsContent">
                        <!-- Daftar Tugas Tab -->
                        <div class="tab-pane fade show active" id="task-list" role="tabpanel" aria-labelledby="task-list-tab">
                            <h4>Daftar Tugas</h4>
                            <!-- Daftar Tugas Table -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td>{{ $task->is_completed ? 'Selesai' : 'Belum Selesai' }}</td>
                                            <td>
                                                <!-- Buttons for CRUD operations -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $task->id }}">Edit</button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTaskModal{{ $task->id }}">Hapus</button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Task -->
                                        <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTaskModalLabel">Edit Tugas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Edit Task Form -->
                                                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="title" class="form-label">Judul Tugas</label>
                                                                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description" class="form-label">Deskripsi</label>
                                                                <textarea class="form-control" id="description" name="description" required>{{ $task->description }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" id="status" name="is_completed">
                                                                    <option value="0" {{ $task->is_completed == 0 ? 'selected' : '' }}>Belum Selesai</option>
                                                                    <option value="1" {{ $task->is_completed == 1 ? 'selected' : '' }}>Selesai</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Delete Task -->
                                        <div class="modal fade" id="deleteTaskModal{{ $task->id }}" tabindex="-1" aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteTaskModalLabel">Hapus Tugas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus tugas ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Kalender Tugas Tab -->
                        <div class="tab-pane fade" id="task-calendar" role="tabpanel" aria-labelledby="task-calendar-tab">
                            <h4>Kalender Tugas</h4>
                            <!-- Kalender (bisa menggunakan library seperti FullCalendar) -->
                            <div id="calendar">
                                <!-- Calendar will be rendered here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



        <!-- Card 3: File Sharing -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>File Sharing</h4>
                </div>
                <div class="card-body">
                    <p>Bagikan dan unduh file dengan aman melalui fitur ini.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fileSharingModal">Lihat File</button>
                </div>
            </div>
        </div>

        <!-- Card 4: Team Communication -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Team Communication</h4>
                </div>
                <div class="card-body">
                    <p>Komunikasikan ide Anda dengan tim secara real-time.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teamCommunicationModal">Lihat Komunikasi</button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal 1: Project Collaboration -->
<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Project Collaboration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Konten untuk fitur Project Collaboration akan dimuat di sini.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal 2: Task Management -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Manage Tasks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="taskContent">
                    <button class="btn btn-success mb-3" id="add-task">Add Task</button>
                    <ul class="list-group" id="task-list">
                        <!-- Task items will be rendered here -->
                    </ul>
                </div>

                <!-- Task Form -->
                <div id="task-form" style="display: none;">
                    <form id="taskForm">
                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="taskTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="taskDescription" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" id="cancel-task">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 3: File Sharing -->
<div class="modal fade" id="fileSharingModal" tabindex="-1" aria-labelledby="fileSharingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileSharingModalLabel">File Sharing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Konten untuk fitur File Sharing akan dimuat di sini.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal 4: Team Communication -->
<div class="modal fade" id="teamCommunicationModal" tabindex="-1" aria-labelledby="teamCommunicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teamCommunicationModalLabel">Team Communication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Konten untuk fitur Team Communication akan dimuat di sini.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Memuat data tugas menggunakan AJAX
    document.addEventListener('DOMContentLoaded', function () {
    const taskList = document.querySelector('#task-list');
    const taskForm = document.querySelector('#taskForm');
    const taskContent = document.querySelector('#taskContent');
    const taskFormContainer = document.querySelector('#task-form');

    // Load tasks
    function loadTasks() {
        fetch('/tasks')
            .then(response => response.json())
            .then(data => {
                taskList.innerHTML = '';
                data.forEach(task => {
                    const taskItem = `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>${task.title}</strong>
                                <p class="mb-0">${task.description}</p>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-info edit-task" data-id="${task.id}" data-title="${task.title}" data-description="${task.description}">Edit</button>
                                <button class="btn btn-sm btn-danger delete-task" data-id="${task.id}">Delete</button>
                            </div>
                        </li>
                    `;
                    taskList.innerHTML += taskItem;
                });
            });
    }

    // Show form to add new task
    document.querySelector('#add-task').addEventListener('click', () => {
        taskForm.reset();
        taskFormContainer.style.display = 'block';
        taskContent.style.display = 'none';
    });

    // Cancel form
    document.querySelector('#cancel-task').addEventListener('click', () => {
        taskFormContainer.style.display = 'none';
        taskContent.style.display = 'block';
    });

    // Submit form
    taskForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(taskForm);
        const id = taskForm.dataset.id;

        const method = id ? 'PUT' : 'POST';
        const url = id ? `/tasks/${id}` : '/tasks';

        fetch(url, {
            method: method,
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData,
        })
            .then(response => response.json())
            .then(() => {
                loadTasks();
                taskFormContainer.style.display = 'none';
                taskContent.style.display = 'block';
            });
    });

    // Edit task
    taskList.addEventListener('click', function (e) {
        if (e.target.classList.contains('edit-task')) {
            const id = e.target.dataset.id;
            const title = e.target.dataset.title;
            const description = e.target.dataset.description;

            taskForm.dataset.id = id;
            document.querySelector('#taskTitle').value = title;
            document.querySelector('#taskDescription').value = description;

            taskFormContainer.style.display = 'block';
            taskContent.style.display = 'none';
        }
    });

    // Delete task
    taskList.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-task')) {
            const id = e.target.dataset.id;

            fetch(`/tasks/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            })
                .then(() => loadTasks());
        }
    });

    // Initial load
    loadTasks();
});

</script>
</body>
</html>

            <!-- Footer -->
            <footer class="text-center mt-5">
                <p>&copy; {{ date('Y') }} Kolaborasi Web. Semua hak cipta dilindungi.</p>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelector('#lihat-tugas').addEventListener('click', function () {
    fetch('/tasks')
        .then(response => response.json())
        .then(data => {
            let content = '<ul class="list-group">';
            data.forEach(task => {
                content += `
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${task.title}</strong>
                            <p class="mb-0">${task.description}</p>
                        </div>
                        <span class="badge ${task.is_completed ? 'bg-success' : 'bg-warning'}">
                            ${task.is_completed ? 'Completed' : 'Pending'}
                        </span>
                    </li>
                `;
            });
            content += '</ul>';
            document.querySelector('#taskContent').innerHTML = content;

            // Tampilkan modal setelah data dimuat
            const modal = new bootstrap.Modal(document.querySelector('#taskModal'));
            modal.show();
        })
        .catch(error => {
            document.querySelector('#taskContent').innerHTML = '<p>Error loading tasks.</p>';
        });
});

    </script>
</body>
</html>
