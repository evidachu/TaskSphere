<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Kolaborasi Web</title>

    <!-- Meta CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />


</head>
<body>

    <!-- Custom CSS (optional, jika perlu custom style) -->
    <style>
    /* Container Dashboard */
    .container-dashboard {
        margin-top: 100px;
    }

    /* Menyamakan ukuran semua card */
    .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Memastikan isi card tersebar */
        height: 100%; /* Menjamin card memiliki tinggi yang konsisten */
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    /* Efek Hover pada Card */
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
    }

    /* Styling untuk card header */
    .card-header {
        background-color: #f8f9fa;
        padding: 25px 15px;
        text-align: center;
    }

    /* Styling untuk isi card */
    .card-body {
        padding: 20px;
        flex-grow: 1; /* Memastikan konten card berkembang untuk mengisi ruang */
    }

    /* Ukuran teks untuk deskripsi */
    .card-body p {
        font-size: 1rem;
        color: #6c757d;
    }

    /* Styling untuk ikon */
    .card-header i {
        font-size: 3rem;
        color: #007bff; /* Menyesuaikan dengan tema warna */
    }

    /* Tombol di dalam card */
    .card-body button {
        padding: 10px 20px;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    /* Efek hover pada tombol */
    .card-body button:hover {
        background-color: #0056b3;
    }

    /* Layout untuk card di grid */
    .row.g-4 {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
    }

    /* Membuat card responsive */
    .col-12.col-sm-6.col-md-4 {
        display: flex;
        justify-content: center;
        margin-bottom: 20px; /* Memberi jarak antar card */
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
        <!-- Left side: Dashboard and Materi -->
        <div class="d-flex align-items-center">
            <h4 class="me-3 text-white"><a href="/dashboard" class="nav-link">Dashboard Kolaborasi Web</a></h4>
            <a href="/materi" class="btn btn-light btn-sm me-2">Materi</a>
        </div>

        <!-- Right side: Profil and Logout -->
        <div class="d-flex align-items-center ms-auto">
            <span class="me-3">Halo, {{ Auth::user()->name }}</span>
            <a href="#" class="btn btn-light btn-sm me-2">Profil</a>

            <!-- Form Logout -->
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>


<div class="container-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="typing-effect">Welcome to TaskSphere!</h1>
                <p class="lead">Halo, {{ Auth::user()->name }}. Anda berhasil login ke TaskSphere.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="container mt-5">
            <div class="row g-4 justify-content-center">
                <!-- Card 1 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card shadow-lg rounded-3" style="transition: all 0.3s ease;">
                        <div class="card-header text-center">
                            <i class="fas fa-project-diagram fa-3x text-primary mb-3"></i>
                            <h4>FITUR 1</h4>
                        </div>
                        <div class="card-body text-center">
                            <p>Mulai kerjakan project kolaborasi Anda dengan tim di sini.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal">Lihat Project</button>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card shadow-lg rounded-3" style="transition: all 0.3s ease;">
                        <div class="card-header text-center">
                            <i class="fas fa-tasks fa-3x text-warning mb-3"></i>
                            <h4>FITUR 2</h4>
                        </div>
                        <div class="card-body text-center">
                            <p>Mulai kerjakan project kolaborasi Anda dengan tim di sini.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal">Lihat Tugas</button>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card shadow-lg rounded-3" style="transition: all 0.3s ease;">
                        <div class="card-header text-center">
                            <i class="fas fa-share-alt fa-3x text-success mb-3"></i>
                            <h4>FITUR 3</h4>
                        </div>
                        <div class="card-body text-center">
                            <p>Bagikan dan unduh file dengan aman melalui fitur ini.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fileSharingModal">Lihat File</button>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Kalender & Manajemen Waktu Kolaboratif (Updated) -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card shadow-lg rounded-3" style="transition: all 0.3s ease;">
                        <div class="card-header text-center">
                            <i class="fas fa-calendar-alt fa-3x text-info mb-3"></i>
                            <h4>Kalender & Manajemen Waktu</h4>
                        </div>
                        <div class="card-body text-center">
                            <p>Kelola jadwal Anda dengan fitur kalender dan manajemen waktu.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teamCommunicationModal">Lihat Kalender</button>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card shadow-lg rounded-3" style="transition: all 0.3s ease;">
                        <div class="card-header text-center">
                            <i class="fas fa-users fa-3x text-info mb-3"></i>
                            <h4>FITUR 5</h4>
                        </div>
                        <div class="card-body text-center">
                            <p>Manfaatkan fitur ini untuk berkolaborasi secara efektif.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teamCommunicationModal">Lihat Komunikasi</button>
                        </div>
                    </div>
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

    <!-- Modal 2: MOODAL 2 -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Task Management</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Konten untuk fitur Task Management akan dimuat di sini.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

    <!-- Modal 4: Kalender & Manajemen Waktu Kolaboratif -->
    <!-- Include Modal -->
@include('components.4-modal')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- Modal 5: Team Communication -->
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

    @stack('scripts')

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

</body>
</html>
