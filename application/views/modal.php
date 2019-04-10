<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="width:500px">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post" id="myForm">
          <input type="hidden" id="kode_barang">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Barang</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang">
    </div>
  </div>
<!--  <div class="form-group row">-->
<!--    <label for="inputPassword3" class="col-sm-4 col-form-label">Jenis Barang</label>-->
<!--    <div class="col-sm-8">-->
<!--      <input type="text" class="form-control" id="jenis_barang" placeholder="Jenis Barang">-->
<!--    </div>-->
<!--  </div>-->
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Kategori Barang</label>
    <div class="col-sm-8">
<!--      <input type="text" class="form-control" id="sort_barang" placeholder="Sort Barang">-->
        <select class="form-control" id="category_barang">

        </select>
    </div>
  </div>
          <div class="form-group row">
              <label for="inputPassword3" class="col-sm-4 col-form-label">Supplier</label>
              <div class="col-sm-8">
                  <!--      <input type="text" class="form-control" id="sort_barang" placeholder="Sort Barang">-->
                  <select class="form-control" id="id_supplier">

                  </select>
              </div>
          </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Stok Barang</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="stok_barang" placeholder="Stok">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Satuan Barang</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="satuan_barang" placeholder="Satuan">
    </div>
  </div>
          <div class="form-group row">
              <label for="inputPassword3" class="col-sm-4 col-form-label">Berat Barang (gram)</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="berat_barang" placeholder="Masukan Angka Saja">
              </div>
          </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Harga HPP</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="harga_hpp" placeholder="Harga HPP">
        <input type="hidden" class="form-control" id="harga_asli_hpp">
    </div>
  </div><div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Harga Eceran</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="harga_retail" placeholder="Harga Eceran">
        <input type="hidden" class="form-control" id="harga_asli_retail">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Harga Grosir Luar</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="harga_dropship" placeholder="Harga Grosir Luar">
        <input type="hidden" class="form-control" id="harga_asli_dropship">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Harga Grosir Bandung</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="harga_grosir" placeholder="Harga Grosir Bandung">
        <input type="hidden" class="form-control" id="harga_asli_grosir">
    </div>
  </div>
          <div class="form-group row">
              <label for="inputPassword3" class="col-sm-4 col-form-label">Diskon</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="diskon_convert" placeholder="Masukan Nilai Rupiah">
                  <input type="hidden" class="form-control" id="diskon">
              </div>
          </div>
          <div class="form-group row" id="barcode_content">
              <label for="inputPassword3" class="col-sm-4 col-form-label">Barcode</label>
              <div class="col-sm-8">
                  <img src="" id="barcode">
              </div>
          </div>
  
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="simpan"><i class="fa fa-spinner fa-spin" style="margin-right: 5px" id="loading"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hapus Barang</h4>
                <input type="hidden" id="kode_barang_delete">
            </div>
            <div class="modal-body" id="isi_modal">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="do_delete">Hapus</button>
            </div>
        </div>

    </div>
</div>

<div id="barcode_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

            </div>
            <div class="modal-body" id="isi_modal">
                <table id="barcode_table">
                    <tr id="barcode_list_content">

                    </tr>
                </table>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="do_delete">Hapus</button>
            </div>
        </div>

    </div>
</div>




<script src="<?php echo base_url();?>assets/js/convertRupiah.js"></script>
