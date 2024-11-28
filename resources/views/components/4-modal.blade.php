<!-- resources/views/components/team-calendar-modal.blade.php -->
<div class="modal fade" id="teamCommunicationModal" tabindex="-1" aria-labelledby="teamCommunicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="teamCommunicationModalLabel">Kalender & Manajemen Waktu Kolaboratif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body">
                <!-- Kalender -->
                <div id="calendar" class="mb-4"></div>

                <!-- Form Tambah Event -->
                <h4 class="mt-4">Tambah Event</h4>
                <form id="eventForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Judul Event</label>
                        <input type="text" class="form-control" id="eventTitle" required>
                        <div class="invalid-feedback">Judul event tidak boleh kosong.</div>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="eventDescription" rows="3" required></textarea>
                        <div class="invalid-feedback">Deskripsi event tidak boleh kosong.</div>
                    </div>
                    <div class="mb-3">
                        <label for="eventStart" class="form-label">Waktu Mulai</label>
                        <input type="datetime-local" class="form-control" id="eventStart" required>
                        <div class="invalid-feedback">Waktu mulai tidak boleh kosong.</div>
                    </div>
                    <div class="mb-3">
                        <label for="eventEnd" class="form-label">Waktu Selesai</label>
                        <input type="datetime-local" class="form-control" id="eventEnd" required>
                        <div class="invalid-feedback">Waktu selesai tidak boleh kosong.</div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan Event</button>
                </form>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />

<!-- Tambahkan di bagian akhir file modal -->
@push('scripts')
<script>
    var calendar; // Variabel untuk kalender

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        
        // Inisialisasi kalender
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '/events', // Menarik event dari server (lihat bagian backend)
            eventColor: '#007bff', // Warna event
            headerToolbar: {
                left: 'prev,next today', // Tombol navigasi sebelumnya, berikutnya, dan hari ini
                center: 'title', // Judul bulan di tengah
                right: 'dayGridMonth,dayGridWeek,dayGridDay' // Tampilan bulan, minggu, dan hari
            },
            dateClick: function(info) {
                // Tampilkan form ketika klik tanggal
                $('#eventStart').val(info.dateStr);  // Set waktu mulai ke tanggal yang dipilih
                $('#eventEnd').val(info.dateStr);    // Set waktu selesai ke tanggal yang dipilih
                $('#eventTitle').val('');            // Kosongkan form judul
                $('#eventDescription').val('');      // Kosongkan form deskripsi
            }
        });

        // Render kalender
        calendar.render();
    });

    // Render ulang kalender setelah modal dibuka
    $('#teamCommunicationModal').on('shown.bs.modal', function () {
        calendar.render();  // Render ulang kalender saat modal dibuka
    });

 // AJAX untuk menyimpan event baru
 $('#eventForm').submit(function(e) {
            e.preventDefault();  // Mencegah form dikirim secara default

            // Ambil nilai form
            var title = $('#eventTitle').val();
            var description = $('#eventDescription').val();
            var start = $('#eventStart').val();
            var end = $('#eventEnd').val();

            // Periksa apakah form valid
            var isValid = true;
            if (!title || !description || !start || !end) {
                isValid = false;
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Semua kolom harus diisi!',
                    timer: 3000,
                    showConfirmButton: false
                });
            }

            // Jika form valid, kirim data menggunakan AJAX
            if (isValid) {
                $.ajax({
                    url: '/events',  // Endpoint untuk menyimpan event
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',  // CSRF token untuk Laravel
                        title: title,
                        description: description,
                        start: start,
                        end: end
                    },
                    success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                    $('#eventForm')[0].reset();  // Reset form
                    $('#teamCommunicationModal').modal('hide');  // Menutup modal
                    $('body').removeClass('modal-open');  // Hapus kelas modal-open
                    $('.modal-backdrop').remove();  // Hapus backdrop modal
                    calendar.refetchEvents();  // Refresh kalender

                    // Reload halaman untuk memastikan data terbaru ditampilkan
                    location.reload();  // Ini akan memuat ulang halaman dan memastikan perubahan diterapkan
                },

                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat menyimpan event.');
                    }
                });
            }
        });
    
</script>
@endpush


<!-- Tambahkan CSS kustom untuk kalender dan modal -->
<style>
    /* Kalender FullCalendar */
    #calendar {
        max-width: 100%;
        margin: 0 auto;
        height: 450px; /* Tinggi kalender yang lebih besar */
        border-radius: 10px; /* Sudut yang lebih melengkung */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
    }

    /* Mengubah tampilan tanggal di dalam kalender */
    .fc-daygrid-day-number {
        font-size: 1.2rem; /* Ukuran font tanggal lebih besar */
        font-weight: bold;
        color: #333; /* Warna teks lebih gelap */
    }

    .fc-daygrid-day {
        border-radius: 8px; /* Sudut melengkung pada hari-hari kalender */
        background-color: #f5f5f5; /* Warna latar belakang lebih terang */
        transition: background-color 0.2s ease; /* Animasi saat hover */
    }

    /* Hover pada hari kalender */
    .fc-daygrid-day:hover {
        background-color: #e0e0e0; /* Warna latar belakang saat hover */
    }

    /* Header bulan */
    .fc-toolbar-title {
        font-size: 1.5rem; /* Ukuran font lebih besar pada judul bulan */
        font-weight: bold;
        color: #007bff; /* Warna biru pada judul bulan */
    }

    /* Menambahkan garis bawah untuk header */
    .fc-toolbar {
        border-bottom: 2px solid #007bff; /* Garis bawah biru untuk header */
        margin-bottom: 20px;
    }

    /* Button navigasi sebelumnya/berikutnya */
    .fc-button {
        background-color: #007bff; /* Warna biru */
        border-radius: 5px;
        color: white;
        padding: 5px 10px;
        border: none;
        transition: background-color 0.3s ease;
    }

    .fc-button:hover {
        background-color: #0056b3; /* Warna biru lebih gelap saat hover */
    }

    /* Menambahkan beberapa ruang di sekitar form */
    .modal-body {
        padding: 30px;
    }
</style>

