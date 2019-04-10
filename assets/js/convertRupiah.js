//Harga Hpp
var rupiah = document.getElementById('harga_hpp');
var rupiah2 = document.getElementById('harga_asli_hpp');

if(rupiah2.value != ""){
    rupiah.value = formatRupiah(rupiah2.value, 'Rp. ');
}
$('#harga_asli_hpp').change(function () {
   var convert = formatRupiah(rupiah2.value, 'Rp. ');
    rupiah.value = convert;
});

rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, 'Rp. ');
    rupiah2.value = rupiah.value.replace(/[\. ,:-Rp]+/g, "");
});

//Harga Retail

var rupiah3 = document.getElementById('harga_retail');
var rupiah4 = document.getElementById('harga_asli_retail');

if(rupiah4.value != ""){
    rupiah3.value = formatRupiah(rupiah4.value, 'Rp. ');
}
$('#harga_asli_retail').change(function () {
    var convert = formatRupiah(rupiah4.value, 'Rp. ');
    rupiah3.value = convert;
});
rupiah3.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah3.value = formatRupiah(this.value, 'Rp. ');
    rupiah4.value = rupiah3.value.replace(/[\. ,:-Rp]+/g, "");
});
//Harga Dropship

var rupiah5 = document.getElementById('harga_dropship');
var rupiah6 = document.getElementById('harga_asli_dropship');

if(rupiah6.value != ""){
    rupiah5.value = formatRupiah(rupiah6.value, 'Rp. ');
}

$('#harga_asli_dropship').change(function () {

    var convert = formatRupiah(rupiah6.value, 'Rp. ');
    rupiah5.value = convert;
});

rupiah5.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah5.value = formatRupiah(this.value, 'Rp. ');
    rupiah6.value = rupiah5.value.replace(/[\. ,:-Rp]+/g, "");
});


//Harga Grosir
var rupiah7 = document.getElementById('harga_grosir');
var rupiah8 = document.getElementById('harga_asli_grosir');

if(rupiah8.value != ""){
    rupiah7.value = formatRupiah(rupiah8.value, 'Rp. ');
}
$('#harga_asli_grosir').change(function () {
    var convert = formatRupiah(rupiah8.value, 'Rp. ');
    rupiah7.value = convert;
});
rupiah7.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah7.value = formatRupiah(this.value, 'Rp. ');
    rupiah8.value = rupiah7.value.replace(/[\. ,:-Rp]+/g, "");
});

//Diskon
var diskon = document.getElementById('diskon');
var convertDiskon = document.getElementById('diskon_convert');

if(diskon.value != ""){
    convertDiskon.value = formatRupiah(diskon.value, 'Rp. ');
}
$('#diskon').change(function () {
    var convert = formatRupiah(diskon.value, 'Rp. ');
    convertDiskon.value = convert;
});
diskon_convert.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    convertDiskon.value = formatRupiah(this.value, 'Rp. ');
    diskon.value = convertDiskon.value.replace(/[\. ,:-Rp]+/g, "");
});


/* Fungsi formatRupiah */
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