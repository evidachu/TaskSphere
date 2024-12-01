



<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="projectModalLabel">Tracking Proyek Kolaborasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <h4 class="mb-3">Progres Proyek</h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                        70% Selesai
                    </div>
                </div>

                <h4 class="mb-3">Daftar Tugas</h4>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Tugas</th>
                            <th>Penanggung Jawab</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh Data -->
                        <tr>
                            <td>1</td>
                            <td>Buat Desain Poster</td>
                            <td>Diana</td>
                            <td>29/11/2024</td>
                            <td><span class="badge bg-warning">Sedang Dikerjakan</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Menulis Laporan Bab 1</td>
                            <td>Budi</td>
                            <td>01/12/2024</td>
                            <td><span class="badge bg-danger">Belum Dimulai</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kumpulkan Data Statistik</td>
                            <td>Andi</td>
                            <td>30/11/2024</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm">Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


