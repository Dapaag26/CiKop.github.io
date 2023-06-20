<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('M_login');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function aksi_login(){
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
    
        // Set aturan validasi
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // Ambil data dari form
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            
            // Panggil model untuk melakukan proses otentikasi
            $user = $this->M_login->login($username, $password);
            
            if ($user) {
                // Simpan data pengguna dalam session
                $user_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'logged_in' => TRUE
                );
            
                $this->session->set_userdata($user_data);
                
                // Redirect sesuai peran pengguna (admin atau member)
                if ($user->role == 'admin') {
                    redirect('home-admin');
                } else {
                    redirect('home-member');
                }
            } else {
                // Jika otentikasi gagal, tampilkan pesan error
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('login');
            }
        } else {
            // Tampilkan halaman login
            $this->load->view('login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}
?>
