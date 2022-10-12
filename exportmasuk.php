<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Cetak Laporan Barang Masuk </title>
    <meta content="" name="description">
    <meta content="Author" name="MJ Maraz">
    <link href="" rel="icon">
    <link href="" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- ========================================================= -->


    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <header class="header_part">
        <img src="" alt="" class="img-fluid">
        <h4>LAPORAN SARPRAS SMK KOMPUTAMA</h4>
    </header>
    <!-- =======  Data-Table  = Start  ========================== -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data_table">
                    <table id="barsuk" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang");
                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                    $idb = $data['idbarang'];
                                    $idm = $data['idmasuk'];
                                    $tanggal = $data['tanggal'];
                                    $namabarang = $data['namabarang'];
                                    $qty = $data['qty'];
                                    $keterangan = $data['keterangan'];
                                ?>
                                <tr>
                                    <td><?=$tanggal;?></td>
                                    <td><?=$namabarang;?></td>
                                    <td><?=$qty;?></td>
                                    <td><?=$keterangan;?></td>
                                </tr>

                            <?php
                            };


                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- =======  Data-Table  = End  ===================== -->
    <!-- ============ Java Script Files  ================== -->


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/custommasuk.js"></script>



</body>

</html>
