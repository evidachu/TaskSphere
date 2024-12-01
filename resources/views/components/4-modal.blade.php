<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender & Manajemen Waktu</title>
    
    <!-- Link CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->

    <!-- Custom Styles -->
    <style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }

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
    .header-bar .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .header-bar h4 {
        margin: 0;
    }

    #calendar {
        max-width: 900px;
        margin: 20px auto;
        height: auto;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    /* Tabel Event Modern */
    .event-list {
        margin-top: 40px;
    }

    .event-list h3 {
        margin-bottom: 20px;
        font-weight: bold;
        color: #007bff;
    }

    #eventTable {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    #eventTable th {
        background-color: #007bff;
        color: white;
        text-align: left;
        padding: 12px;
        font-size: 16px;
    }

    #eventTable td {
        padding: 10px;
        text-align: left;
        background-color: #f9f9f9;
    }

    #eventTable tr:nth-child(even) td {
        background-color: #f1f1f1;
    }

    #eventTable th:first-child,
    #eventTable td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    #eventTable th:last-child,
    #eventTable td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    /* Hover Effect */
    #eventTable tbody tr:hover {
        background-color: #d1ecf1;
    }

    /* Button Styles */
    .btn-primary, .btn-success {
        transition: all 0.3s ease;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    /* Space after table */
    .event-list {
        margin-bottom: 40px; /* Space after event list table */
    }
</style>

</head>

<body>

    <!-- Header Bar -->
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

    <!-- Main Content -->
    <div class="container">
    <h1 class="text-center text-primary mb-4" style="white-space: pre-line;">
    Kalender & Manajemen Waktu
    </h1>
        
        <!-- Button Tambah Event -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addEventModal">
            Tambah Event
        </button>
        
        <!-- Kalender -->
        <div id="calendar"></div>

        <!-- Daftar Event -->
        <div class="event-list mt-5">
            <h3>Daftar Event</h3>
            <table id="eventTable">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Daftar event akan dimuat di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Event -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Tambah Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        <div class="mb-3">
                            <label for="eventTitle" class="form-label">Judul Event</label>
                            <input type="text" class="form-control" id="eventTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventDescription" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="eventDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="eventStart" class="form-label">Waktu Mulai</label>
                            <input type="datetime-local" class="form-control" id="eventStart" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventEnd" class="form-label">Waktu Selesai</label>
                            <input type="datetime-local" class="form-control" id="eventEnd" required>
                        </div>
                        <button type="submit" class="btn btn-success" id="saveEventBtn">Simpan Event</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

    <script>
        var calendar;

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                contentHeight: 'auto', // Menyesuaikan tinggi agar tidak scroll
                aspectRatio: 1.8, // Proporsi kalender agar lebih ramping
                events: '/events',
                eventColor: '#007bff',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                dateClick: function (info) {
                    $('#eventStart').val(info.dateStr);
                    $('#eventEnd').val(info.dateStr);
                    $('#eventTitle').val('');
                    $('#eventDescription').val('');
                }
            });

            calendar.render();
            loadEventList(); // Memuat daftar event setelah kalender dirender
        });

        function loadEventList() {
            $.ajax({
                url: '/events',  // Rute untuk mengambil data events
                type: 'GET',
                success: function (response) {
                    var tableBody = $('#eventTable tbody');
                    tableBody.empty();  // Kosongkan tabel sebelum menambah data baru

                    // Pastikan response adalah array
                    if (Array.isArray(response)) {
                        response.forEach(function (event) {
                            var row = `<tr data-event-id="${event.id}">
                                <td>${event.title}</td>
                                <td>${event.description}</td>
                                <td>${event.start}</td>
                                <td>${event.end}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm editEventBtn">Edit</button>
                                    <button class="btn btn-danger btn-sm deleteEventBtn">Hapus</button>
                                </td>
                            </tr>`;
                            tableBody.append(row);
                        });
                    } else {
                        console.error("Response tidak memiliki format yang diharapkan:", response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Terjadi kesalahan saat mengambil data event:', error);
                }
            });
        }

        $(document).on('click', '.editEventBtn', function () {
            var eventRow = $(this).closest('tr');
            var eventId = eventRow.data('event-id');
            
            // Ambil data event berdasarkan ID
            $.ajax({
                url: '/events/' + eventId,  // Ganti dengan URL untuk mengambil data event
                type: 'GET',
                success: function (event) {
                    // Isi form dengan data event
                    $('#eventTitle').val(event.title);
                    $('#eventDescription').val(event.description);
                    $('#eventStart').val(event.start);
                    $('#eventEnd').val(event.end);

                    // Ubah judul modal dan tombol simpan menjadi "Update Event"
                    $('#addEventModalLabel').text('Edit Event');
                    $('#saveEventBtn').text('Update Event').data('event-id', event.id);  // Menyimpan ID event pada tombol
                    $('#addEventModal').modal('show');
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan',
                        text: 'Gagal mengambil data event',
                    });
                }
            });
        });

        $(document).on('click', '.deleteEventBtn', function () {
            var eventRow = $(this).closest('tr');
            var eventId = eventRow.data('event-id');
            
            // Konfirmasi penghapusan
            Swal.fire({
                title: 'Yakin ingin menghapus event ini?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim permintaan hapus event
                    $.ajax({
                        url: '/events/' + eventId,  // Ganti dengan URL endpoint hapus event
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',  // CSRF token untuk Laravel
                        },
                        success: function () {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Event berhasil dihapus.',
                            });
                            loadEventList();  // Memuat ulang daftar event setelah dihapus
                            calendar.refetchEvents();  // Memperbarui kalender
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus event.',
                            });
                        }
                    });
                }
            });
        });


        
        $(document).ready(function () {
    // Menyimpan event baru
    $('#eventForm').submit(function (e) {
        e.preventDefault();

        var title = $('#eventTitle').val();
        var description = $('#eventDescription').val();
        var start = $('#eventStart').val();
        var end = $('#eventEnd').val();

        // Validasi input
        if (!title || !description || !start || !end) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Semua kolom harus diisi!',
                timer: 3000,
                showConfirmButton: false
            });
            return;
        }

        // Kirim data event ke server
        $.ajax({
            url: '/events',  // Ganti dengan URL endpoint yang benar di server Anda
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',  // Pastikan CSRF token sudah dimasukkan dengan benar
                title: title,
                description: description,
                start: start,
                end: end
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 3000,
                    showConfirmButton: false
                });

                $('#eventForm')[0].reset();  // Reset form setelah pengiriman data
                $('#addEventModal').modal('hide');  // Menutup modal
                calendar.refetchEvents();  // Memperbarui kalender
                loadEventList();  // Memuat ulang daftar event
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan event.',
                    timer: 3000,
                    showConfirmButton: false
                });

                console.error('Error:', error);
            }
        });
    });
});
</script>

</body>

</html>
