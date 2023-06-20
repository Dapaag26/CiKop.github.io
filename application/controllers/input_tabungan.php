<body bgcolor="#EEF2F7">
<?php

	defined('BASEPATH') OR exit ('No direct script acces allowed');
	class intput_tabungan extends CI_Controller{
		
	    public function aksi_login(){
			if ($this->session->userdata('logged_in')) {
				redirect('dashboard');
			}
	if (empty($_POST['jml_tabungan'])) {
	?>
		<script language="JavaScript">
			alert('Masukan Jumlah tabungan!');
			document.location='home-admin.php?page=list-tabungan';
		</script>
	<?php
	}
	else {
	//Masukan data ke Table tabungan
	$input	="INSERT INTO tabungan (username, nama, tgl_tabungan, jml_tabungan) VALUES ('$username','$nama','$tgl_tabungan','$jml_tabungan')";
	$query_input =mysql_query($input);
	//Update tabungan di tabel member
	$update="UPDATE member SET tabungan=tabungan + $jml_tabungan WHERE username='$username'";
	$query_update =mysql_query($update);
		if ($query_update) {
		//Jika Sukses
	?>
		<script language="JavaScript">
		alert('Data tabungan Berhasil Diinput!');
		document.location='home-admin.php?page=list-tabungan';
		</script>
	<?php
	}
	else {
	//Jika Gagal
	echo "tabungan Gagal Diinput, Silahkan diulangi!";
	}
	}
}
	//Tutup koneksi engine MySQL
	mysqli_close($open);
}
?>
</body>