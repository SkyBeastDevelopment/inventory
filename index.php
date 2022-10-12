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
        <title>Dashboard - Sarpras SMK Komputama Majenang</title>
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
                        <h1 class="mt-4">Stock Barang</h1>
                        
                        <div class="card mb-4">
                            
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                        Tambah Barang
                                </button>
                                <a href="exportstock.php" class="btn btn-success">Cetak Laporan</a>
                                <!-- The Modal -->
                                <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Barang</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">
                                                <input type="date" class="form-control" name="tgl" id="tgl"/>
                                                <br>
                                                <input type="text" name="kodebarang" placeholder="Kode Barang" class="form-control" required>
                                                <br>
                                                <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                                                <br>
                                                <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
                                                <br>
                                                <input type="number" name="baik" placeholder="Jumlah Kondisi Baik" class="form-control" required>
                                                <br>
                                                <input type="number" name="rusak_sedang" placeholder="Jumlah Kondisi Rusak Sedang" class="form-control" required>
                                                <br>
                                                <input type="number" name="rusak_berat" placeholder="Jumlah Kondisi Rusak Berat" class="form-control" required>
                                                <br>
                                                <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    
                            </div>
                            <div class="card-body">
 
                            <!-- Alert -->
                            <?php
                                $ambildatastock = mysqli_query($conn, "select * from stock where stock.baik < 1");

                                while($fetch=mysqli_fetch_array($ambildatastock)){
                                    $barang = $fetch['namabarang'];

                                
                            ?>

                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Perhatian!</strong> Stock <?=$barang;?> yang berkondisi baik telah habis.
                            </div>

                            <?php
                                }
                            ?>

                                <table class="table table-bordered" id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th>Baik</th>
                                            <th>Rusak Sedang</th>
                                            <th>Rusak Berat</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambilsemuadatastock = mysqli_query($conn, "select * from stock ORDER BY kodebarang ASC");
                                        $i = 1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $tanggal = $data['tanggal'];
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
                                            <td><?=$tanggal;?></td>
                                            <td><?=$kodebarang;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$deskripsi;?></td>
                                            <td><?=$baik;?></td>
                                            <td><?=$rusak_sedang;?></td>
                                            <td><?=$rusak_berat;?></td>
                                            <td><?= $baik+$rusak_sedang+$rusak_berat;?></td>
                                            <td>
                                                <!-- Button to Open the Modal -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idb;?>">
                                                    Edit
                                                </button>
                                                <input type="hidden" name="idbarangygmaudihapus" value="<?=$idb;?>"> 
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idb;?>">
                                                    Delete
                                                </button>
                                                
                                            </td>
                                        </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?=$idb;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                        <div class="modal-body">
                                                            <input type="date" class="form-control" name="tgl" id="tgl"/>
                                                            <br>
                                                            <input type="text" name="kodebarang" value="<?=$kodebarang;?>" class="form-control" required>
                                                            <br>
                                                            <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required>
                                                            <br>
                                                            <input type="text" name="deskripsi" value="<?=$deskripsi;?>" class="form-control" required>
                                                            <br>
                                                            <input type="number" name="baik" value="<?=$baik;?>" placeholder="Jumlah Kondisi Baik" class="form-control" required>
                                                            <br>
                                                            <input type="number" name="rusak_sedang" value="<?=$rusak_sedang;?>" placeholder="Jumlah Kondisi Rusak Sedang" class="form-control" required>
                                                            <br>
                                                            <input type="number" name="rusak_berat" value="<?=$rusak_berat;?>" placeholder="Jumlah Kondisi Rusak Berat" class="form-control" required>
                                                            <br>
                                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                                            <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$idb;?>">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus Barang?</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <form method="post">
                                                            <div class="modal-body">
                                                                Apakah Anda yakin Ingin Menghapus <?=$namabarang;?>?
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div> 

                                        <?php
                                        };

                                        
                                        ?>

                                    
                                    </tbody>
                                </table>
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
