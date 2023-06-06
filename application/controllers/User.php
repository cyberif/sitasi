<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation'));
        cek_login();
    }

    function index()
    {
        $nis = $this->session->userdata('nis');
        $query = "SELECT * FROM transaksi
        JOIN user ON user.id = transaksi.id_user
        WHERE transaksi.status = 'Diproses' AND user.nis = " . $nis;

        $data = [
            'title' => "Dashboard",
            'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'sidebar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'tabungan' => $this->ModelTabungan->cekTabungan(['nis' => $nis])->row_array(),
            'transaksi' => $this->db->query($query)->result_array(),
            'jml_ptransaksi' => $this->db->query($query)->num_rows(),

        ];
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/user_footer', $data);
    }

    public function setoran($id)
    {
        $this->form_validation->set_rules('nominal', 'nominal', 'required', [
            'required' => 'Masukan Nominal.'
        ]);

        if ($this->form_validation->run() == false) {
            $nis = $this->session->userdata('nis');
            $data = [
                'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                'sidebar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                'tabungan' => $this->ModelTabungan->cekTabungan(['nis' => $nis])->row_array(),
                'title' => 'Setoran',
            ];
            $this->load->model('ModelTransaksi');
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/setoran', $data);
            $this->load->view('templates/user_footer');
        } else {
            $id_user = $this->input->post('id_user');
            $id_tabungan = $this->input->post('id_tabungan');
            $jenis_transaksi = 'Setoran';
            $nominal = $this->input->post('nominal', true);
            $metode_pembayaran = $this->input->post('metode_pembayaran');
            $status = 'Diproses';
            $tanggal = time();
            $file_name = str_replace('.', '', $id_user . $tanggal);
            $config['upload_path'] = FCPATH . './uploads/bukti/';
            $config['file_name'] = $file_name;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 2048;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('bukti')) {
                $nis = $this->session->userdata('nis');
                $data = [
                    'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                    'sidebar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                    'tabungan' => $this->ModelTabungan->cekTabungan(['nis' => $nis])->row_array(),
                    'title' => 'Setoran',
                ];

                $this->load->view('templates/user_header', $data);
                $this->load->view('user/topbar', $data);
                $this->load->view('user/sidebar', $data);
                $this->load->view('user/setoran', $data);
                $this->load->view('templates/user_footer');
                $error = $this->upload->display_errors();
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                    <i class="bi bi-cross-circle me-1"></i>' . $error
                        .
                        '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
                );
            } else {
                $dataTransaksi = array(
                    'id_user' => $id_user,
                    'jenis_transaksi' => $jenis_transaksi,
                    'nominal' => $nominal,
                    'metode_pembayaran' => $metode_pembayaran,
                    'bukti' => $this->upload->data('file_name'),
                    'status' => $status,
                    'id_tabungan' => $id_tabungan,
                    'tanggal' => $tanggal
                );
                $this->ModelTransaksi->tambahTransaksi($dataTransaksi);
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    <b>Sukses!</b> Transaksi anda sedang diproses. Harap tunggu.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
                );
                redirect('user/riwayat/' . $id);
            }
        }
    }

    public function penarikan($id)
    {
        $this->form_validation->set_rules('nominal', 'nominal', 'required', [
            'required' => 'Masukan Nominal.'
        ]);


        if ($this->form_validation->run() == false) {
            $nis = $this->session->userdata('nis');
            $data = [
                'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                'sidebar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                'tabungan' => $this->ModelTabungan->cekTabungan(['nis' => $nis])->row_array(),
                'title' => 'Penarikan',
            ];
            $this->load->model('ModelTransaksi');
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/penarikan', $data);
            $this->load->view('templates/user_footer');
        } else {
            $id_user = $this->input->post('id_user');
            $nominal = $this->input->post('nominal', true);
            $id_tabungan = $this->input->post('id_tabungan');
            $jenis_transaksi = 'Penarikan';
            $nominal = $this->input->post('nominal', true);
            $metode_pembayaran = $this->input->post('metode_pembayaran');
            $status = 'Diproses';
            $tanggal = time();
            $dataTransaksi = array(
                'id_user' => $id_user,
                'jenis_transaksi' => $jenis_transaksi,
                'nominal' => $nominal,
                'metode_pembayaran' => $metode_pembayaran,
                'bukti' => '',
                'status' => $status,
                'id_tabungan' => $id_tabungan,
                'tanggal' => $tanggal
            );

            $saldo = $this->input->post('saldo');
            if ($nominal > $saldo) {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle me-1"></i>
                            <b>Gagal!</b> Saldo tidak cukup.
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>'
                );
                redirect('user/penarikan/' . $id);
            } else {
                $this->ModelTransaksi->tambahTransaksi($dataTransaksi);
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            <b>Sukses!</b> Transaksi anda sedang diproses. Harap tunggu.
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>'
                );
                redirect('user/riwayat/' . $id);
            }
        };
    }

    function riwayat($id)
    {
        $nis = $this->session->userdata('nis');
        $data = [
            'title' => "Riwayat",
            'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'sidebar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'uang_masuk' => $this->db->query(
                "SELECT SUM(nominal) AS uang_masuk FROM transaksi 
                WHERE id_user = " . $id . " AND jenis_transaksi = 'Setoran' AND status = 'Diterima'"
            )->row_array(),
            'uang_keluar' => $this->db->query(
                "SELECT SUM(nominal) AS uang_keluar FROM transaksi 
                WHERE id_user = " . $id . " AND jenis_transaksi = 'Penarikan' AND status = 'Diterima'"
            )->row_array(),
            'transaksi_proses' => $this->ModelTransaksi->cekTransaksi([
                'id_user' => $id,
                'status' => 'Diproses'
            ])->result_array(),
            'transaksi_terima' => $this->ModelTransaksi->cekTransaksi([
                'id_user' => $id,
                'status' => 'Diterima'
            ])->result_array(),
            'transaksi_tolak' => $this->ModelTransaksi->cekTransaksi([
                'id_user' => $id,
                'status' => 'Ditolak'
            ])->result_array(),
        ];
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/riwayat', $data);
        $this->load->view('templates/user_footer', $data);
    }

    public function detailRiwayat($id_transaksi)
    {
        $nis = $this->session->userdata('nis');
        $data = [
            'title' => "Detail Riwayat",
            'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'sidebar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'transaksi' => $this->ModelTransaksi->cekTransaksi([
                'id_transaksi' => $id_transaksi
            ])->row_array(),
            'siswa' => $this->db->query(
                "SELECT siswa.nis, siswa.no_telepon, user.nama
                FROM siswa
                JOIN user ON siswa.nis = user.nis
                JOIN transaksi ON user.id = transaksi.id_user
                WHERE transaksi.id_transaksi= " . $id_transaksi
            )->row_array(),
        ];
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/detail_riwayat', $data);
        $this->load->view('templates/user_footer', $data);
    }

    public function print_t_diproses($id)
    {
        $nis = $this->session->userdata('nis');
        $query = "SELECT * FROM transaksi
        JOIN user ON user.id = transaksi.id_user
        JOIN siswa ON siswa.nis = user.nis
        WHERE transaksi.status = 'Diproses' AND user.id = " . $id;
        $data = [
            'title' => "Cetak Riwayat - Diproses",
            'transaksi' => $this->db->query($query)->result_array(),
        ];
        $this->load->view('user/print_transaksi', $data);
    }

    public function print_t_diterima($id)
    {
        $nis = $this->session->userdata('nis');
        $query = "SELECT * FROM transaksi
        JOIN user ON user.id = transaksi.id_user
        JOIN siswa ON siswa.nis = user.nis
        WHERE transaksi.status = 'Diterima' AND user.id = " . $id;
        $data = [
            'title' => "Cetak Riwayat - Diterima",
            'transaksi' => $this->db->query($query)->result_array(),
        ];
        $this->load->view('user/print_transaksi', $data);
    }

    public function print_t_ditolak($id)
    {
        $nis = $this->session->userdata('nis');
        $query = "SELECT * FROM transaksi
        JOIN user ON user.id = transaksi.id_user
        JOIN siswa ON siswa.nis = user.nis
        WHERE transaksi.status = 'Ditolak' AND user.id = " . $id;
        $data = [
            'title' => "Cetak Riwayat - Ditolak",
            'transaksi' => $this->db->query($query)->result_array(),
        ];
        $this->load->view('user/print_transaksi', $data);
    }
    public function pdf_t_diproses($id)
    {
        $this->load->library('Dompdf_gen');

        $query = "SELECT * FROM transaksi
        JOIN user ON user.id = transaksi.id_user
        JOIN siswa ON siswa.nis = user.nis
        WHERE transaksi.status = 'Diproses' AND user.id = " . $id;

        $data = [
            'transaksi' => $this->db->query($query)->result_array(),
        ];

        $this->load->view('user/pdf_transaksi', $data);

        $paper = 'A4';
        $orien = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper, $orien);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_transaksi_diproses.pdf');
    }

    public function pdf_t_diterima($id)
    {
        $this->load->library('Dompdf_gen');

        $query = "SELECT * FROM transaksi
        JOIN user ON user.id = transaksi.id_user
        JOIN siswa ON siswa.nis = user.nis
        WHERE transaksi.status = 'Diterima' AND user.id = " . $id;
        $data = [
            'transaksi' => $this->db->query($query)->result_array(),
        ];
        $this->load->view('user/pdf_transaksi', $data);

        $paper = 'A4';
        $orien = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper, $orien);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_transaksi_diterima.pdf');
    }

    public function pdf_t_ditolak($id)
    {
        $this->load->library('Dompdf_gen');

        $query = "SELECT * FROM transaksi
        JOIN user ON user.id = transaksi.id_user
        JOIN siswa ON siswa.nis = user.nis
        WHERE transaksi.status = 'Ditolak' AND user.id = " . $id;
        $data = [
            'transaksi' => $this->db->query($query)->result_array(),
        ];
        $this->load->view('user/pdf_transaksi', $data);

        $paper = 'A4';
        $orien = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper, $orien);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_transaksi_ditolak.pdf');
    }

    public function excel_t_diproses($id)
    {
        $query = "SELECT * FROM transaksi
        JOIN user ON user.id = transaksi.id_user
        JOIN siswa ON siswa.nis = user.nis
        WHERE transaksi.status = 'Diproses' AND user.id = " . $id;
        $data = [
            'transaksi' => $this->db->query($query)->result_array(),
            'filename' => "Laporan Transaksi Diproses",
        ];
        $this->load->view('user/excel_transaksi', $data);
    }

    public function excel_t_diterima($id)
    {
        $query = "SELECT * FROM transaksi
        JOIN user ON user.id = transaksi.id_user
        JOIN siswa ON siswa.nis = user.nis
        WHERE transaksi.status = 'Diterima' AND user.id = " . $id;
        $data = [
            'transaksi' => $this->db->query($query)->result_array(),
            'filename' => "Laporan Transaksi Diterima",
        ];
        $this->load->view('user/excel_transaksi', $data);
    }

    public function excel_t_ditolak($id)
    {
        $query = "SELECT * FROM transaksi
        JOIN user ON user.id = transaksi.id_user
        JOIN siswa ON siswa.nis = user.nis
        WHERE transaksi.status = 'Ditolak' AND user.id = " . $id;
        $data = [
            'transaksi' => $this->db->query($query)->result_array(),
            'filename' => "Laporan Transaksi Ditolak",
        ];
        $this->load->view('user/excel_transaksi', $data);
    }

    public function profile()
    {

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
            'required' => 'Nama belum diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $nis = $this->session->userdata('nis');
            $query = "SELECT * FROM siswa
        JOIN user ON siswa.nis = user.nis
        WHERE siswa.nis = " . $nis;
            $data = [
                'title' => 'Profile',
                'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                'user' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                'sidebar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
                'profile' => $this->db->query($query)->row_array()
            ];

            $this->load->view('templates/user_header', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/profile', $data);
            $this->load->view('templates/user_footer');
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
            redirect('user/profile');
        }
    }
}
