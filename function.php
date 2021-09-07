<?php
    $conn = mysqli_connect("localhost","root","root","db_laporanberkas");
    // function global
    function query($query){
        global $conn;
        $result = mysqli_query($conn,$query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }
    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
     
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    // halaman index
    function dataPegawai(){
        global $conn;
        $query = mysqli_query($conn,"SELECT COUNT(*) AS jumlah FROM tbl_pegawai");
        $hasil = mysqli_fetch_array($query);
        return $hasil['jumlah'];
    }
    function databelum(){
        global $conn;
        $query = mysqli_query($conn,"SELECT COUNT(*) AS jumlah FROM tbl_pelaporan WHERE status='BELUM'");
        $hasil = mysqli_fetch_array($query);
        return $hasil['jumlah'];
    }
    function datasudah(){
        global $conn;
        $query = mysqli_query($conn,"SELECT COUNT(*) AS jumlah FROM tbl_pelaporan WHERE status='SETUJU'");
        $hasil = mysqli_fetch_array($query);
        return $hasil['jumlah'];
    }
    // halaman data petugas
    function tambahdatapegawai($data){
        global $conn;
        $nip = $data['nip'];
        $nama = $data['nama'];
        $tempat_lahir = $data['tempat_lahir'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $alamat = $data['alamat'];
        $email = $data['email'];
        $level = $data['level'];
        $password = $data['password'];
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO tbl_pegawai VALUES(
            '$nip',
            '$nama',
            '$tempat_lahir',
            '$tanggal_lahir',
            '$jenis_kelamin',
            '$alamat',
            '$email',
            '$level',
            '$passHash'
        )";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    function hapusdatapegawai($data){
        global $conn;
        $nip = $data['id'];
        $query = "DELETE FROM tbl_pegawai WHERE nip='$nip'";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    function ubahdatapegawai($data){
        global $conn;
        $id = $data['id'];
        $nama = $data['nama'];
        $tempat_lahir = $data['tempat_lahir'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $alamat = $data['alamat'];
        $email = $data['email'];
        $level = $data['level'];
        $query = "UPDATE tbl_pegawai
                SET nama='$nama',
                tempat_lahir='$tempat_lahir',
                tanggal_lahir='$tanggal_lahir',
                jenis_kelamin='$jenis_kelamin',
                alamat='$alamat',
                email='$email',
                level='$level' WHERE nip='$id'";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    // Pegawai
    function tambahberkaspegawai($data){
        global$conn;
        
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    function uploadsurat(){
        // return false;
        $namaFile = $_FILES['file_kegiatan']['name'];
        $ukuranFile = $_FILES['file_kegiatan']['size'];
        $error = $_FILES['file_kegiatan']['error'];
        $tmpName = $_FILES['file_kegiatan']['tmp_name'];
        // cek jika tidak ada gambar diupload
    
        if($error === 4 ){
            echo"
            <script>
                alert('Masukkan File');
            </script>
            ";
            return false;
        }
        // cek yang boleh diupload
        $ekstensiFileValid = ['pdf','doc','docx'];
        $ekstensiFile = explode('.', $namaFile);
        $ekstensiFile = strtolower(end($ekstensiFile));
        if(!in_array($ekstensiFile, $ekstensiFileValid)){
            echo"
            <script>
                alert('Bukan File Document yang diupload');
            </script>
            ";
            return false;
        }
        //cek size
        if($ukuranFile > 10000000){
            echo"
            <script>
                alert('Ukuran File yang diupload besar');
            </script>
            ";
            return false;
        }
        // lolos pengecekan
        //generate
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiFile;
        move_uploaded_file($tmpName,'../librari/berkas/' . $namaFileBaru);
        return $namaFileBaru;
    }
    function tambahdatapengajuan($data){
        global $conn;
        $nama_kegiatan = $data['nama_kegiatan'];
        $tanggal_kegiatan = $data['tanggal_kegiatan'];
        $catatan = $data['catatan'];
        $file_kegiatan = uploadsurat();
        if(!$file_kegiatan){
            return false;
        }
        $query = "INSERT INTO tbl_pelaporan VALUES(
            NULL,
            '$nama_kegiatan',
            '$tanggal_kegiatan',
            '$catatan',
            '$file_kegiatan',
            'BELUM'
        )";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    function hapusdatapengajuan($data){
        global $conn;
        $id = $data['id'];
        $query = "DELETE FROM tbl_pelaporan WHERE id='$id'";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    function tambahdata($data){
        global $conn;
        $nama_kegiatan = $data['nama_kegiatan'];
        $tanggal_kegiatan = $data['tanggal_kegiatan'];
        $catatan = $data['catatan'];
        $file_kegiatan = uploadsurat();
        if(!$file_kegiatan){
            return false;
        }
        $query = "INSERT INTO tbl_pelaporan VALUES(
            NULL,
            '$nama_kegiatan',
            '$tanggal_kegiatan',
            '$catatan',
            '$file_kegiatan',
            'SETUJU'
        )";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    function hapusdata($data){
        global $conn;
        $id = $data['id'];
        $query = "DELETE FROM tbl_pelaporan WHERE id='$id'";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    function HapusLaporan($data){
        global $conn;
        $id = $data['id'];
        $query = "DELETE FROM tbl_pelaporan WHERE id='$id'";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    function SetujuLaporan($data){
        global $conn;
        $id = $data['id'];
        $query = "UPDATE tbl_pelaporan SET
            status = 'SETUJU' WHERE id='$id'
        ";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }