<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?= base_url('assets/img/user_profile/' . $user['image']); ?>" alt="Profile" class="rounded-circle">
                        <h2><?= $user['nama']; ?></h2>
                        <h3><?= $user['nis']; ?></h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">User Profile</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8"><?= $profile['nama']; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NIS</div>
                                    <div class="col-lg-9 col-md-8"><?= $profile['nis']; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Kelas</div>
                                    <div class="col-lg-9 col-md-8"><?= $profile['kelas']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                    <div class="col-lg-9 col-md-8"><?= $profile['jenis_kelamin']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No Telepon</div>
                                    <div class="col-lg-9 col-md-8"><?= $profile['no_telepon']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tahun Masuk</div>
                                    <div class="col-lg-9 col-md-8"><?= $profile['tahun_masuk']; ?></div>
                                </div>
                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="modal fade" id="modalEditImg" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?= base_url('admin/edit_profile_img'); ?>">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="<?= $user['id']; ?>">
                            <input type="hidden" name="is_active" value="<?= $user['is_active']; ?>">
                            <input type="hidden" name="password" value="<?= $user['password']; ?>">
                            <input type="hidden" name="date_created" value="<?= $user['date_created']; ?>">
                            <input type="hidden" name="email" value="<?= $user['email']; ?>">
                            <input type="hidden" name="role_id" value="<?= $user['role_id']; ?>">
                            <input type="hidden" name="nama" value="<?= $user['nama']; ?>">
                            <div class="col-lg-11">
                                <input name="image" type="file">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form><!-- End Profile Edit Form -->
            </div>
        </div>
    </div>

</main><!-- End #main -->