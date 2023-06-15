<?php
defined('BASEPATH') OR exit ('No direct script acces allowed');
class login extends CI_Controller{

    function __consturct(){
        parent:: __consturct();
        $this->load->model->('m_login');
        $this->load->library('session');
    }
// Sesion Di jalankan
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
// membuat koneksi Ke MYSQL dan Database, Sesuaikan Dengan pengaturan di tempat anda 
$koneksi=mysql_connect("localhost", "root", "");
$db=mysql_select_db("koperasi_new",$koneksi);

// mencari password berdasarkan username
$query = "SELECT * FROM login WHERE username = '$username'";
$hasil = mysql_query($query) or die("Error");
$data  = mysql_fetch_array($hasil);

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