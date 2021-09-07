<?php
    require '../function.php';
    session_start();
    if(!isset($_SESSION['nip'])){
        header('Location: ../index.php');
    }
    $dataPegawais = query("SELECT * FROM tbl_pegawai ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Pegawai</title>

    <!-- Custom fonts for this template -->
    <?php
        include 'view/link.php'
    ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
            $page = 2;
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
                    <h1 class="h3 mb-2 text-gray-800">Tabel Data Pegawai</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data</h6>
                        </div>
                        <div class="card-body">
                                <button class="btn btn-success mb-3 mr-3" type="button" data-toggle="modal" data-target="#daftar">Tambah</button>
                            <div class="table-responsive">
                                <div id="containerA">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle">No</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Tempat/Tanggal Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alamat</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                                <th class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($dataPegawais == []):
                                            ?>
                                                <tr>
                                                    <td colspan="9" class="text-center align-middle">Tidak Ada Data</td>
                                                </tr>
                                            <?php
                                                endif;
                                            ?>
                                            <?php
                                                $no=1;
                                                foreach($dataPegawais AS $dataPegawai):
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><?=$no?></td>
                                                <td class="align-middle"><?=$dataPegawai['nip'];?></td>
                                                <td class="align-middle"><?=$dataPegawai['nama'];?></td>
                                                <td class="align-middle"><?=$dataPegawai['tempat_lahir'];?>, <?=tgl_indo($dataPegawai['tanggal_lahir'])?></td>
                                                <td class="align-middle"><?=$dataPegawai['jenis_kelamin']?></td>
                                                <td class="align-middle"><?=$dataPegawai['alamat']?></td>
                                                <td class="align-middle"><?=$dataPegawai['email']?></td>
                                                <td class="align-middle"><?=$dataPegawai['level']?></td>
                                                <td class="text-center align-middle">
                                                    <a href="" type="button" data-toggle="modal" data-target="#modalEditPegawai<?php echo $dataPegawai['nip']; ?>" class="btn btn-secondary btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a href="" type="button" data-toggle="modal" data-target="#modalHapusPegawai<?php echo $dataPegawai['nip']; ?>" class="btn btn-danger btn-circle btn-sm"><i class="far fa-times-circle"></i></a>
                                                </td>
                                                <!-- Modal Hapus-->
                                                    <div class="modal fade" id="modalHapusPegawai<?php echo $dataPegawai['nip']; ?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Data</h4>
                                                                    <button type="button" data-dismiss="modal"  class="close" >&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form role="form" action="" method="POST" autocomplete="off">
                                                                        <?php
                                                                            $nip = $dataPegawai['nip']; 
                                                                            $edits = query("SELECT * FROM tbl_pegawai WHERE nip='$nip'");
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
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="modalEditPegawai<?php echo $dataPegawai['nip']; ?>" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Ubah Data</h3>
                                                                <button type="button" data-dismiss="modal"  class="close" >&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form role="form" action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                                    <?php
                                                                    $nip = $dataPegawai['nip']; 
                                                                    $edits = query("SELECT * FROM tbl_pegawai WHERE nip='$nip'");
                                                                    foreach ($edits as $edit) :
                                                                    ?>
                                                                    <input type="hidden" name="id" value="<?php echo $edit['nip']; ?>">
                                                                    <div class="form-group row mt-2">
                                                                        <label class="col-4 col-form-label">Nama</label>
                                                                        <div class="col-8">
                                                                            <input type="text" class="form-control" name="nama" value="<?=$edit['nama']?>" required placeholder="Nama">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mt-2">
                                                                        <label class="col-4 col-form-label">Tempat Lahir</label>
                                                                        <div class="col-8">
                                                                            <input type="text" class="form-control" name="tempat_lahir" value="<?=$edit['tempat_lahir']?>" required placeholder="Tempat Lahir">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mt-2">
                                                                        <label class="col-4 col-form-label">Tanggal Lahir</label>
                                                                        <div class="col-8">
                                                                            <input type="date" class="form-control" name="tanggal_lahir" value="<?=$edit['tanggal_lahir']?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mt-2">
                                                                        <label class="col-4 col-form-label">Jenis Kelamin</label>
                                                                        <div class="col-8">
                                                                            <select name="jenis_kelamin" id="" class="form-control">
                                                                                <?php 
                                                                                    if($edit['jenis_kelamin'] == "L"):
                                                                                ?>
                                                                                <option value="L">L</option>
                                                                                <option value="P">P</option>
                                                                                <?php
                                                                                    endif
                                                                                ?>
                                                                                <?php 
                                                                                    if($edit['jenis_kelamin'] == "P"):
                                                                                ?>
                                                                                <option value="P">P</option>
                                                                                <option value="L">L</option>
                                                                                <?php
                                                                                    endif
                                                                                ?>
                                                                                <?php 
                                                                                    if($edit['jenis_kelamin'] == ""):
                                                                                ?>
                                                                                <option value="P">P</option>
                                                                                <option value="L">L</option>
                                                                                <?php
                                                                                    endif
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-4 col-form-label">Alamat</label>
                                                                        <div class="col-8">
                                                                            <textarea name="alamat" id="" cols="30" class="form-control" rows="6"><?=$edit['alamat']?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-4 col-form-label">Email</label>
                                                                        <div class="col-8">
                                                                            <input type="email" class="form-control" name="email" value="<?=$edit['email']?>" required placeholder="Email">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-4 col-form-label">Level</label>
                                                                        <div class="col-8">
                                                                            <select name="level" id="" class="form-control">
                                                                                <?php 
                                                                                    if($edit['level'] == "ADMIN"):
                                                                                ?>
                                                                                <option value="ADMIN">ADMIN</option>
                                                                                <option value="PEGAWAI">PEGAWAI</option>
                                                                                <option value="PEMIMPIN">PEMIMPIN</option>
                                                                                <?php
                                                                                    endif
                                                                                ?>
                                                                                <?php 
                                                                                    if($edit['level'] == "PEGAWAI"):
                                                                                ?>
                                                                                <option value="PEGAWAI">PEGAWAI</option>
                                                                                <option value="ADMIN">ADMIN</option>
                                                                                <option value="PEMIMPIN">PEMIMPIN</option>
                                                                                <?php
                                                                                    endif
                                                                                ?>
                                                                                <?php 
                                                                                    if($edit['level'] == "PEMIMPIN"):
                                                                                ?>
                                                                                <option value="PEMIMPIN">PEMIMPIN</option>
                                                                                <option value="ADMIN">ADMIN</option>
                                                                                <option value="PEGAWAI">PEGAWAI</option>
                                                                                <?php
                                                                                    endif
                                                                                ?>
                                                                                <?php 
                                                                                    if($edit['level'] == ""):
                                                                                ?>
                                                                                <option value="ADMIN">ADMIN</option>
                                                                                <option value="PEGAWAI">PEGAWAI</option>
                                                                                <option value="PEMIMPIN">PEMIMPIN</option>
                                                                                <?php
                                                                                    endif
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-end mt-4 mb-3">  
                                                                        <button type="submit" name="edit" class="btn btn-info">Update</button>
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
                                            <div class="modal fade" id="daftar">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3>Tambah Data</h3>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="#" autocomplete="off" id="daftarForm">
                                                            <div class="form-group row mt-2">
                                                                <label class="col-4 col-form-label">NIP</label>
                                                                <div class="col-8">
                                                                    <input type="text" class="form-control" name="nip" required placeholder="NIP">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mt-2">
                                                                <label class="col-4 col-form-label">Nama</label>
                                                                <div class="col-8">
                                                                    <input type="text" class="form-control" name="nama" required placeholder="Nama">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mt-2">
                                                                <label class="col-4 col-form-label">Tempat Lahir</label>
                                                                <div class="col-8">
                                                                    <input type="text" class="form-control" name="tempat_lahir" required placeholder="Tempat Lahir">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mt-2">
                                                                <label class="col-4 col-form-label">Tanggal Lahir</label>
                                                                <div class="col-8">
                                                                    <input type="date" class="form-control" name="tanggal_lahir" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mt-2">
                                                                <label class="col-4 col-form-label">Jenis Kelamin</label>
                                                                <div class="col-8">
                                                                    <select name="jenis_kelamin" id="" class="form-control">
                                                                        <option selected>--Pilih--</option>
                                                                        <option value="L">L</option>
                                                                        <option value="P">P</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">Alamat</label>
                                                                <div class="col-8">
                                                                    <textarea name="alamat" id="" cols="30" class="form-control" rows="6"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">Email</label>
                                                                <div class="col-8">
                                                                    <input type="email" class="form-control" name="email" required placeholder="Email">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">Level</label>
                                                                <div class="col-8">
                                                                    <select name="level" id="" class="form-control">
                                                                        <option selected>--Pilih--</option>
                                                                        <option value="ADMIN">ADMIN</option>
                                                                        <option value="PEGAWAI">PEGAWAI</option>
                                                                        <option value="PEMIMPIN">PEMIMPIN</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">Password</label>
                                                                <div class="col-8">
                                                                    <input type="password" class="form-control" name="password" required>
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
        if(isset($_POST['edit'])){
            if(ubahdatapegawai($_POST)>0){
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Berhasil",
                            text: "Data telah diubah",
                            icon: "success",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPegawai.php");
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
                            text: "Data gagal diubah",
                            icon: "error",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPegawai.php");
                            } else {
                            //if no clicked => do something else
                            }
                        });
                    </script>
                ';
            }
        }
        if(isset($_POST['submit'])){
            if(tambahdatapegawai($_POST)>0){
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Berhasil",
                            text: "Data telah ditambahkan",
                            icon: "success",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPegawai.php");
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
                                window.location.replace("dataPegawai.php");
                            } else {
                            //if no clicked => do something else
                            }
                        });
                    </script>
                ';
            }
        }
        if(isset($_POST['hapus'])){
            if(hapusdatapegawai($_POST)>0){
                echo'
                    <script type="text/javascript">
                        swal({
                            title: "Berhasil",
                            text: "Data telah dihapus",
                            icon: "success",
                            showConfirmButton:true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace("dataPegawai.php");
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
                                window.location.replace("dataPegawai.php");
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