<?php

	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	 include "include/koneksi.php";


        session_start();

// mengganti tgl inggris ke tgl indo
     $satu_hari        = mktime(0,0,0,date("n"),date("j"),date("Y"));
       
          function tglIndonesia2($str){
             $tr   = trim($str);
             $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
             return $str;
         }
     
// siapa yg login ke halaman ini
 if ($_SESSION['admin'] || $_SESSION['user']) {
          
    

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gading net</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="plugins/select2/select2.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" type="text/css" href="sw/dist/sweetalert.css">
        <script type="text/javascript" src="sw/dist/sweetalert.min.js"></script>
    </head>

    <body class="hold-transition skin-blue-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php 

                // mengambil data database
                $sql2 = $koneksi->query("select * from tb_profile ");

                $data1 = $sql2->fetch_assoc();

            ?>

            <header class="main-header">
                <!-- Logo -->
                <a href="?images=gadinglogobaru.png" class="logo">
                    <!-- mini logo -->
                    <span class="logo"><b>GD</b>Net</span>
                    <span class="logo-lg"><b><?php echo $data1['nama_isp'] ?></b></span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <!-- navbar pengguna -->
                    <?php 
                    
                        // memeriksa siapa yg login
                        if ($_SESSION['admin']) {
                        $user = $_SESSION['admin'];
                        }elseif ($_SESSION['user']) {
                        $user = $_SESSION['user'];
                        }

                        //Mengambil Data dari Database
                        $sql_user = $koneksi->query("select * from tb_user where id='$user'");
                        $data_user = $sql_user->fetch_assoc();

                        //Mengambil informasi dari Pengguna 
                        $nama = $data_user['nama_user'];

                        $level = $data_user['level'];

                        $id_user = $data_user['id'];
                        $id_user = $data_user['id'];

                        $id_pelanggan = $data_user['id_pelanggan'];
                    ?>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- User Account -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="images/<?php echo $data_user['foto'] ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Hai, <?php echo $nama ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="images/<?php echo $data_user['foto'] ?>" class="img-circle"
                                            alt="User Image">
                                        <!-- level nya apa -->
                                        <p>
                                            Login Sebagai
                                            <small><?php echo $level ?></small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer ubah psswd-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="?page=ubah_p&id=<?php echo $data_user['id']; ?>"
                                                class="btn btn-info btn-flat">Ubah Password</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="logout.php" class="btn btn-danger btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                    </div>
                </nav>
            </header>
            <!-- =================== -->

            <!-- kiri column / sidebar -->
            <?php include "include/menu.php"; ?>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <?php include "include/isi.php"; ?>

                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="box box-primary box-solid">
                                    <div class="box-header with-border">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        Rekap Kas Masuk dan Keluar
                                    </div>

                                    <div class="modal-body">
                                        <form role="form" method="POST" target="blank" action="page/laporan/rekap_kas.php">
                                            <div class="form-group">
                                                <label>Tanggal Awal</label>
                                                <input type="date" name="tgl_awal" required="" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Tanggal Akhir</label>
                                                <input type="date" name="tgl_akhir" required="" class="form-control">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" name="tambah" class="btn btn-primary"><i
                                                        class="fa fa-print"></i> Cetak</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                </section>
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>
                <strong>Copyright &copy; 2024 <a href="">sistem tagihan gading.net</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>


        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/select2/select2.full.min.js"></script>
        <!-- SlimScroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <script src="jquery.mask.min.js"></script>


    </body>
</html>

<?php 

      }else{

        header("location:login.php");

      }     
      
 ?>