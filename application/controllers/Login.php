<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->library('form_validation');
    }

    function index() {
        $this->load->view('v_login');
    }

    function aksi() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() != false) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $where = array(
                'pengguna_username' => $username,
                'pengguna_password' => md5($password),
                'pengguna_status'   => '1'
            );

            $cek = $this->m_login->cek_login("pengguna", $where);

            if ($cek->num_rows() > 0) {
                $data = $cek->row();

                $data_session = array(
                    'id'       => $data->pengguna_id,
                    'username' => $data->pengguna_username,
                    'level'    => $data->pengguna_level,
                    'status'   => 'telah_login'
                );

                $this->session->set_userdata($data_session);
                redirect('dashboard');
            } else {
                redirect('login?alert=gagal');
            }
        } else {
            $this->load->view('v_login');
        }
    }
}
?>
