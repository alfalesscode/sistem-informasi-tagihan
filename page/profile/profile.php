<?php if ($_SESSION['admin']) { ?>
 <?php 
 		$sql = $koneksi->query("select * from tb_profile ");
 		$data = $sql->fetch_assoc();
  ?>

 <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Setting  Profile </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Aplikasi</label>
                  <input type="text" class="form-control"   name="nama_isp" value="<?php echo $data['nama_isp'] ?>">
                </div>

                 <div class="form-group">
                  <label for="exampleInputPassword1">Logo</label>
                    <label><img src="images/<?php echo $data['foto'] ?>" widht="100" height="100" alt=""></label>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Ganti Logo</label>
                  <input type="file"  name="foto">
                </div>

                <div class="box-footer">
                  <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>

          <?php 

          		if (isset($_POST['simpan'])) {
          			
          			$nama_isp = htmlspecialchars(strip_tags($_POST['nama_isp']));
          			$foto = $_FILES['foto']['name'];
          		  $lokasi = $_FILES['foto']['tmp_name'];

              if (!empty($lokasi)) {
	
                move_uploaded_file($lokasi, "images/".$foto);
          			$sql = $koneksi->query("update  tb_profile set nama_isp='$nama_isp',   foto='$foto' ");

          		  if ($sql) {
          				?>
          					<script>
                            setTimeout(function() {
                                swal({
                                    title: 'Data Profile',
                                    text: 'Berhasil Diubah!',
                                    type: 'success'
                                }, function() {
                                    window.location = '?page=profile';
                                });
                            }, 300);
                        </script>
          				<?php
          			}


          		}else{
          			$sql = $koneksi->query("update  tb_profile set nama_isp='$nama_isp' ");

          			if ($sql) {
          				?>
          					<script>
                            setTimeout(function() {
                                swal({
                                    title: 'Data Profile ',
                                    text: 'Berhasil Diubah!',
                                    type: 'success'
                                }, function() {
                                    window.location = '?page=profile';
                                });
                            }, 300);
                        </script>
          				<?php
          			}
          		}
				
				}


           ?>


           <?php } else{
    echo "Anda Tidak Berhak Mengakses Halaman Ini";
  } ?>