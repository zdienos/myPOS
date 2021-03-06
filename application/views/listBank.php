<body>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Bank</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="exampleInputEmail2">Nama Bank &nbsp;</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Nama Bank">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">No Rekening &nbsp;</label>
                        <input type="text" class="form-control" id="no_rek" name="no_rek" placeholder="No Rekening">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" id="btn_addCategory" class="btn btn-success">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <span class="header-text">List</span>&nbsp;<span>Bank</span>

    <button type="button" class="btn btn-primary right-side pull-right" data-toggle="modal" data-target="#myModal">
        Tambah Bank
    </button>

    <hr class="hr-top">

</div>

<div class="container">



    <table class="table table-bordered" id="tableCategory">
        <thead>
        <tr class="active">
            <th class="text-center">ID</th>
            <th class="text-center">Nama Bank</th>
            <th class="text-center">No Rekening</th>
            <th class="text-center">Opsi</th>
        </tr>
        </thead>
        <tbody id="table">


        </tbody>
    </table>
</div>
<!-- update  -->
<div id="update" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-dialog" style="margin-top: 15%;">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="mySmallModalLabel">Ubah Bank</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Bank</label>
                        <input type="hidden" class="form-control" id="id_bank_e">
                        <input type="text" class="form-control" id="bank_name_e" placeholder="Nama Bank Baru">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Prefix</label>
                        <input type="text" class="form-control" id="no_rek_e">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                    <button type="submit" class="btn btn-primary" id="do_update">Selesai</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
</div>


<!-- modal delete -->
<div id="del" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hapus Kategori</h4>
                <input type="hidden" id="id_bank_del">
            </div>
            <div class="modal-body" id="isi_modal">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="do_delete">Ya</button>
            </div>
        </div>

    </div>
</div>


<script src="<?php echo base_url();?>assets/lib/DataTable/jquery.dataTables.min.js">      </script>
<script src="<?php echo base_url();?>assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>

<script>

    function getdata(){
        $.ajax({
            url: 'getBank',
            async: false,
            dataType: 'json',
            success: function(data){
                var html= '';
                $.each(data,function (i,item) {
                    var id = i + 1;
                    html += '<tr>'+
                        '<td>'+id+'</td>'+
                        '<td>'+item.nama_bank+'</td>'+
                        '<td>'+item.no_rek+'</td>'+
                        '<td><center><a href="javascript:;" class="btn btn-info btn-xs cat-edit" title="Edit" data-toggle="modal" data-target="#update" data-id="'+item.id_bank+'" data-name="'+item.nama_bank+'" data-pre="'+item.no_rek+'"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="javascript:;" class="btn btn-danger btn-xs cat-hapus" title="Hapus" data="'+item.id_bank+'"><i class="glyphicon glyphicon-trash"></i> Hapus</a></center></td>'+
                        '</tr>';
                });
                $('#table').html(html);
                $('#tableCategory').dataTable();
            },
            error: function () {
                alert("Something Wrong! Contact Administrator");
            }
        });
    }
    getdata();

    $('#btn_addCategory').on('click',function(){
        var a= $('#bank_name').val();
        var b= $('#no_rek').val();
        $.ajax({
            type : "ajax",
            method :"post",
            url  : 'addBank',
            dataType : "JSON",
            data : {nama_bank:a, no_rek:b},
            success: function(data){

                $('#bank_name').val("");
                $('#no_rek').val("");
                $('#myModal').modal('hide');
                toastr.success('Tambah Bank Berhasil', 'Sukses');
                getdata();

            },error: function () {
                toastr.error('Tambah Bank Gagal', 'Gagal');
            }
        });

        return false;
    });

    $(document).on("click", ".cat-edit", function(){
        var a = $(this).data('id');
        var b = $(this).data('name');
        var c = $(this).data('pre');

        $("#id_bank_e").val(a);
        $("#bank_name_e").val(b);
        $("#no_rek_e").val(c);

    });

    $('#do_update').on('click',function(){
        var a= $('#id_bank_e').val();
        var b= $('#bank_name_e').val();
        var c= $('#no_rek_e').val();
        $.ajax({
            type : "ajax",
            method :"post",
            url  : 'updatebank',
            dataType : "JSON",
            data : {id_bank:a, nama_bank:b, no_rek:c },
            success: function(data){

                $('#bank_name').val("");
                $('#no_rek_e').val("");
                $('#update').modal('hide');
                toastr.success('Edit Bank Berhasil', 'Sukses');
                getdata();

            },error: function () {
                toastr.error('Edit Bank Gagal', 'Gagal');
            }
        });

        return false;
    });


    // $('#table').on('click','.item-edit',function () {
    //        var id = $(this).attr('data');
    //        $('#update').modal('show');
    //        $('#myForm').attr('action','<?php echo base_url()?>index.php/administrator/updatecategory');
    //        var a = $('#id_category_e');
    //        var b = $('#category_name_e');

    //        $.ajax({
    //            type: 'ajax',
    //            method: 'get',
    //            url: 'editcategory' ,
    //            async: 'false',
    //            data:{id:id},
    //            dataType: 'json',
    //            success: function (data) {
    //                a.val(data.id_category);
    //                b.val(data.category_name);

    //            },
    //            error: function () {
    //                alert('Error');
    //            }
    //        });
    //    });

    $('#table').on('click','.cat-hapus',function () {
        var id = $(this).attr('data');
        $('#del').modal('show');
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: 'editbank' ,
            async: 'false',
            data:{id:id},
            dataType: 'json',
            success: function (data) {

                var isi = '<p>Apakah anda yakin ingin menghapus Bank '+data.nama_bank+' ?</p>';
                $('#isi_modal').html(isi);
                $('#id_bank_del').val(data.id_bank);
            },
            error: function () {
                alert('Error');
            }
        });
    });

    $('#do_delete').click(function () {
        var id = $('#id_bank_del').val();
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: 'delbank' ,
            async: 'false',
            data:{id:id},
            dataType: 'json',
            success: function (response) {

                if(response.success){

                    $('#del').modal('hide');
                    toastr.success('Hapus Bank Berhasil', 'Sukses');

                    getdata();

                }else{
                    toastr.error('Proses Gagal', 'Error');
                }

            },
            error: function () {
                alert('Error');
            }
        });
    });
</script>