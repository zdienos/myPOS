function GetAllBarang() {

    $.ajax({
       url: 'showAllBarang',
        async: false,
        dataType: 'json',
        success: function(data){
            var html= '';
            var htmlBarcode='';

         $.each(data,function (i,item) {
             var atasan = '';
             if(item.sort_barang == "1"){
                 atasan = 'Satu Stel';
             }else if(item.sort_barang == "2"){
                 atasan = 'Atasan';
             }else{
                 atasan = 'Bawahan';
             }
              html += '<tr>' +
                 '<th scope="row">'+item.kode_barang+'</th>' +
                 '<td>'+item.nama_barang+'</td>' +
                 '<td>'+item.jenis_barang+'</td>' +
                 '<td>'+atasan+'</td>' +
                 '<td>'+item.stock+'</td>' +
                 '<td>'+item.satuan+'</td>' +
                 '<td><a href="javascript:;" class="btn btn-primary btn-xs item-detail" title="Detail" data="'+item.kode_barang+'"><i class="glyphicon glyphicon-info-sign"></i></a> <a href="javascript:;" class="btn btn-info btn-xs item-edit" title="Edit" data="'+item.kode_barang+'"><i class="glyphicon glyphicon-edit"></i></a> <a href="javascript:;" class="btn btn-danger btn-xs item-delete" title="Hapus" data="'+item.kode_barang+'"><i class="glyphicon glyphicon-trash"></i></a> <a href="javascript:;" class="btn btn-warning btn-xs item-print" title="Print" data="'+item.kode_barang+'"><i class="glyphicon glyphicon-barcode"></i></a></td>\n' +
                 '</tr>';
             htmlBarcode += '<th><img src="/'+item.barcode+'"></th>';

         });
            $('#content').html(html);
            $('#barcode_content').html(htmlBarcode);

          $('#tableBarang').DataTable();

        },
        error: function () {
            alert("Something Wrong! Contact Administrator");
        }
    });
}