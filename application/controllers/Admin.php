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
            'ts_proses' => $this->ModelTransaksi->cekTransaksi([
                'jenis_transaksi' => 'Setoran',
                'status' => 'Diproses'
            ])->result_array(),
            'ts_tolak' => $this->ModelTransaksi->cekTransaksi([
                'jenis_transaksi' => 'Setoran',
                'status' => 'Ditolak'
            ])->result_array(),
            'ts_terima' => $this->ModelTransaksi->cekTransaksi([
                'jenis_transaksi' => 'Setoran',
                'status' => 'Diterima'
            ])->result_array(),
            'tp_proses' => $this->ModelTransaksi->cekTransaksi([
                'jenis_transaksi' => 'Penarikan',
                'status' => 'Diproses'
            ])->result_array(),
            'tp_tolak' => $this->ModelTransaksi->cekTransaksi([
                'jenis_transaksi' => 'Penarikan',
                'status' => 'Ditolak'
            ])->result_array(),
            'tp_terima' => $this->ModelTransaksi->cekTransaksi([
                'jenis_transaksi' => 'Penarikan',
                'status' => 'Diterima'
            ])->result_array(),
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/dataTransaksi', $data);
        $this->load->view('templates/admin_footer', $data);
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
}
