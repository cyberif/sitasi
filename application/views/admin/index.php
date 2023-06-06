<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title; ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Siswa Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Siswa</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $jmlSiswa; ?></h6>
                                        <span class="text-primary small pt-1 fw-bold">Results</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Siswa Card -->
                    <!-- Proses Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Permintaan Proses</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bxs-hourglass-bottom"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $jmlProses; ?></h6>
                                        <span class="text-primary small pt-1 fw-bold">Transaksi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Proses Card -->
                    <!-- Laporan Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body mx-auto">
                                <h5 class="card-title">Laporan Transaksi <span class="badge bg-primary text-light">Diproses</span></h5>
                                <div class="row">
                                    <div class="col d-flex flex-row gap-2 mb-2">
                                        <a href="<?= base_url('admin/print_transaksi/Diproses'); ?>" target="_blink" type="button" class="btn btn-sm btn-outline-primary"><i class="fs-5 bi bi-printer"></i> PRINT</a>
                                        <a href="<?= base_url('admin/pdf_transaksi/Diproses'); ?>" target="_blink" type="button" class="btn btn-sm btn-outline-danger"><i class="fs-5 bi bi-file-earmark-pdf"></i> PDF</a>
                                        <a href="<?= base_url('admin/excel_transaksi/Diproses'); ?>" target="_blink" type="button" class="btn btn-sm btn-outline-success"><i class="fs-5 bi bi-file-earmark-excel"></i> EXCEL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Laporan Card -->
                    <!-- Laporan Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body mx-auto">
                                <h5 class="card-title">Laporan Transaksi <span class="badge bg-success text-light">Diterima</span></h5>
                                <div class="row">
                                    <div class="col d-flex flex-row gap-2 mb-2">
                                        <a href="<?= base_url('admin/print_transaksi/Diterima'); ?>" target="_blink" type="button" class="btn btn-sm btn-outline-primary"><i class="fs-5 bi bi-printer"></i> PRINT</a>
                                        <a href="<?= base_url('admin/pdf_transaksi/Diterima'); ?>" target="_blink" type="button" class="btn btn-sm btn-outline-danger"><i class="fs-5 bi bi-file-earmark-pdf"></i> PDF</a>
                                        <a href="<?= base_url('admin/excel_transaksi/Diterima'); ?>" target="_blink" type="button" class="btn btn-sm btn-outline-success"><i class="fs-5 bi bi-file-earmark-excel"></i> EXCEL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Laporan Card -->
                    <!-- Laporan Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body mx-auto">
                                <h5 class="card-title">Laporan Transaksi <span class="badge bg-danger text-light">Ditolak</span></h5>
                                <div class="row">
                                    <div class="col d-flex flex-row gap-2 mb-2">
                                        <a href="<?= base_url('admin/print_transaksi/Ditolak'); ?>" target="_blink" type="button" class="btn btn-sm btn-outline-primary"><i class="fs-5 bi bi-printer"></i> PRINT</a>
                                        <a href="<?= base_url('admin/pdf_transaksi/Ditolak'); ?>" target="_blink" type="button" class="btn btn-sm btn-outline-danger"><i class="fs-5 bi bi-file-earmark-pdf"></i> PDF</a>
                                        <a href="<?= base_url('admin/excel_transaksi/Ditolak'); ?>" target="_blink" type="button" class="btn btn-sm btn-outline-success"><i class="fs-5 bi bi-file-earmark-excel"></i> EXCEL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Laporan Card -->

                    <!-- User -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Siswa</h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">No Telepon</th>
                                            <th scope="col">Tahun Masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($siswa as $s) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></a></th>
                                                <td><?= $s['nis']; ?></td>
                                                <td><?= $s['nama']; ?></td>
                                                <td><?= $s['kelas']; ?></td>
                                                <td><?= $s['jenis_kelamin']; ?></td>
                                                <td><?= $s['no_telepon']; ?></td>
                                                <td><?= $s['tahun_masuk']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End User -->
                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>

</main><!-- End #main -->