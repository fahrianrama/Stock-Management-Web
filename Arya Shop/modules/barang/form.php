
 <?php  
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?> 
  <!-- tampilan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input Barang
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=barang"> Barang </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/barang/proses.php?act=insert" method="POST">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(kode_barang,5) as kode FROM tb_barang
                                                ORDER BY kode_barang DESC")
                                                or die('Ada kesalahan pada query tampil kode_barang : '.mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                  // mengambil data kode_barang
                  $data_id = mysqli_fetch_assoc($query_id);
                  $kode    = $data_id['kode']+1;
              } else {
                  $kode = 1;
              }

              // buat kode_barang
              $buat_id   = str_pad($kode, 5, "0", STR_PAD_LEFT);
              $kode_barang = "$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode barang</label>
                <div class="col-sm-5">
                  <!-- <input type="text" class="form-control" name="kode_barang" value="<?php echo $kode_barang; ?>" readonly required> -->
                  <select class="chosen-select" name="kode_barang" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value=""></option>
                    <option value="MK<?= $buat_id ?>">MK<?= $buat_id ?></option>
                    <option value="MB<?= $buat_id ?>">MB<?= $buat_id ?></option>
                    <option value="BU<?= $buat_id ?>">BU<?= $buat_id ?></option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama barang</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_barang" autocomplete="off" required>
                </div>
              </div>
<div class="form-group">
                <label class="col-sm-2 control-label">Kategori</label>
                <div class="col-sm-5">
                 <select class="chosen-select" name="kategori" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value=""></option>
                    <option value="Makanan Kering">MK||Makanan Kering</option>
                    <option value="Makanan Basah">MB||Makanan Basah</option>
                    <option value="Bumbu">BU||Bumbu</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Beli</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Jual</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Satuan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="satuan" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value=""></option>
                    <option value="Botol">Botol</option>
                    <option value="Box">Box</option>
                    <option value="Kotak">Kotak</option>
                    <option value="Strip">Strip</option>
                    <option value="Tube">Tube</option>
                    <option value="Pcs">Pcs</option>
                  </select>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=barang" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form']=='edit') { 
  if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel barang
      $query = mysqli_query($mysqli, "SELECT kode_barang,nama_barang,harga_beli,harga_jual,satuan,kategori FROM tb_barang WHERE kode_barang='$_GET[id]'") 
                                      or die('Ada kesalahan pada query tampil Data barang : '.mysqli_error($mysqli));
      $data  = mysqli_fetch_assoc($query);
    }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah barang
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=barang"> barang </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/barang/proses.php?act=update" method="POST">
            <div class="box-body">
              
              <div class="form-group">
                <label class="col-sm-2 control-label">Kode barang</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="kode_barang" value="<?php echo $data['kode_barang']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama barang</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_barang" autocomplete="off" value="<?php echo $data['nama_barang']; ?>" required>
                </div>
              </div>
<div class="form-group">
                <label class="col-sm-2 control-label">Kategori</label>
                <div class="col-sm-5">
                  <select class="" name="kategori" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value=""></option>
                    <option value="Makanan Kering">Makanan Kering</option>
                    <option value="Makanan Basah">Makanan Basah</option>
                    <option value="Bumbu">Bumbu</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Beli</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo format_rupiah($data['harga_beli']); ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Jual</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo format_rupiah($data['harga_jual']); ?>" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Satuan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="satuan" data-placeholder="-- Pilih --" autocomplete="off" required>
                    <option value="<?php echo $data['satuan']; ?>"><?php echo $data['satuan']; ?></option>
                    <option value="Botol">Botol</option>
                    <option value="Box">Box</option>
                    <option value="Kotak">Kotak</option>
                    <option value="Strip">Strip</option>
                    <option value="Tube">Tube</option>
                    <option value="Pcs">Pcs</option>
                  </select>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=barang" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>