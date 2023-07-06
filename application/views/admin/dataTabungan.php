<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title; ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Siswa Card -->
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Saldo Diterima</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cash"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $saldo['saldo_diterima']; ?></h6>
                                <span class="text-primary small pt-1 fw-bold">Rupiah</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Siswa Card -->
            <!-- saldo masuk Card -->
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Saldo Masuk</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bx bx-arrow-to-bottom"></i>
                            </div>
                            <div class="ps-3">
                                <?php if ($saldo_masuk['saldo_masuk'] == '') {
                                    $jml_sMasuk = 0;
                                } else {
                                    $jml_sMasuk = $saldo_masuk['saldo_masuk'];
                                } ?>
                                <h6><?= $jml_sMasuk; ?></h6>
                                <span class="text-primary small pt-1 fw-bold">Rupiah</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End saldo masuk Card -->
            <!-- saldo keluar Card -->
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Saldo Keluar</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bx bx-arrow-from-bottom"></i>
                            </div>
                            <div class="ps-3">
                                <?php if ($saldo_keluar['saldo_keluar'] == '') {
                                    $jml_sKeluar = 0;
                                } else {
                                    $jml_sKeluar = $saldo_keluar['saldo_keluar'];
                                } ?>
                                <h6><?= $jml_sKeluar; ?></h6>
                                <span class="text-primary small pt-1 fw-bold">Rupiah</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End saldo keluar Card -->

            <!-- Left side columns -->
            <div class="col-lg-11">
                <div class="row">
                    <!-- data siswa -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Tabungan Siswa</h5>
                                <div class="row">
                                    <div class="col d-flex flex-row gap-2 mb-2">
                                        <a href="<?= base_url('admin/print_data_tabungan'); ?>" target="_blank" type="button" class="btn btn-sm btn-outline-primary"><i class="fs-5 bi bi-printer"></i> PRINT</a>
                                        <a href="<?= base_url('admin/pdf_data_tabungan'); ?>" target="_blank" type="button" class="btn btn-sm btn-outline-danger"><i class="fs-5 bi bi-file-earmark-pdf"></i> PDF</a>
                                        <a href="<?= base_url('admin/excel_data_tabungan'); ?>" target="_blink" type="button" class="btn btn-sm btn-outline-success"><i class="fs-5 bi bi-file-earmark-excel"></i> EXCEL</a>
                                    </div>

                                </div>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">No Telepon</th>
                                            <th scope="col">Saldo</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($tabungan as $tab) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></a></th>
                                                <td><?= $tab['nis']; ?></td>
                                                <td><?= $tab['nama']; ?></td>
                                                <td><?= $tab['kelas']; ?></td>
                                                <td><?= $tab['no_telepon']; ?></td>
                                                <td><?= 'Rp. ' . $tab['saldo']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/detailTabungan/' . $tab['id_tabungan']); ?>" class="btn btn-primary btn-sm">Detail</a>
                                                </td>
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