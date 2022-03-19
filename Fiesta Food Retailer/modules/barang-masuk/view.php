

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-level-down icon-title"></i> Data Barang Masuk
    <?php
    if ($_SESSION['hak_akses']=='Super Admin') {?>
    <a class="btn btn-primary btn-social pull-right" href="?module=form_barang_masuk&form=add" title="Tambah Data" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Tambah
    </a><?php }?>
  </h1>

</section>

<!-- Main content -->
<?php
if ($_SESSION['hak_akses']=='Super Admin') {?>
<section class="content">
  <div class="row">
    <div class="col-md-12">

    <?php  
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
      echo "";
    } 
    // jika alert = 1
    // tampilkan pesan Sukses "Data Barang Masuk berhasil disimpan"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Barang Masuk berhasil disimpan.
            </div>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel Barang -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Kode Transaksi</th>
                <th class="center">Tanggal</th>
                <th class="center">Kode Barang</th>
                <th class="center">Nama Barang</th>
                <th class="center">Harga</th>
                <th class="center">Jumlah Masuk</th>
                <th class="center">Satuan</th>
                 <th class="center">Stok</th>
                 
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel barang
            $query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_masuk,a.kode_barang,a.jumlah_masuk,b.stok,b.kode_barang,b.nama_barang,b.harga_beli,b.satuan
                                            FROM tb_masuk as a INNER JOIN tb_barang as b ON a.kode_barang=b.kode_barang ORDER BY kode_transaksi DESC")
                                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));

            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              $tanggal         = $data['tanggal_masuk'];
              $exp             = explode('-',$tanggal);
              $tanggal_masuk   = $exp[2]."-".$exp[1]."-".$exp[0];
			  $harga_beli = format_rupiah($data['harga_beli']);

              // menampilkan isi tabel dari database ke tabel di aplikasi
              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='100' class='center'>$data[kode_transaksi]</td>
                      <td width='80' class='center'>$tanggal_masuk</td>
                      <td width='80' class='center'>$data[kode_barang]</td>
                      <td width='200'>$data[nama_barang]</td>
					  <td width='100' align='right'>Rp. $harga_beli</td>
                      <td width='100' align='right'>$data[jumlah_masuk]</td>
                      <td width='80' class='center'>$data[satuan]</td>
					  <td width='80' class='center'>$data[stok]</td>
					  
                        </tr>";
              $no++;
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section>
<?php }
else if ($_SESSION['hak_akses']=='Agen') {
  ?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">

      <?php  
      // fungsi untuk menampilkan pesan
      // jika alert = "" (kosong)
      // tampilkan pesan "" (kosong)
      if (empty($_GET['alert'])) {
        echo "";
      } 
      // jika alert = 1
      // tampilkan pesan Sukses "Data Barang Masuk berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                Data Barang Masuk berhasil disimpan.
              </div>";
      }
      ?>

        <div class="box box-primary">
          <div class="box-body">
            <!-- tampilan tabel Barang -->
            <table id="dataTables1" class="table table-bordered table-striped table-hover">
              <!-- tampilan tabel header -->
              <thead>
                <tr>
                  <th class="center">No.</th>
                  <th class="center">Kode Transaksi</th>
                  <th class="center">Tanggal</th>
                  <th class="center">Kode Barang</th>
                  <th class="center">Nama Barang</th>
                  <th class="center">Harga Jual</th>
                  <th class="center">Jumlah Masuk</th>
                  <th class="center">Satuan</th>
                  
                </tr>
              </thead>
              <!-- tampilan tabel body -->
              <tbody>
              <?php  
              $no = 1;
              // fungsi query untuk menampilkan data dari tabel barang
              $query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_keluar,a.kode_barang,a.jumlah_keluar,a.created_user,a.status_terima,b.kode_barang,b.harga_jual,b.nama_barang,b.satuan
              FROM tb_keluar as a INNER JOIN tb_barang as b ON a.kode_barang=b.kode_barang ORDER BY kode_transaksi DESC")
                                              or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));

              // tampilkan data
              while ($data = mysqli_fetch_assoc($query)) { 
                if ($data['created_user'] == $_SESSION['nama_user']){
                  if($data['status_terima'] == 'terima'){
                    $tanggal         = $data['tanggal_keluar'];
                    $exp             = explode('-',$tanggal);
                    $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];
                    $harga_jual = format_rupiah($data['harga_jual']);

                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo "<tr>
                            <td width='30' class='center'>$no</td>
                            <td width='100' class='center'>$data[kode_transaksi]</td>
                            <td width='80' class='center'>$tanggal_keluar</td>
                            <td width='80' class='center'>$data[kode_barang]</td>
                            <td width='200'>$data[nama_barang]</td>
                            <td width='100' align='right'>Rp. $harga_jual</td>
                            <td width='100' align='right'>$data[jumlah_keluar]</td>
                            <td width='80' class='center'>$data[satuan]</td>
                  
                              </tr>";}
                  }
                    $no++;
              }
              ?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section>
<?php
}