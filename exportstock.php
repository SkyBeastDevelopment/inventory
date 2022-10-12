<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Laporan Stock Barang</title>
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
        <h4>LAPORAN SARPRAS SMK KOMPUTAMA</h4>
    </header>
    <!-- =======  Data-Table  = Start  ========================== -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data_table">
                    <table id="stock" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Baik</th>
                                <th>Rusak Sedang</th>
                                <th>Rusak Berat</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ambilsemuadatastock = mysqli_query($conn, "select * from stock ORDER BY kodebarang ASC");
                            $i = 1;
                            while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                $kodebarang = $data['kodebarang'];
                                $namabarang = $data['namabarang'];
                                $deskripsi = $data['deskripsi'];
                                $baik = $data['baik'];
                                $rusak_sedang = $data['rusak_sedang'];
                                $rusak_berat = $data['rusak_berat'];
                                $idb = $data['idbarang'];
                            ?>

                            <tr>
                                <td><?=$i++;?></td>
                                <td><?=$kodebarang;?></td>
                                <td><?=$namabarang;?></td>
                                <td><?=$deskripsi;?></td>
                                <td><?=$baik;?></td>
                                <td><?=$rusak_sedang;?></td>
                                <td><?=$rusak_berat;?></td>
                                <td><?= $baik+$rusak_sedang+$rusak_berat;?></td>
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
    <script src="assets/js/custom.js"></script>



</body>

</html>
