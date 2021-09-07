<?php
    require 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="librari/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-secondary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-floating mb-3">
                                                <label for="NIP">NIP</label>
                                                <input class="form-control" id="NIP" type="text" placeholder="NIP" name="nip"/>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="inputPassword">Password</label>
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-4 mb-3">
                                                <button class="btn btn-primary" type="submit" name="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php
            include 'admin/view/script.php';
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="admin/js/scripts.js"></script>
        <?php
            if(isset($_POST['submit'])){
                $nip = $_POST['nip'];
                $password = $_POST['password'];

                $perintahAdmin = "SELECT * FROM tbl_pegawai WHERE nip = '$nip' AND level='ADMIN'";
                $hasilAdmin = mysqli_query($conn,$perintahAdmin);

                $perintahPegawai = "SELECT * FROM tbl_pegawai WHERE nip = '$nip' AND level='PEGAWAI'";
                $hasilPegawai = mysqli_query($conn,$perintahPegawai);

                $perintahPemimpin = "SELECT * FROM tbl_pegawai WHERE nip = '$nip' AND level='PEMIMPIN'";
                $hasilPemimpin = mysqli_query($conn,$perintahPemimpin);

                if(mysqli_num_rows($hasilAdmin) === 1){
                    $rowAdmin = mysqli_fetch_assoc($hasilAdmin);
                    if(password_verify($password, $rowAdmin['password'])){
                        session_start();
                        $_SESSION['nip'] = $nip;
                        echo'
                            <script type="text/javascript">
                                swal({
                                    title: "Berhasil Login",
                                    text: "Selamat Datang",
                                    icon: "success",
                                    showConfirmButton:true,
                                }).then(function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.replace("admin/index.php");
                                    } else {
                                    //if no clicked => do something else
                                    }
                                });
                            </script>
                        ';
                    }
                }else if(mysqli_num_rows($hasilPegawai) === 1){
                    $rowPegawai = mysqli_fetch_assoc($hasilPegawai);
                    if(password_verify($password, $rowPegawai['password'])){
                        session_start();
                        $_SESSION['nip'] = $nip;
                        echo'
                            <script type="text/javascript">
                                swal({
                                    title: "Berhasil Login",
                                    text: "Selamat Datang",
                                    icon: "success",
                                    showConfirmButton:true,
                                }).then(function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.replace("pegawai/index.php");
                                    } else {
                                    //if no clicked => do something else
                                    }
                                });
                            </script>
                        ';
                    }
                }else if(mysqli_num_rows($hasilPemimpin) === 1){
                    $rowPemimpin = mysqli_fetch_assoc($hasilPemimpin);
                    if(password_verify($password, $rowPemimpin['password'])){
                        session_start();
                        $_SESSION['nip'] = $nip;
                        echo'
                            <script type="text/javascript">
                                swal({
                                    title: "Berhasil Login",
                                    text: "Selamat Datang",
                                    icon: "success",
                                    showConfirmButton:true,
                                }).then(function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.replace("pemimpin/index.php");
                                    } else {
                                    //if no clicked => do something else
                                    }
                                });
                            </script>
                        ';
                    }
                }
                else{
                    echo'
                        <script type="text/javascript">
                            swal({
                                title: "Gagal Login",
                                text: "Cek Kembali Username dan password",
                                icon: "error",
                                showConfirmButton:true,
                            }).then(function(isConfirm) {
                                if (isConfirm) {
                                    window.location.replace("index.php");
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
