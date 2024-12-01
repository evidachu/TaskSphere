<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Materi</title>
    <style>
        /* Custom Styling */
        .header-bar {
            background-color: #007bff;
            padding: 10px 20px;
            color: #fff;
        }

        .header-bar .nav-item a {
            color: #fff;
            text-decoration: none;
        }

        .header-bar .nav-item a:hover {
            text-decoration: underline;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-primary, .btn-warning, .btn-danger {
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .modal-header, .modal-footer {
            border: none;
        }
    </style>
</head>
<body>
    <div class="header-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h4 class="me-3 text-white">
                    <a href="/dashboard" class="text-white text-decoration-none">Dashboard Manage Task</a>
                </h4>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3">Halo, {{ Auth::user()->name }}</span>
                <a href="#" class="btn btn-light btn-sm me-2">Profil</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-primary">Materi List</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createmateriModal">Add Materi</button>
        </div>
        <div class="row mt-4">
            @foreach($materis as $materi)
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ url($materi->cover_path) }}" alt="Materi Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $materi->judul }}</h5>
                        <p class="card-text text-muted">{{ $materi->deskripsi }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ $materi->file_path }}" target="_blank" class="btn btn-primary btn-sm">Download</a>
                            <button type="button" class="btn btn-warning btn-sm text-white" onclick="openEditModal({{ $materi->id }})">Edit</button>
                        </div>
                        <form action="{{ route('materi.destroy', $materi->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal for adding new materi -->
    <div class="modal fade" id="createmateriModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Materi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required style="resize: none;" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Cover</label>
                            <input type="file" class="form-control" id="cover" name="cover" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for editing materi -->
    <div class="modal fade" id="editmateriModal" tabindex="-1" aria-labelledby="editmateriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data" id="editMateriForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editmateriModalLabel">Edit Materi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="edit_title" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="edit_description" name="deskripsi" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Cover</label>
                            <input type="file" class="form-control" id="cover" name="cover" >
                        </div>
                        <div class="mb-3">
                            <label for="edit_file" class="form-label">File</label>
                            <input type="file" class="form-control" id="edit_file" name="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openEditModal(materiId) {
            var modal = new bootstrap.Modal(document.getElementById('editmateriModal'));
            modal.show();
            fetch(`/materi/${materiId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editMateriForm').action = `/materi/${materiId}`;
                    document.getElementById('edit_title').value = data.judul;
                    document.getElementById('edit_description').value = data.deskripsi;
                });
        }
    </script>
</body>
</html>
