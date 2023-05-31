<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    function index()
    {
        $nis = $this->session->userdata('nis');
        $data = [
            'title' => "Dashboard",
            'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'siswa' => $this->ModelSiswa->getSiswa()->result_array(),
            'jmlSiswa' => $this->ModelSiswa->getSiswa()->num_rows(),
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin_footer', $data);
    }

    function dataSiswa()
    {
        $nis = $this->session->userdata('nis');
        $data = [
            'title' => "Data Siswa",
            'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'siswa' => $this->ModelSiswa->getSiswa()->result_array(),
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/dataSiswa', $data);
        $this->load->view('templates/admin_footer', $data);
    }

    public function tambahSiswa()
    {
        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|is_unique[user.nis]', [
            'required' => 'Masukan NIS.',
            'is_unique' => 'NIS sudah ada.'
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Masukan Nama.'
        ]);
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required', [
            'required' => 'Masukan No Telepon.'
        ]);

        if ($this->form_validation->run() == false) {
            $nis = $this->session->userdata('nis');
            $data = [
                'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                'title' => 'Tambah Siswa'
            ];

            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/tambahSiswa', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $nis = $this->input->post('nis', true);
            $dataSiswa = [
                'nis' => htmlspecialchars($nis),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'no_telepon' => htmlspecialchars($this->input->post('no_telepon', true)),
                'kelas' => $this->input->post('kelas'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tahun_masuk' => $this->input->post('tahun_masuk'),
            ];
            $this->ModelSiswa->tambahSiswa($dataSiswa);
            $dataUser = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'nis' => htmlspecialchars($nis),
                'image' => 'default.jpg',
                'password' => password_hash(
                    'sitasi2023',
                    PASSWORD_DEFAULT
                ),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->ModelUser->simpanData($dataUser);

            $dataTabungan = [
                'nis' => htmlspecialchars($nis),
            ];
            $this->ModelTabungan->tambahTabungan($dataTabungan);

            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                <b>Sukses!</b> Siswa baru telah ditambahkan.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
            );
            redirect('admin/dataSiswa');
        }
    }

    function dataTransaksi()
    {
        $nis = $this->session->userdata('nis');
        $data = [
            'title' => "Data Transaksi",
            'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'setoran_proses' => $this->ModelTransaksi->cekTransaksi([
                'jenis_transaksi' => 'Setoran',
                'status' => 'Diproses'
            ])->result_array(),
            'penarikan_proses' => $this->ModelTransaksi->cekTransaksi([
                'jenis_transaksi' => 'Penarikan',
                'status' => 'Diproses'
            ])->result_array(),

        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/dataTransaksi', $data);
        $this->load->view('templates/admin_footer', $data);
    }

    function detailSetoran($id_transaksi)
    {
        $nis = $this->session->userdata('nis');

        $data = [
            'title' => "Detail Setoran",
            'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'transaksi' => $this->ModelTransaksi->cekTransaksi([
                'id_transaksi' => $id_transaksi
            ])->row_array(),
            'tabungan' => $this->db->query(
                "SELECT tabungan.id_tabungan, tabungan.nis, tabungan.saldo
                FROM tabungan
                INNER JOIN transaksi ON tabungan.id_tabungan = transaksi.id_tabungan
                WHERE transaksi.id_transaksi= " . $id_transaksi
            )->row_array(),
            'siswa' => $this->db->query(
                "SELECT siswa.nis, siswa.no_telepon, user.nama
                FROM siswa
                JOIN user ON siswa.nis = user.nis
                JOIN transaksi ON user.id = transaksi.id_user
                WHERE transaksi.id_transaksi= " . $id_transaksi
            )->row_array(),

        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/detail_setoran', $data);
        $this->load->view('templates/admin_footer', $data);
    }

    function terimaSetoran($id_transaksi)
    {
        $id_user = $this->input->post('id_user');
        $id_tabungan = $this->input->post('id_tabungan');
        $jenis_transaksi = $this->input->post('jenis_transaksi');
        $nominal = $this->input->post('nominal', true);
        $metode_pembayaran = $this->input->post('metode_pembayaran');
        $status = 'Diterima';
        $bukti = $this->input->post('bukti');
        $tanggal = $this->input->post('tanggal');
        $dataTransaksi = array(
            'id_user' => $id_user,
            'jenis_transaksi' => $jenis_transaksi,
            'nominal' => $nominal,
            'metode_pembayaran' => $metode_pembayaran,
            'bukti' => $bukti,
            'status' => $status,
            'id_tabungan' => $id_tabungan,
            'tanggal' => $tanggal
        );
        $this->ModelTransaksi->updateTransaksi($dataTransaksi);
        $nis = $this->input->post('nis');
        $old_saldo = $this->input->post('saldo');
        $saldo = $old_saldo + $nominal;
        $dataTabungan = array(
            'nis' => $nis,
            'saldo' => $saldo,
        );
        $this->ModelTabungan->updateTabungan($dataTabungan);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    <b>Sukses!</b> Transaksi telah diproses.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
        );
        redirect('admin/dataTransaksi');
    }

    function tolakSetoran($id_transaksi)
    {
        $id_user = $this->input->post('id_user');
        $id_tabungan = $this->input->post('id_tabungan');
        $jenis_transaksi = $this->input->post('jenis_transaksi');
        $nominal = $this->input->post('nominal', true);
        $metode_pembayaran = $this->input->post('metode_pembayaran');
        $status = 'Ditolak';
        $bukti = $this->input->post('bukti');
        $tanggal = $this->input->post('tanggal');
        $dataTransaksi = array(
            'id_user' => $id_user,
            'jenis_transaksi' => $jenis_transaksi,
            'nominal' => $nominal,
            'metode_pembayaran' => $metode_pembayaran,
            'bukti' => $bukti,
            'status' => $status,
            'id_tabungan' => $id_tabungan,
            'tanggal' => $tanggal
        );
        $this->ModelTransaksi->updateTransaksi($dataTransaksi);

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    <b>Sukses!</b> Transaksi telah ditolak.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
        );
        redirect('admin/dataTransaksi');
    }



    public function profile()
    {

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
            'required' => 'Nama belum diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $nis = $this->session->userdata('nis');
            $data = [
                'title' => 'Profile',
                'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                'user' => $this->ModelUser->cekUser(['nis' => $nis])->row_array()
            ];

            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/profile', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'id' => $this->input->post('id'),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'image' => $this->input->post('image'),
                'password' => $this->input->post('password'),
                'role_id' => $this->input->post('role_id'),
                'is_active' => $this->input->post('is_active'),
                'date_created' => $this->input->post('date_created')
            ];

            $this->ModelUser->editProfile_proses($data);
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    <b>Sukses!</b> Profil telah diperbarui.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/profile');
        }
    }

    public function cetakTransaksi()
    {
        $nis = $this->session->userdata('nis');
        // $transaksi = $this->ModelTransaksi->cekTransaksi([
        //     'id_transaksi' => $id,
        // ]);
        $data = [
            'title' => "Cetak Transaksi",
            // 'transaksi' => $transaksi,
        ];
        $this->load->view('admin/cetakTransaksi', $data);
    }
}
