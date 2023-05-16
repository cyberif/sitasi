<style>
    .bukti {
        width: 90px;
        height: 120px;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title; ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-11">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="row">
                    <!-- data Transaksi Diproses -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Setoran Diproses</h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ID User</th>
                                            <th scope="col">Nominal</th>
                                            <th scope="col">Metode Pembayaran</th>
                                            <th scope="col">Bukti</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($ts_proses as $ts_pro) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></a></th>
                                                <td><?= $ts_pro['id_user']; ?></td>
                                                <td><?= $ts_pro['nominal']; ?></td>
                                                <td><?= $ts_pro['metode_pembayaran']; ?></td>
                                                <td><img class="bukti" src="<?= base_url('./uploads/bukti/' . $ts_pro['bukti']); ?>" alt="<?= $ts_pro['bukti']; ?>"></td>
                                                <td><?= date('d/F/Y - G:i:s', $ts_pro['tanggal']); ?></td>
                                                <td><a href="https://youtube.com" target="_blank" rel="noopener noreferrer">Lihat Detail</a></td>
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