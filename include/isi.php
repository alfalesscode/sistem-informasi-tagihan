<?php 


		$page = $_GET['page'];
		$aksi = $_GET['aksi'];

		if ($page == "paket") {
			if ($aksi == "") {
				include "page/paket/paket.php";
			}

			

			if ($aksi == "hapus") {
				include "page/paket/hapus.php";
			}	
		}


			if ($page == "laporan") {
			if ($aksi == "") {
				include "page/laporan/laporan.php";
			}

			}


		if ($page == "profile") {
			if ($aksi == "") {
				include "page/profile/profile.php";

			 }
	
	
		}

		
		if ($page == "pelanggan") {
			if ($aksi == "") {
				include "page/pelanggan/pelanggan.php";
			}

			

			if ($aksi == "hapus") {
				include "page/pelanggan/hapus.php";
			}
		}



		if ($page == "ubah_p") {
      if ($aksi == "") {
      include "ubah_password.php";
      }
    }


		if ($page == "transaksi") {
			if ($aksi == "") {
				include "page/transaksi/transaksi.php";
			}

			if ($aksi == "tambah") {
				include "page/transaksi/tambah.php";
			}

			if ($aksi == "bayar") {
				include "page/transaksi/bayar.php";
			}

			if ($aksi == "hapus") {
				include "page/transaksi/batal.php";
			}

			if ($aksi == "hapus") {
				include "page/transaksi/hapus.php";
			}
		}


		if ($page == "pengguna") {
			if ($aksi == "") {
				include "page/pengguna/pengguna.php";
			}

			if ($aksi == "tambah") {
				include "page/pengguna/tambah.php";
			}

			if ($aksi == "ubah") {
				include "page/pengguna/ubah.php";
			}

			if ($aksi == "hapus") {
				include "page/pengguna/hapus.php";
			}
		}


		if ($page == "kas") {
			if ($aksi == "") {
				include "page/kas/kas.php";
			}

		}	
	

		if ($page == "") {
			include "home.php";
		}



 ?>