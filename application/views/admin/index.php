<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title; ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-11">
                <div class="row">

                    <!-- User Card -->
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
                    </div><!-- End User Card -->

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