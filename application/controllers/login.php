<?php
defined('BASEPATH') OR exit ('No direct script acces allowed');
class login extends CI_Controller{

    function __consturct(){
        parent:: __consturct();
        $this->load->model->('m_login');
        $this->load->library('session');
    }

if ($data['username'] && $password==$data['password']){

    // jika sesuai, maka buat session
        $_SESSION['username'] = $data['username'];
		$_SESSION['nama'] = $data['nama'];
        $_SESSION['hak_akses'] = $data['hak_akses'];
        if($data['hak_akses']=="Admin"){
            header("location:../home-admin.php");
        }else if($data['hak_akses']=="Member"){
            header("location:../home-member.php");
        }
}
else{
		?>
		<script language="JavaScript">
			alert('Username atau Password tidak sesuai. Silahkan diulang kembali!');
			document.location='../index.php';
		</script>
		<?php
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(base_url('login/'));
    }
}
?>