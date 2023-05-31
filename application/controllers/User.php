<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    function index()
    {
        $nis = $this->session->userdata('nis');
        $data = [
            'title' => "Dashboard",
            'topbar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'sidebar' => $this->ModelUser->cekUser(['nis' => $nis])->row_array(),
            'tabungan' => $this->ModelTabungan->cekTabungan(['nis' => $nis])->row_array(),
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
            $config['allowed_types'] = 'jpg|png';
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
}
