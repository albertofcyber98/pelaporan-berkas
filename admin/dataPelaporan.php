<?php
    require '../function.php';
    session_start();
    if(!isset($_SESSION['nip'])){
        header('Location: ../index.php');
    }
    $dataPelaporanSetujus = query("SELECT * FROM tbl_pelaporan WHERE status='SETUJU' ORDER BY nama_kegiatan ASC");
    $dataPelaporanTidaks = query("SELECT * FROM tbl_pelaporan WHERE status='BELUM' ORDER BY nama_kegiatan ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Pelaporan</title>

    <!-- Custom fonts for this template -->
    <?php
        include 'view/link.php'
    ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
            $page = 3;
            include 'view/sidebar.php';
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                    include 'view/topbar.php'
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tabel Data Pelaporan Kegiatan</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Tersetujui</h6>
                        </div>
                        <div class="card-body">
                                <button class="btn btn-success mb-3 mr-3" type="button" data-toggle="modal" data-target="#daftar">Tambah</button>
                            <div class="table-responsive">
                                <div id="containerA">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle">No</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Tanggal Kegiatan</th>
                                                <th>Catatan Kegiatan</th>
                                                <th>File Kegiatan</th>
                                                <th class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($dataPelaporanSetujus == []):
                                            ?>
                                                <tr>
                                                    <td colspan="9" class="text-center align-middle">Tidak Ada Data</td>
                                                </tr>
                                            <?php
                                                endif;
                                            ?>
                                            <?php
                                                $no=1;
                                                foreach($dataPelaporanSetujus AS $dataPelaporanSetuju):
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><?=$no?></td>
                                                <td class="align-middle"><?=$dataPelaporanSetuju['nama_kegiatan'];?></td>
                                                <td class="align-middle"><?=tgl_indo($dataPelaporanSetuju['tanggal_kegiatan']);?></td>
                                                <td class="align-middle"><?=$dataPelaporanSetuju['catatan_kegiatan'];?></td>
                                                <td class="align-middle"><?=$dataPelaporanSetuju['file_kegiatan']?></td>
                                                <td class="text-center align-middle">
                                                    <a href="" type="button" data-toggle="modal" data-target="#modalHapusPelaporan<?php echo $dataPelaporanSetuju['id']; ?>" class="btn btn-danger btn-circle btn-sm"><i class="far fa-times-circle"></i></a>
                                                </td>
                                                <!-- Modal Hapus-->
                                                    <div class="modal fade" id="modalHapusPelaporan<?php echo $dataPelaporanSetuju['id']; ?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Data</h4>
                                                                    <button type="button" data-dismiss="modal"  class="close" >&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form role="form" action="" method="POST" autocomplete="off">
                                                                        <?php
                                                                            $id = $dataPelaporanSetuju['id']; 
                                                                            $edits = query("SELECT * FROM tbl_pelaporan WHERE id='$id'");
                                                                            foreach ($edits as $edit): 
                                                                        ?>
                                                                        <input type="hidden" name="id" value="<?php echo $edit['id']; ?>">
                                                                        <p>Yakin untuk menghapus data ?</p>
                                                                        <div class="row justify-content-center mt-4 mb-3">  
                                                                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Batal</button>
                                                                            <button type="submit" name="hapus" class="btn btn-danger ml-2">Hapus</button>
                                                                        </div>
                                                                        <?php 
                                                                            endforeach
                                                                        ?>        
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!-- End Modal -->
                                            </tr>
                                            <?php
                                                $no++;
                                                endforeach;
                                            ?>
                                        </tbody>
                                            <div class="modal fade" id="daftar">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3>Tambah Data</h3>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form method="post" action="#" enctype="multipart/form-data" autocomplete="off" id="daftarForm">
                                                            <div class="form-group row mt-2">
                                                                <label class="col-4 col-form-label">Nama Kegiatan</label>
                                                                <div class="col-8">
                                                                    <input type="text" class="form-control" name="nama_kegiatan" required placeholder="Nama Kegiatan">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mt-2">
                                                                <label class="col-4 col-form-label">Tanggal Kegiatan</label>
                                                                <div class="col-8">
                                                                    <input type="date" class="form-control" name="tanggal_kegiatan" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">Catatan</label>
                                                                <div class="col-8">
                                                                    <textarea name="catatan" id="" cols="30" class="form-control" rows="6"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">File Kegiatan</label>
                                                                <div class="col-8">
                                                                    <input type="file" id="File" name="file_kegiatan" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="row justify-content-center mt-4 mb-3">
                                                                <input type="submit" name="submit" class="btn btn-success" value="Tambah">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Belum Tersetujui</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="containerA">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle">No</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Tanggal Kegiatan</th>
                                                <th>Catatan Kegiatan</th>
                                                <th>File Kegiatan</th>
                                                <th class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($dataPelaporanTidaks == []):
                                            ?>
                                                <tr>
                                                    <td colspan="9" class="text-center align-middle">Tidak Ada Data</td>
                                                </tr>
                                            <?php
                                                endif;
                                            ?>
                                            <?php
                                                $no=1;
                                                foreach($dataPelaporanTidaks AS $dataPelaporanTidak):
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><?=$no?></td>
                                                <td class="align-middle"><?=$dataPelaporanTidak['nama_kegiatan'];?></td>
                                                <td class="align-middle"><?=tgl_indo($dataPelaporanTidak['tanggal_kegiatan']);?></td>
                                                <td class="align-middle"><?=$dataPelaporanTidak['catatan_kegiatan'];?></td>
                                                <td class="align-middle"><?=$dataPelaporanTidak['file_kegiatan']?></td>
                                                <td class="text-center align-middle">
                                                    <a href="" type="button" data-toggle="modal" data-target="#modalEditPelaporan<?php echo $dataPelaporanTidak['id']; ?>" class="btn btn-success btn-sm">SETUJU</a>
                                                    <a href="" type="button" data-toggle="modal" data-target="#modalHapusPelaporan<?php echo $dataPelaporanTidak['id']; ?>" class="btn btn-danger btn-sm">HAPUS</a>
                                                </td>
                                                <!-- Modal Hapus-->
                                                    <div class="modal fade" id="modalHapusPelaporan<?php echo $dataPelaporanTidak['id']; ?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Data</h4>
                                                                    <button type="button" data-dismiss="modal"  class="close" >&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form role="form" action="" method="POST" autocomplete="off">
                                                                        <?php
                                                                            $id = $dataPelaporanTidak['id']; 
                                                                            $edits = query("SELECT * FROM tbl_pelaporan WHERE id='$id'");
                                                                            foreach ($edits as $edit): 
                                                                        ?>
                                                                        <input type="hidden" name="id" value="<?php echo $edit['id']; ?>">
                                                                        <p>Yakin untuk menghapus data ?</p>
                                                                        <div class="row justify-content-center mt-4 mb-3">  
                                                                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Batal</button>
                                                                            <button type="submit" name="hapusLaporan" class="btn btn-danger ml-2">Hapus</button>
                                                                        </div>
                                                                        <?php 
                                                                            endforeach
                                                                        ?>        
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!-- End Modal -->
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="modalEditPelaporan<?php echo $dataPelaporanTidak['id']; ?>" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Setujui Data</h3>
                                                                <button type="button" data-dismiss="modal"  class="close" >&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form role="form" action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                                    <?php
                                                                    $id = $dataPelaporanTidak['id']; 
                                                                    $edits = query("SELECT * FROM tbl_pelaporan WHERE id='$id'");
                                                                    foreach ($edits as $edit) :
                                                                    ?>
                                                                    <input type="hidden" name="id" value="<?php echo $edit['id']; ?>">
                                                                    <p>Yakin untuk menyetujui data ?</p>
                                                                    <div class="row justify-content-end mt-4 mb-3">  
                                                                        <button type="submit" name="editLaporan" class="btn btn-info">Setuju</button>
                                                                        <button type="button" class="btn btn-secondary mr-3 ml-2" data-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                    <?php endforeach ?>        
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Edit -->
                                            </tr>
                                            <?php
                                                $no++;
                                                endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
                include 'view/footer.php';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- script.php-->
    <?php
        include 'view/modalLogout.php';
        include 'view/script.php';
    ?>
    
    <?php
        if(isset($_POST['submit'])){
            if(tambahdata($_POST)>0){
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Berhasil",
                            text: "Data telah ditambahkan",
                            icon: "success",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPelaporan.php");
                            } else {
                            //if no clicked => do something else
                            }
                        });
                    </script>
                ';
            }else{
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Gagal",
                            text: "Data gagal ditambahkan",
                            icon: "error",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPelaporan.php");
                            } else {
                            //if no clicked => do something else
                            }
                        });
                    </script>
                ';
            }
        }
        if(isset($_POST['hapus'])){
            if(hapusdata($_POST)>0){
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Berhasil",
                            text: "Data telah dihapus",
                            icon: "success",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPelaporan.php");
                            } else {
                            //if no clicked => do something else
                            }
                        });
                    </script>
                ';
            }else{
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Gagal",
                            text: "Data gagal dihapus",
                            icon: "error",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPelaporan.php");
                            } else {
                            //if no clicked => do something else
                            }
                        });
                    </script>
                ';
            }
        }
        if(isset($_POST['hapusLaporan'])){
            if(HapusLaporan($_POST)>0){
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Berhasil",
                            text: "Data telah ditolak",
                            icon: "success",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPelaporan.php");
                            } else {
                            //if no clicked => do something else
                            }
                        });
                    </script>
                ';
            }else{
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Gagal",
                            text: "Data gagal ditolak",
                            icon: "error",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPelaporan.php");
                            } else {
                            //if no clicked => do something else
                            }
                        });
                    </script>
                ';
            }
        }
        if(isset($_POST['editLaporan'])){
            if(SetujuLaporan($_POST)>0){
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Berhasil",
                            text: "Data telah disetujui",
                            icon: "success",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPelaporan.php");
                            } else {
                            //if no clicked => do something else
                            }
                        });
                    </script>
                ';
            }else{
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Gagal",
                            text: "Data gagal disetujui",
                            icon: "error",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPelaporan.php");
                            } else {
                            //if no clicked => do something else
                            }
                        });
                    </script>
                ';
            }
        }
    ?>

</body>

</html>