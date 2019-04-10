<body>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Konfirmasi Pembayaran?</h4>
                <input type="hidden" id="no_penjualan_bank">
            </div>
            <div class="modal-body" id="isi_modal_bank">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="do_confirm_bank">Ya</button>
            </div>
        </div>

    </div>
</div>

<div id="myModalTermin" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Konfirmasi Pembayaran</h4>
                <input type="hidden" id="no_penjualan_termin">
            </div>
            <div class="modal-body row" id="isi_modal_termin">
<!--                <div class="form-group" id="tgl_jatuh_tempo_div">-->
<!--                    <label for="inputEmail3" class="col-sm-4 col-form-label">Jatuh Tempo</label>-->
<!--                    <div class="col-sm-8">-->
<!--                        <input type="date" class="form-control" id="tgl_jatuh_tempo_termin">-->
<!--                    </div>-->
<!--                </div>-->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Total Bayar</label>
                    <div class="col-sm-8">
                        <input type="hidden" class="form-control" id="total_bayar_termin" readonly>
                        <input type="text" class="form-control" id="total_bayar_termin_convert" readonly>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 50px">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Total Hutang</label>
                    <div class="col-sm-8">
                        <input type="hidden" class="form-control" id="total_hutang_termin" readonly>
                        <input type="text" class="form-control" id="total_hutang_termin_convert" readonly>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 100px">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Bayar</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="total_pembayaran_termin">
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="do_confirm_termin">Ya</button>
            </div>
        </div>

    </div>
</div>


<div class="container">
    <div class="text-center"><h1>Data Pembayaran</h1></div>

    <table class="table table-bordered top" id="tablePembayaran">
        <thead>
        <tr class="active">
            <th>No Penjualan</th>
            <th>Tanggal Pembayaran</th>
            <th>Customer</th>
            <th>Metode Pembayaran</th>
            <th>Expedisi</th>
            <th>Total Bayar</th>
            <th>Total Kembali</th>
            <th>Total Sisa</th>
            <th>Status</th>
            <th>Opsi</th>
        </tr>
        </thead>
        <tbody id="content">

        </tbody>
    </table>
    <script src="<?php echo base_url();?>assets/lib/DataTable/jquery.dataTables.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/JqueryDate/jquery-dateformat.min.js">      </script>
    <script>
        $(document).ready(function () {
            $.fn.dataTableExt.sErrMode = 'throw';
            function getPembayaran() {
                $.ajax({
                    url: 'showPembayaran',
                    async: false,
                    dataType: 'json',
                    success: function(data){
                        var html= '';

                        $.each(data,function (i,item) {

                            var metode = '';
                            var status = '';
                            var total_kembali = 0;
                            var total_hutang = 0;
                            var tgl_jatuh_tempo = '';
                            var button_bayar = '';
                            var nama_bank = '';
                            var expedisi = 'None';
                            var valTgl = $.format.date(item.tgl_jatuh_tempo,"yyyy-MM-dd");

                            if(item.method_pembayaran == 1){
                                    metode += 'Cash';
                            }else if(item.method_pembayaran == 2){
                                metode += 'Bank';
                            }else{
                                metode += 'Termin';
                            }
                            if(item.nama_bank != null){
                                nama_bank += item.nama_bank;
                            }

                            if(item.expedisi != null){
                                if(item.expedisi == "1"){
                                    expedisi = 'JNE (REG)';
                                }
                                else if(item.expedisi == "2"){
                                    expedisi = 'JNE (OKE)';
                                }
                                else if(item.expedisi == "3"){
                                    expedisi = 'POS INDONESIA';
                                }
                                else if(item.expedisi == "4"){
                                    expedisi = 'TIKI'
                                }
                            }


                            if(item.status == 'lunas'){
                                status += 'Lunas';
                            }else{
                                status += 'Belum Lunas';
                                button_bayar += '<a href="javascript:;" data-hutang="'+item.total_hutang+'" data-bayar="'+item.total_bayar+'" data-tgl="'+valTgl+'"  data-penjualan="'+item.id_payment+'" data-pembayaran="'+item.method_pembayaran+'" class="btn btn-success btn-xs item-bayar" title="Bayar" style="margin-top: 5px"><i class="glyphicon glyphicon-usd"></i> Bayar</a>';
                            }

                            if(item.total_kembali != null ){
                                total_kembali += parseInt(item.total_kembali);
                            }
                            if(item.total_hutang != null ){
                                total_hutang += parseInt(item.total_hutang);
                            }
                            if(item.tgl_jatuh_tempo != null){
                                tgl_jatuh_tempo += $.format.date(item.tgl_jatuh_tempo,"dd/MM/yyyy");
                            }
                            var bayar = item.total_bayar.toString();
                            var kembali = total_kembali.toString();
                            var hutang = total_hutang.toString();

                            var convertBayar = formatRupiah(bayar,'Rp. ');
                            var convertKembali = formatRupiah(kembali,'Rp. ');
                            var convertHutang = formatRupiah(hutang,'Rp. ');


                            html += '<tr>' +
                                '<th scope="row">'+item.no_penjualan+'</th>' +
                                '<td>'+$.format.date(item.tgl_pembayaran,"dd/MM/yyyy")+'</td>' +
                                '<td>'+item.nama_lengkap+'</td>' +
                                '<td>'+metode+' '+nama_bank+'</td>' +
                                '<td>'+expedisi+'</td>' +

                                '<td>'+convertBayar+'</td>' +
                                '<td>'+convertKembali+'</td>' +
                                '<td>'+convertHutang+'</td>' +
                                '<td>'+status+'</td>' +
                                '<td><a target="_blank" href="<?php echo base_url()."index.php/administrator/printInvoice/"?>'+item.no_penjualan+'" class="btn btn-warning btn-xs" title="Print"><i class="glyphicon glyphicon-file"></i> Print</a>'+button_bayar+'</td>'+
                                '</tr>';



                        });
                        $('#content').html(html);


                        $('#tablePembayaran').dataTable({
                            order: [ 0, 'desc' ]
                        });

                    },
                    error: function () {

                    }
                });
            }
            getPembayaran();

            function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split   		= number_string.split(','),
                    sisa     		= split[0].length % 3,
                    rupiah     		= split[0].substr(0, sisa),
                    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            var rupiah = document.getElementById('total_pembayaran_termin');
            rupiah.addEventListener('keyup', function(e){
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value, 'Rp. ');

            });


            $('#content').on("click",".item-bayar",function () {
                var no_penjualan = $(this).attr('data-penjualan');
                var method = $(this).attr('data-pembayaran');
                var tgl = $(this).attr('data-tgl');
                var bayar = $(this).attr('data-bayar');
                var hutang = $(this).attr('data-hutang');

                if(method == "2"){
                    $('#isi_modal_bank').html('<p>Apakah Anda ingin men-konfirmasi pembayaran ini?</p>');
                    $('#no_penjualan_bank').val(no_penjualan);
                    $('#myModal').modal('show');
                }else{
                    $('#no_penjualan_termin').val(no_penjualan);
                    // $('#tgl_jatuh_tempo_termin').val(tgl);
                    $('#tgl_jatuh_tempo_div').hide();
                    var hutang = hutang.toString();
                    var bayar = bayar.toString();
                    var convertHutang = formatRupiah(hutang,'Rp. ');
                    var convertBayar = formatRupiah(bayar,'Rp. ');
                    $('#total_hutang_termin').val(hutang);
                    $('#total_bayar_termin').val(bayar);
                    $('#total_hutang_termin_convert').val(convertHutang);
                    $('#total_bayar_termin_convert').val(convertBayar);
                    $('#myModalTermin').modal('show');
                }
            });

            $('#do_confirm_bank').click(function () {
                var no_penjualan = $('#no_penjualan_bank').val();
                $.ajax({
                    type : "ajax",
                    method :"post",
                    url  : 'confirmBank',
                    dataType : "json",
                    data : {no_penjualan:no_penjualan},
                    success: function(data){
                        $('#myModal').modal('hide');
                        toastr.success('Konfirmasi Berhasil', 'Sukses');
                        getPembayaran();

                    },error: function () {
                        toastr.error('Konfirmasi Gagal', 'Gagal');
                    }
                });
            });

            $('#do_confirm_termin').click(function () {
               var no_penjualan = $('#no_penjualan_termin').val();
               var tgl_jatuh_tempo = $('#tgl_jatuh_tempo_termin').val();
               var total_bayar = $('#total_bayar_termin').val();
               var total_hutang= $('#total_hutang_termin').val();
               var total_pembayaran = parseInt(rupiah.value.replace(/[\. ,:-Rp]+/g, ""));

               var jumlah = parseInt(total_bayar) + parseInt(total_pembayaran);
               var kurang = parseInt(total_hutang) - parseInt(total_pembayaran);
                $.ajax({
                    type : "ajax",
                    method :"post",
                    url  : 'confirmTermin',
                    dataType : "json",
                    data : {no_penjualan:no_penjualan,tgl_jatuh_tempo:tgl_jatuh_tempo,total_bayar:jumlah,total_hutang:kurang},
                    success: function(data){
                        $('#myModalTermin').modal('hide');
                        toastr.success('Konfirmasi Berhasil', 'Sukses');
                        getPembayaran();

                    },error: function () {
                        toastr.error('Konfirmasi Gagal', 'Gagal');
                    }
                });

            });



        });


    </script>

