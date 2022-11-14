<?php
session_start();

// koneksi ke database
$conn = mysqli_connect("localhost","root","","inventorybarang");

// Menambah Barang Baru
if(isset($_POST['addnewbarang'])){
    $kodebarang = $_POST['kodebarang'];
    $namabarang = mysqli_real_escape_string($conn, $_POST['namabarang']);
    $deskripsi =  mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $baik = $_POST['baik'];
    $rusak_sedang = $_POST['rusak_sedang'];
    $rusak_berat = $_POST['rusak_berat'];
    $tanggal = $_POST['tgl'];

    // Validasi taggal
    $tgl_sekarang = new Datetime(date('Y-m-d'));
    $tgl_inputan= new Datetime($tanggal);

    if($tgl_inputan > $tgl_sekarang){
        echo '
        <script>
            alert("Tanggal melebihi tanggal sekarang");
            window.location.href="index.php";
        </script>
        ';
        
        return;
    }


    $addtotable = mysqli_query($conn,"insert into stock (tanggal, kodebarang, namabarang, deskripsi, baik, rusak_sedang, rusak_berat) values('$tanggal','$kodebarang', '$namabarang', '$deskripsi', '$baik', '$rusak_sedang', '$rusak_berat')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

// Menambah Barang Masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $tanggal = $_POST['tgl'];

    // Validasi taggal
    $tgl_sekarang = new Datetime(date('Y-m-d'));
    $tgl_inputan= new Datetime($tanggal);

    if($tgl_inputan > $tgl_sekarang){
        echo '
        <script>
            alert("Tanggal melebihi tanggal sekarang");
            window.location.href="masuk.php";
        </script>
        ';
        
        return;
    }

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['baik'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk ( idmasuk, idbarang, tanggal, keterangan, qty) values('', '$barangnya', '$tanggal', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set baik='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
};

// Menambah Barang Keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $tanggal = $_POST['tgl'];

    // Validasi taggal
    $tgl_sekarang = new Datetime(date('Y-m-d'));
    $tgl_inputan= new Datetime($tanggal);

    if($tgl_inputan > $tgl_sekarang){
        echo '
        <script>
            alert("Tanggal melebihi tanggal sekarang");
            window.location.href="masuk.php";
        </script>
        ';
        
        return;
    }

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['baik'];

    if($stocksekarang >= $qty){
        // Kalau Barangnya Cukup
        $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

        $addtokeluar = mysqli_query($conn, "insert into keluar (idkeluar, idbarang, tanggal, penerima, qty) values('', '$barangnya', '$tanggal', '$penerima', '$qty')");
        $updatestockmasuk = mysqli_query($conn, "update stock set baik='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
        if($addtokeluar&&$updatestockmasuk){
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    } else {
        // Kalau Barangnya tidak Cukup
        echo '
        <script>
            alert("Stok barang baik Saat ini tidak Mencukupi");
            window.location.href="keluar.php";
        </script>
        ';
    }
};

// Update Info Barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $kodebarang = $_POST['kodebarang'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $baik = $_POST['baik'];
    $rusak_sedang = $_POST['rusak_sedang'];
    $rusak_berat = $_POST['rusak_berat'];
    $tanggal = $_POST['tgl'];

    // Validasi taggal
    $tgl_sekarang = new Datetime(date('Y-m-d'));
    $tgl_inputan= new Datetime($tanggal);

    if($tgl_inputan > $tgl_sekarang){
        echo '
        <script>
            alert("Tanggal melebihi tanggal sekarang");
            window.location.href="index.php";
        </script>
        ';
        
        return;
    }

    $update = mysqli_query($conn, "update stock set tanggal='$tanggal', kodebarang='$kodebarang', namabarang='$namabarang', deskripsi='$deskripsi', baik='$baik', rusak_sedang='$rusak_sedang', rusak_berat='$rusak_berat' where idbarang='$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

// Menghapus Barang Dari Stock
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

// Mengubah Data Barang Masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $tanggal = $_POST['tgl'];

    // Validasi taggal
    $tgl_sekarang = new Datetime(date('Y-m-d'));
    $tgl_inputan= new Datetime($tanggal);

    if($tgl_inputan > $tgl_sekarang){
        echo '
        <script>
            alert("Tanggal melebihi tanggal sekarang");
            window.location.href="masuk.php";
        </script>
        ';
        
        return;
    }

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['baik'];

    $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg - $selisih; 
        $kurangistocknya = mysqli_query($conn, "update stock set baik='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', tanggal='$tanggal', keterangan='$deskripsi' where idmasuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            
            }
    } else {
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg + $selisih; 
        $kurangistocknya = mysqli_query($conn, "update stock set baik='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', tanggal='$tanggal', keterangan='$deskripsi' where idmasuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            
            }
    }

};

// Menghapus Barang Masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['baik'];

    $selisih = $stock-$qty;

    $update = mysqli_query($conn,"update stock set baik='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }
};

// Mengubah Data Barang Keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $tanggal = $_POST['tgl'];

    // Validasi taggal
    $tgl_sekarang = new Datetime(date('Y-m-d'));
    $tgl_inputan= new Datetime($tanggal);

    if($tgl_inputan > $tgl_sekarang){
        echo '
        <script>
            alert("Tanggal melebihi tanggal sekarang");
            window.location.href="keluar.php";
        </script>
        ';
        
        return;
    }

    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['baik'];

    $qtyskrg = mysqli_query($conn,"select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn,"update stock set baik='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update keluar set qty='$qty', tanggal='$tanggal', penerima='$penerima' where idkeluar='$idk'");
            if($kurangistocknya&&$updatenya){
                header('location:keluar.php');
            } else {
                echo 'Gagal';
                header('location:keluar.php'); 
            }
    } else {
        $selisih = $qtyskrg-$qty;
        $kurangi = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn,"update stock set baik='$kurangi' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update keluar set qty='$qty', tanggal='$tanggal', penerima='$penerima' where idkeluar='$idk'");
        
        if($kurangistocknya&&$updatenya){
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php'); 
        }
    }
};

// Menghapus Barang Keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['baik'];

    $selisih = $stock+$qty;

    $update = mysqli_query($conn,"update stock set baik='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }
};

// Meminjam Barang
if(isset($_POST['pinjam'])){
    $idbarang = $_POST['barangnya']; 
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];
    $tanggal = $_POST['tgl'];

        // Validasi taggal
        $tgl_sekarang = new Datetime(date('Y-m-d'));
        $tgl_inputan= new Datetime($tanggal);
    
        if($tgl_inputan > $tgl_sekarang){
            echo '
            <script>
                alert("Tanggal melebihi tanggal sekarang");
                window.location.href="peminjaman.php";
            </script>
            ';
            
            return;
        }
    

    // Ambil Stock Sekarang
    $stock_saat_ini = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
    $stock_nya = mysqli_fetch_array($stock_saat_ini);
    $stock = $stock_nya['baik']; // Value nya

    // Kurangin Stocknya
    $new_stock = $stock-$qty;

    // Mulai Query Insert
    $insertpinjam = mysqli_query($conn, "INSERT INTO peminjaman (idbarang, tanggalpinjam, qty, peminjam) values ('$idbarang', '$tanggal', '$qty', '$penerima')");

    // Mengurangi Stock di Table Stock
    $kurangistock = mysqli_query($conn, "update stock set baik='$new_stock' where idbarang='$idbarang'");

    if($insertpinjam&&$kurangistock){
        // Jika Berhasil
        echo '
        <script>
            alert("Berhasil");
            window.location.href="peminjaman.php";
        </script>
        ';
    } else {
        // JIka gagal
        echo '
        <script>
            alert("Gagal");
            window.location.href="peminjaman.php";
        </script>
        ';
    }

};

// Menyelesaikan Pinjaman
if(isset($_POST['barangkembali'])){
    $idpinjam = $_POST['idpinjam'];
    $idbarang = $_POST['idbarang'];
    $tanggalkembali = date('Y-m-d');

    // Eksekusi
    $update_status = mysqli_query($conn, "update peminjaman set status='kembali', tanggalkembali='$tanggalkembali' where idpeminjaman='$idpinjam'");

    // Ambil Stock Sekarang
    $stock_saat_ini = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
    $stock_nya = mysqli_fetch_array($stock_saat_ini);
    $stock = $stock_nya['baik']; // Value nya

    // Ambil qty dari idpinjam 
    $stock_qty_skrg = mysqli_query($conn, "select * from peminjaman where idpeminjaman='$idpinjam'");
    $stock_qtynya = mysqli_fetch_array($stock_qty_skrg);
    $stockqty = $stock_qtynya['qty']; // Value nya

    // Kurangin Stocknya
    $new_stock = $stockqty+$stock;

    // Kembalikan Stocknya
    $kembalikan_stock = mysqli_query($conn, "update stock set baik='$new_stock' where idbarang='$idbarang'");

    if($update_status&&$kembalikan_stock){
        // Jika Berhasil
        echo '
        <script>
            alert("Berhasil");
            window.location.href="peminjaman.php";
        </script>
        ';
    } else {
        // JIka gagal
        echo '
        <script>
            alert("Gagal");
            window.location.href="peminjaman.php";
        </script>
        ';
    }
}



?>