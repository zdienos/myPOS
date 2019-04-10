<body>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="width:500px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">Edit Site Setting</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="myForm">
                    <input type="hidden" id="id_settting">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Toko</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_toko" placeholder="Nama Toko">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Alamat Toko</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamat_toko" placeholder="Alamat Toko">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">No Telpon Toko</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="telp_toko" placeholder="No Telpon Toko">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">No Hp Toko</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="hp_toko" placeholder="No Hp Toko">
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="text-center"><h1>Site Setting</h1></div>
    <table class="table table-bordered top" id="table">
        <thead>
        <tr class="active">

            <th>Nama Toko</th>
            <th>Alamat Toko</th>
            <th>No Telpon Toko</th>
            <th>No Hp Toko</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody id="content">

        </tbody>
    </table>
    <script src="<?php echo base_url();?>assets/lib/DataTable/jquery.dataTables.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/JqueryDate/jquery-dateformat.min.js">      </script>

    <script>
        function getSite(){
            $.ajax({
                url: 'showSetting',
                async: false,
                dataType: 'json',
                success: function(response){
                    var html= '';

                    $.each(response,function (i,item) {

                        html += '<tr>' +
                            '<th scope="row">'+item.nama_toko+'</th>' +
                            '<td>'+item.alamat_toko+'</td>' +
                            '<td>'+item.telp_toko+'</td>' +
                            '<td>'+item.hp_toko+'</td>' +
                            '<td><a href="javascript:;" class="btn btn-info btn-xs item-edit" title="Edit" data="'+item.id_setting+'"><i class="glyphicon glyphicon-edit"></i></a></td>' +

                            '</tr>';



                    });
                    $('#content').html(html);

                    $('#table').dataTable();

                },
                error: function () {

                }
            });

        }

        getSite();
        $('#content').on('click','.item-edit',function () {
           var id = $(this).attr('data');
            $('#exampleModal').modal('show');
           $('#id_settting').val(id);
            $.ajax({
                url: 'editSetting',
                data:{id:id},
                async: false,
                dataType: 'json',
                success: function(response){
              $.each(response,function (i,item) {

                  $('#nama_toko').val(item.nama_toko);
                  $('#alamat_toko').val(item.alamat_toko);
                  $('#telp_toko').val(item.telp_toko);
                  $('#hp_toko').val(item.hp_toko);

              });
                },
                error: function () {

                }
            });
        });

        $('#simpan').click(function () {
            var id = $("#id_settting").val();
            var nama_toko = $('#nama_toko').val();
            var alamat_toko = $('#alamat_toko').val();
            var telp_toko = $('#telp_toko').val();
            var hp_toko = $('#hp_toko').val();
            $.ajax({
                url: 'updateSetting',
                type:"post",
                data:{id:id,nama_toko:nama_toko,alamat_toko:alamat_toko,telp_toko:telp_toko,hp_toko:hp_toko},
                async: false,
                dataType: 'json',
                success: function(response){
                    toastr.success("Edit Berhasil");
                  getSite();
                  $('#exampleModal').modal('hide');
                    },
                error: function () {

                }
            });
        });
    </script>