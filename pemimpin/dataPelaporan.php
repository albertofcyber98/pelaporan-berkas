<?php
    require '../function.php';
    session_start();
    if(!isset($_SESSION['nip'])){
        header('Location: ../index.php');
    }
    $dataPelaporanSetujus = query("SELECT * FROM tbl_pelaporan WHERE status='SETUJU' ORDER BY nama_kegiatan ASC");
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
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
                                                    <a href="../librari/berkas/<?php echo $dataPelaporanSetuju['file_kegiatan']?>" class="btn btn-info btn-sm">Download</a>
                                                </td>
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

</body>

</html>