<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('user'); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-heading">Transaksi</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('user/setoran/' . $sidebar['id']); ?>">
                <i class="bi bi-cash-coin"></i>
                <span>Setoran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('user/penarikan/' . $sidebar['id']); ?>">
                <i class="ri ri-currency-fill"></i>
                <span>Penarikan</span>
            </a>
        </li>

        <li class="nav-heading">Riwayat</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('user/riwayat/' . $sidebar['id']); ?>">
                <i class="ri ri-history-line"></i>
                <span>Riwayat</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->