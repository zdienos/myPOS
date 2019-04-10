<body> 
<div class="container">
 <div class="text-center"><h1>Log Aktivitas</h1></div>
    <table class="table table-bordered top" id="table">
      <thead>
        <tr class="active">
          <th>No</th>
          <th>Tanggal/Waktu</th>
          <th>User</th>
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
        $.ajax({
            url: 'showLog',
            async: false,
            dataType: 'json',
            success: function(response){
                var html= '';

                $.each(response,function (i,item) {
                    var id = i + 1;
                    html += '<tr>' +
                        '<th scope="row">'+id+'</th>' +
                        '<td>'+$.format.date(item.time,"dd/MM/yyyy  HH:mm:ss a")+'</td>' +
                        '<td>'+item.username+'</td>' +
                        '<td>'+item.action+'</td>' +

                        '</tr>';



                });
                $('#content').html(html);

                $('#table').dataTable();

            },
            error: function () {

            }
        });
    </script>