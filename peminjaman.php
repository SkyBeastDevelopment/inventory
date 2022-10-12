<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Peminjaman Barang - Sarpras SMK Komputama Majenang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Sarpras Komputama</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Main</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="masuk.php">Barang Masuk</a>
                                            <a class="nav-link" href="keluar.php">Barang Keluar</a>
                                            <a class="nav-link" href="peminjaman.php">Peminjaman</a>
                                            <a class="nav-link" href="logout.php">Logout</a>
                                        </nav>
                                    </div>
                                    
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Peminjaman</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                        Tambah Data
                                </button>
                                <a href="exportpinjam.php" class="btn btn-success">Cetak Laporan</a>
                                <!-- The Modal -->
                                <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Data Peminjaman</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">

                                                <select name="barangnya" class="form-control">
                                                    <?php
                                                        $ambilsemuadatanya = mysqli_query($conn, "select * from stock");
                                                        while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                                            $namabarangnya = $fetcharray['namabarang'];
                                                            $idbarangnya = $fetcharray['idbarang'];
                                                    ?>

                                                    <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>
                                                    <?php        

                                                        }
                                                    ?>
                                                </select>
                                                <br>
                                                <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
                                                <br>
                                                <input type="text" name="penerima" placeholder="Kepada" class="form-control" required>
                                                <br>
                                                <button type="submit" class="btn btn-primary" name="pinjam">Submit</button>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Kepada</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from peminjaman p, stock s where s.idbarang = p.idbarang order by idpeminjaman DESC");
                                            while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                $idb = $data['idbarang'];
                                                $idk = $data['idpeminjaman'];
                                                $tanggal = $data['tanggalpinjam'];
                                                $namabarang = $data['namabarang'];
                                                $qty = $data['qty'];
                                                $penerima = $data['peminjam'];
                                                $status = $data['status'];
                                            ?>
                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$status;?></td>
                                                <td>
                                                
                                                <?php
                                                    // Cek Status 
                                                    if($status=='Dipinjam'){
                                                        echo '
                                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit'.$idk.'">
                                                        Selesai
                                                        </button>';
                                                    } else {
                                                        // Jika Statusnya bukan dipinjam (sudah kembali)
                                                        echo 'ok';
                                                    } 
                                                    
                                                ?>
                                                </td>
                                            </tr>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?=$idk;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Selesaikan</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                        Apakah Barang ini Sudah Selesai di Pinjam?
                                                        <br>
                                                        <br>
                                                        <input type="hidden" name="idpinjam" value="<?=$idk;?>">
                                                        <input type="hidden" name="idbarang" value="<?=$idb;?>">
                                                        <button type="submit" class="btn btn-primary" name="barangkembali">Iya</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
