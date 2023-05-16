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
                        <h2><?= $user['nis']; ?></h2>
                        <h3><?= $user['nama']; ?></h3>
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

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8"><?= $user['nama']; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NIS</div>
                                    <div class="col-lg-9 col-md-8"><?= $user['nis']; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Job</div>
                                    <div class="col-lg-9 col-md-8">Admin</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Country</div>
                                    <div class="col-lg-9 col-md-8">Indonesia</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        <img src="<?= base_url('assets/img/user_profile/' . $user['image']); ?>" alt="Profile">
                                        <div class="pt-2">
                                            <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" data-bs-toggle="modal" data-bs-target="#modalEditImg"><i class="bi bi-upload"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <form method="POST" action="<?= base_url('admin/profile'); ?>">
                                    <div class="row mb-3">
                                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                        <input type="hidden" name="is_active" value="<?= $user['is_active']; ?>">
                                        <input type="hidden" name="password" value="<?= $user['password']; ?>">
                                        <input type="hidden" name="image" value="<?= $user['image']; ?>">
                                        <input type="hidden" name="date_created" value="<?= $user['date_created']; ?>">
                                        <input type="hidden" name="nis" value="<?= $user['nis']; ?>">
                                        <input type="hidden" name="role_id" value="<?= $user['role_id']; ?>">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nama" type="text" class="form-control" id="nama" value="<?= $user['nama']; ?>">
                                            <?= form_error('nama', '<small class="text-danger ps-3">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

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