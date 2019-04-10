<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_data extends CI_Model {

function auth_user($username,$password){
        $query=$this->db->query("SELECT * FROM user WHERE username='$username' AND password='$password'");
        return $query;
    }

//User Manager
public function add_user($data = array()){
    	$this->load->database();
    	return $this->db->insert("user", $data);
    }

public function view_user(){ 
		$this->load->database();
		return $this->db->query("SELECT * FROM user")->result();
	}

public function delete_user($tabelname,$where){
       $delete = $this->db->delete($tabelname,$where);
       return $delete;
	}

public function edit_user($where, $table){
		return $this->db->get_where($table,$where);
	}
function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

//Supplier Manager
public function add_supp($data = array()){
    	$this->load->database();
    	return $this->db->insert("supplier", $data);
    	
    }

public function view_supp(){ 
		$this->load->database();
		return $this->db->query("SELECT * FROM supplier")->result();
	}


public function delete_supp($tabelname,$where){
       $delete = $this->db->delete($tabelname,$where);
       return $delete;
	}

public function edit_supp($where, $table){
		return $this->db->get_where($table,$where);
	}

	//Customer
public function add_customer($data = array()){
    	$this->load->database();
    	return $this->db->insert("customer", $data);
    }

public function view_customer(){ 
		$this->load->database();
		return $this->db->query("SELECT * FROM customer INNER JOIN role ON customer.role_id = role.role_id")->result();
	}

public function delete_customer($tabelname,$where){
       $delete = $this->db->delete($tabelname,$where);
       return $delete;
	}

public function edit_customer($where, $table){
		$this->db->where($where);
    $this->db->join('role','customer.role_id = role.role_id');

        $result = $this->db->get($table);
        return $result;
}

	//Barang
    public function showAllBarang()
    {
        $query = $this->db->query("SELECT * FROM barang INNER JOIN category ON barang.id_category = category.id_category");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

        public function addBarang(){
        $sort_barang = $this->input->post('category_barang');
        $this->db->select('RIGHT(barang.kode_barang,4) as kode', FALSE);
        $this->db->order_by('kode_barang','DESC');
        $this->db->limit(1);

            $this->db->where('id_category',$sort_barang);
            $query = $this->db->get('barang');

            if($query->num_rows() <> 0){
                //jika kode ternyata sudah ada.
                $data = $query->row();
                $kode = intval($data->kode) + 1;
            }
            else {
                //jika kode belum ada
                $kode = 1;
            }
            $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0

            $getPrefix = $this->db->query("SELECT prefix FROM category WHERE id_category ='$sort_barang'")->row()->prefix;
            $kodejadi = $getPrefix."-".$kodemax;


        //Barcode
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');

        $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$kodejadi), array())->draw();
        $imageName = $kodejadi.'.jpg';
        $imagePath = 'assets/image/barcode/'; // penyimpanan file barcode
        imagejpeg($imageResource, $imagePath.$imageName);
        $pathBarcode = $imagePath.$imageName; //Menyimpan path image bardcode kedatabase
        $diskon = $this->input->post('diskon');

        $field = array(
            'kode_barang' => $kodejadi,
            'nama_barang' => $this->input->post('nama_barang'),
            'stock' => $this->input->post('stok_barang'),
            'satuan' => $this->input->post('satuan_barang'),
            'harga_hpp' => $this->input->post('harga_hpp'),
            'harga_retail' => $this->input->post('harga_retail'),
            'harga_dropship' => $this->input->post('harga_dropship'),
            'harga_grosir' => $this->input->post('harga_grosir'),
            'diskon' => $diskon,
            'id_category' => $sort_barang,
            'id_supplier' => $this->input->post('id_supplier'),
            'berat' => $this->input->post('berat_barang'),
            'barcode' => $pathBarcode
        );
        $this->db->insert('barang',$field);
        if($this->db->affected_rows() > 0){
            helper_log('User menambah Barang dengan Kode Barang '.$kodejadi);
            return true;
        }else{
            return false;
        }
    }

    public function editBarang(){
        $id = $this->input->get('id');
        $this->db->where('kode_barang',$id);
        $query = $this->db->get('barang');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }
    public function updateBarang()
    {
        $id = $this->input->post('kode_barang');
        $diskon = $this->input->post('diskon');
        $category_id = $this->input->post('category_barang');
        $change = 0;

        $category = $this->db->query("SELECT id_category FROM barang WHERE kode_barang ='$id'")->row()->id_category;
        if ($category != $this->input->post('category_barang')) {
        $change += 1;
        }

        $field = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'id_supplier' => $this->input->post('id_supplier'),
            'stock' => $this->input->post('stok_barang'),
            'satuan' => $this->input->post('satuan_barang'),
            'harga_hpp' => $this->input->post('harga_hpp'),
            'harga_retail' => $this->input->post('harga_retail'),
            'harga_dropship' => $this->input->post('harga_dropship'),
            'harga_grosir' => $this->input->post('harga_grosir'),
            'diskon' => $diskon,
            'berat' => $this->input->post('berat_barang'),
        );

        $this->db->where('kode_barang', $id);
        $this->db->update('barang', $field);

        if($change == 1){
            $this->db->select('RIGHT(barang.kode_barang,4) as kode', FALSE);
            $this->db->order_by('kode_barang','DESC');
            $this->db->limit(1);

            $this->db->where('id_category',$category_id);
            $query = $this->db->get('barang');

            if($query->num_rows() <> 0){
                //jika kode ternyata sudah ada.
                $data = $query->row();
                $kode = intval($data->kode) + 1;
            }
            else {
                //jika kode belum ada
                $kode = 1;
            }
            $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0

            $getPrefix = $this->db->query("SELECT prefix FROM category WHERE id_category ='$category_id'")->row()->prefix;
            $kodejadi = $getPrefix."-".$kodemax;

            //Barcode
            $this->load->library('zend');
            $this->zend->load('Zend/Barcode');

            $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$kodejadi), array())->draw();
            $imageName = $kodejadi.'.jpg';
            $imagePath = 'assets/image/barcode/'; // penyimpanan file barcode
            imagejpeg($imageResource, $imagePath.$imageName);
            $pathBarcode = $imagePath.$imageName; //Menyimpan path image bardcode kedatabase


            $update= array(
              'kode_barang' => $kodejadi,
              'id_category' => $this->input->post('category_barang'),
                'barcode' => $pathBarcode
            );
            $this->db->where('kode_barang', $id);
            $this->db->update('barang', $update);

        }

        helper_log('User mengubah Barang dengan Kode Barang '.$id);
        return true;
    }
    function deleteBarang(){
        $id = $this->input->get('id');
        $retur = $this->db->query("SELECT * FROM reture WHERE kode_barang ='$id'");
      if($retur->num_rows() > 0){
        foreach ($retur->result_array() as $r){
            $this->db->where('no_reture', $r['no_reture']);
            $this->db->delete('reture');
        }
      }
        $pembelian_detail = $this->db->query("SELECT * FROM pembelian_detail WHERE kode_barang ='$id'");
        if($pembelian_detail->num_rows() > 0) {
            foreach ($pembelian_detail->result_array() as $p) {
                $this->db->where('id_pembelian', $p['id_pembelian']);
                $this->db->delete('pembelian_detail');
            }
            $getArray = $pembelian_detail->result();
            $this->db->where('no_faktur_pembelian', $getArray[0]->no_faktur_pembelian);
            $this->db->delete('pembelian');
        }
        $penjualan_detail = $this->db->query("SELECT * FROM penjualan_detail WHERE kode_barang ='$id'");
        if($penjualan_detail->num_rows() > 0) {
            foreach ($penjualan_detail->result_array() as $pj) {
                $this->db->where('id_penjualan', $pj['id_penjualan']);
                $this->db->delete('penjualan_detail');
            }
            $getArray = $penjualan_detail->result();
            $this->db->where('no_penjualan', $getArray[0]->no_faktur_penjualan);
            $this->db->delete('payment');
            $this->db->where('no_faktur_penjualan', $getArray[0]->no_faktur_penjualan);
            $this->db->delete('penjualan');

        }

        $this->db->where('kode_barang', $id);
        $this->db->delete('barang');
        if($this->db->affected_rows() > 0){
            helper_log('User menghapus Barang dengan Kode Barang '.$id);
            return true;
            return true;
        }else{
            return false;
        }
    }

    public function countBarang(){
        $query = $this->db->get('barang');

            return $query->num_rows();

    }

    public function fetchLabelBarang($limit, $start)
    {
        $this->db->order_by('kode_barang', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('barang');

        $result = $query->result();

        $this->db->save_queries = false;

        return $result;
    }
    public function fetchLabelBaragById($kode_barang){
       $this->db->where('kode_barang',$kode_barang);
        $query = $this->db->get('barang');

        $result = $query->result();

        $this->db->save_queries = false;

        return $result;
    }

    //Transaksi
    public function searchBarang($kode_barang)
    {
        $this->db->like('kode_barang', $kode_barang, 'both');
        $this->db->order_by('kode_barang', 'ASC');
        $this->db->limit(10);
        return $this->db->get('barang')->result();
    }

    public function addToCart(){
    $user_id = $this->session->userdata('ses_id');
        $kode_barang = $this->input->post('kode_barang');
        $customer = $this->input->post('id_customer');
        $nama_barang = $this->input->post('nama_barang');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');
        $harga_asli = $this->input->post('harga_asli');
        $jumlah = $this->input->post('jumlah');
            $diskon = $this->input->post('diskon');
            if($diskon == null || $diskon == ""){
                $diskon = 0;
            }
            $sub_total = $this->input->post('sub_total') - $diskon;
$user_id = $this->session->userdata('ses_id');


        $query = $this->db->query("SELECT no_faktur_penjualan FROM penjualan WHERE customer_id ='$customer' AND total_barang IS NULL AND user_id='$user_id' ");
        if($query->num_rows() > 0){
            $get_row = $query->row();
            $no_penjualan = $get_row->no_faktur_penjualan;
        }
        else{
            $this->db->select('RIGHT(penjualan.no_faktur_penjualan,4) as kode', FALSE);
            $this->db->order_by('no_faktur_penjualan','DESC');
            $this->db->limit(1);
            $query_penjualan = $this->db->get('penjualan');

            if($query_penjualan->num_rows() <> 0){
                //jika kode ternyata sudah ada.
                $data = $query_penjualan->row();
                $kode = intval($data->kode) + 1;
            }
            else {
                //jika kode belum ada
                $kode = 1;
            }
            $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
            $kodejadi = "PNJ-".$kodemax;

            $no_penjualan = $kodejadi;
            $insert_penjualan = array(
                'no_faktur_penjualan' => $no_penjualan,
                'tgl_penjualan' => date('Y-m-d H:i:s'),
                'customer_id' => $customer,
                'user_id' => $user_id
            );
            $this->db->insert('penjualan',$insert_penjualan);
        }



        $insert_penjualan_detail = array(
            'no_faktur_penjualan' => $no_penjualan,
            'kode_barang' => $kode_barang,
            'qty' => $jumlah,
            'diskon' => $diskon,
            'harga_barang' => $harga,
            'harga_barang_asli' => $harga_asli,
            'sub_total_harga' => $sub_total
        );
        $this->db->insert('penjualan_detail',$insert_penjualan_detail);

        $getStok = $this->db->query("SELECT stock FROM barang WHERE kode_barang ='$kode_barang'");
        $stok = $getStok->row()->stock;
        $hasilStok = $stok - $jumlah;

        $updateStok = array(
          'stock' => $hasilStok
        );
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('barang', $updateStok);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }


    }

    public function showCart(){
        $customer = $this->input->get('id_customer');
        $user_id = $this->session->userdata('ses_id');
        $query = $this->db->query("SELECT no_faktur_penjualan FROM penjualan WHERE customer_id ='$customer' AND total_barang IS NULL AND user_id ='$user_id'");
       if($query->num_rows() > 0){
        $get_row = $query->row();
        $no_penjualan = $get_row->no_faktur_penjualan;

        $result = $this->db->query("SELECT penjualan_detail.id_penjualan,penjualan_detail.no_faktur_penjualan,penjualan_detail.kode_barang,
        penjualan_detail.qty,penjualan_detail.diskon,penjualan_detail.harga_barang,penjualan_detail.harga_barang_asli,penjualan_detail.sub_total_harga,
         barang.nama_barang,barang.id_category,barang.id_supplier,barang.stock,barang.satuan,barang.harga_hpp,
         barang.harga_retail,barang.harga_dropship,barang.harga_grosir,barang.barcode,barang.berat
         FROM penjualan_detail INNER JOIN barang ON penjualan_detail.kode_barang = barang.kode_barang WHERE penjualan_detail.no_faktur_penjualan ='$no_penjualan' ");
        return $result->result();
       }else{
           return false;
       }
}

    public function editPenjualan(){
        $id = $this->input->get('id');
        $this->db->where('id_penjualan',$id);
        $query = $this->db->get('penjualan_detail');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    public function deletePenjualan(){
        $id = $this->input->get('id');
        $stock = $this->input->get('stock');
        $kode_barang = $this->input->get('kode_barang');

        $get_kode = $this->db->query("SELECT stock FROM barang WHERE kode_barang='$kode_barang'")->row()->stock;
        $sumStock = $get_kode + $stock;

        $updateBarang = array('stock' => $sumStock);
        $this->db->where('kode_barang',$kode_barang);
        $this->db->update('barang',$updateBarang);

        $this->db->where('id_penjualan', $id);
        $this->db->delete('penjualan_detail');
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function view_bank(){
        $this->load->database();
        return $this->db->query("SELECT * FROM list_bank")->result();
    }



    public function pembelian(){
        $this->load->database();
        return $this->db->query("SELECT * FROM supplier")->result();
    }

    public function barangnya(){
        $this->load->database();
        return $this->db->query("SELECT * FROM barang")->result();
    }

    public function data_beli(){
        $this->load->database();
        return $this->db->query("SELECT * FROM pembelian_detail INNER JOIN barang ON pembelian_detail.kode_barang = barang.kode_barang ")->result();
    }

    
    public function beli(){
        $kode_barang    = $this->input->post("kode_barang");
        $id_supplier    = $this->input->post("id_supplier");
        $qty            = $this->input->post("qty");
        $harga_barang   = $this->input->post("harga_barang");
        $sub_total_harga= $this->input->post($qty * $harga_barang);  


        $query = $this->db->query("SELECT no_faktur_pembelian FROM pembelian WHERE id_supplier ='$id_supplier' AND total_barang IS NULL ");
        if($query->num_rows() > 0){
            $get_row = $query->row();
            $no_pembelian = $get_row->no_faktur_pembelian;
        }
        else{
            $this->db->select('RIGHT(pembelian.no_faktur_pembelian,4) as kode', FALSE);
            $this->db->order_by('no_faktur_pembelian','DESC');
            $this->db->limit(1);
            $query_pembelian = $this->db->get('pembelian');

            if($query_pembelian->num_rows() <> 0){
                //jika kode ternyata sudah ada.
                $data = $query_pembelian->row();
                $kode = intval($data->kode) + 1;
            }
            else {
                //jika kode belum ada
                $kode = 1;
            }
            $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
            $kodejadi = "PMB-".$kodemax;

            $no_pembelian = $kodejadi;
            $insert_pembelian = array(
                'no_faktur_pembelian' => $no_pembelian,
                'tgl_pembelian' => date('Y-m-d H:i:s'),
                'id_supplier' => $id_supplier
            );
            $this->db->insert('pembelian',$insert_pembelian);
        }



        $insert_pembelian_detail = array(
            'no_faktur_pembelian' => $no_pembelian,
            'kode_barang' => $kode_barang,
            'qty' => $qty,
            'harga_barang' => $harga_barang,
            'sub_total_harga' => $qty * $harga_barang
        );
        $this->db->insert('pembelian_detail',$insert_pembelian_detail);
        
        $get_kode = $this->db->query("SELECT stock FROM barang WHERE kode_barang='$kode_barang'")->row()->stock;
        $sumStock = $get_kode + $qty;

        $updateBarang = array('stock' => $sumStock);
        $this->db->where('kode_barang',$kode_barang);
        $this->db->update('barang',$updateBarang);


        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getitem(){
        $id = $this->input->get('id_supplier');

        $query = $this->db->query("SELECT no_faktur_pembelian FROM pembelian WHERE id_supplier ='$id' AND total_barang IS NULL");
       if($query->num_rows() > 0){
        $get_row = $query->row();
        $no_pembelian = $get_row->no_faktur_pembelian;

        $result = $this->db->query("SELECT * FROM pembelian_detail INNER JOIN barang ON pembelian_detail.kode_barang = barang.kode_barang WHERE pembelian_detail.no_faktur_pembelian ='$no_pembelian' ");
        return $result->result();
       }else{
           return false;
       }

    }

    public function editPembelian(){
        $id = $this->input->get('id');
        $this->db->where('id_pembelian',$id);
        $query = $this->db->get('pembelian_detail');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    public function delPembelian(){
        $id = $this->input->get('id');
        $stock = $this->input->get('stock');
        $kode_barang = $this->input->get('kode_barang');

        $get_kode = $this->db->query("SELECT stock FROM barang WHERE kode_barang='$kode_barang'")->row()->stock;
        $sumStock = $get_kode - $stock;

        $updateBarang = array('stock' => $sumStock);
        $this->db->where('kode_barang',$kode_barang);
        $this->db->update('barang',$updateBarang);

        $this->db->where('id_pembelian', $id);
        $this->db->delete('pembelian_detail');
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function totalbelanja()
    {
        $id = $this->input->post('no_faktur_pembelian');
        $num = $this->input->post('no_faktur_pembelian');
    $tgl = $this->input->post('tgl_pembelian');
    $id = $this->input->post('id_supplier');
    $item = $this->input->post('total_barang');
    $price = $this->input->post('total_belanja');

        $field = array(
            'no_faktur_pembelian' => $num,
        'tgl_pembelian' => $tgl,
        
        'id_supplier' => $id,
        'total_barang' => $item,
        
        'total_harga' => $price 
        );

        $this->db->where('no_faktur_pembelian', $id);
        $this->db->update('pembelian', $field);
        return true;
    }

public function totalItem($where, $table){
        return $this->db->get_where($table,$where);
    }

public function getprovince(){
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: c37dd6dae4903faedec310006d7dd5bb"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return $err;
} else {
  return $response;
}

}

public function getCity(){
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: c37dd6dae4903faedec310006d7dd5bb"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return $err;
} else {
  return $response;
}

}


    
public function delbeli($tabelname,$where){
     $delete = $this->db->delete($tabelname,$where);
     return $delete;
    }  
public function pembayaran(){
    $user_id = $this->session->userdata('ses_id');
    $no_penjualan = $this->input->post('no_penjualan');
    $total_barang = $this->input->post('total_barang');
    $expedisi = $this->input->post('expedisi');
    $biaya_expedisi = $this->input->post('biaya_expedisi');
    $total_harga = $this->input->post('total_harga');
    $customer = $this->input->post('customer_id');
    $method_pembayaran = $this->input->post('method_pembayaran');
    $total_bayar = $this->input->post('total_bayar');
    $total_kembali = $this->input->post('total_kembali');
    $bank = $this->input->post('id_bank');
    $nama_customer = $this->input->post('nama_customer');
    $email = $this->input->post('email');
    $provinsi = $this->input->post('provinsi');
    $kota = $this->input->post('kota');
    $alamat = $this->input->post('alamat');
    $no_telp = $this->input->post('no_telp');

    $termin_sisa = $this->input->post('total_hutang');
    $termin_date = $this->input->post('tgl_jatuh_tempo');
    $status = 'lunas';


    if($method_pembayaran == "2"){
        $total_bayar = $total_harga;
        $total_kembali = 0;
        $status = 'belum_lunas';
    }

    if($nama_customer != null || $nama_customer != ""){
        $input_customer = array(
            'nama_lengkap' => $nama_customer,
            'email' => $email,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'role_id' => 3,
            'id_province' => $provinsi,
            'id_city' => $kota
        );
        $this->db->insert('customer',$input_customer);
        $customer_id = $this->db->insert_id();
        $customer = $customer_id;
        $field = array(
            'total_barang' => $total_barang,
            'expedisi' => $expedisi,
            'biaya_expedisi' => $biaya_expedisi,
            'total_harga' => $total_harga,
            'customer_id' => $customer
        );

        $this->db->where('no_faktur_penjualan', $no_penjualan);
        $this->db->update('penjualan', $field);
    }

    else{

    $field = array(
      'total_barang' => $total_barang,
      'expedisi' => $expedisi,
      'biaya_expedisi' => $biaya_expedisi,
      'total_harga' => $total_harga
    );

    $this->db->where('no_faktur_penjualan', $no_penjualan);
    $this->db->update('penjualan', $field);
    }

    if($method_pembayaran == "1" || $method_pembayaran == "2"){
    $insert = array(
      'customer_id' => $customer,
      'no_penjualan' => $no_penjualan,
        'tgl_pembayaran' => date('Y/m/d h:i:s'),
        'method_pembayaran' => $method_pembayaran,
        'id_bank' => $bank,
        'total_bayar' => $total_bayar,
        'total_kembali' => $total_kembali,
        'status' => $status
    );

    $this->db->insert('payment',$insert);
    }
    else{
        $insert = array(
            'customer_id' => $customer,
            'no_penjualan' => $no_penjualan,
            'tgl_pembayaran' => date('Y/m/d h:i:s'),
            'method_pembayaran' => $method_pembayaran,
            'total_bayar' => $total_bayar,
            'total_hutang' => $termin_sisa,
            'tgl_jatuh_tempo' => $termin_date,
            'status' => 'belum_lunas'
        );

        $this->db->insert('payment',$insert);
    }

    if($this->db->affected_rows() > 0){
        helper_log('User melakukan transaksi penjualan dengan No Faktur '.$no_penjualan);
        return true;
    }else{
        return false;
    }

}
public function getInvoice($no_penjualan){
$query = $this->db->query("SELECT * FROM penjualan INNER JOIN penjualan_detail ON penjualan.no_faktur_penjualan = penjualan_detail.no_faktur_penjualan INNER JOIN customer ON penjualan.customer_id = customer.customer_id INNER JOIN payment ON penjualan.no_faktur_penjualan = payment.no_penjualan INNER JOIN barang ON penjualan_detail.kode_barang = barang.kode_barang INNER JOIN category ON barang.id_category = category.id_category LEFT JOIN list_bank ON payment.id_bank = list_bank.id_bank WHERE penjualan.no_faktur_penjualan ='$no_penjualan'");
return $query->result();
}

public function addReture(){
$kode_barang = $this->input->post('kode_barang');
$jumlah = $this->input->post('jumlah');
$harga = $this->input->post('harga');
$status = $this->input->post('status');
$date = date('Y/m/d h:i:s');
$no_faktur = $this->input->post('no_faktur');

if($status == "baik"){
    $barang = $this->db->query("SELECT stock FROM barang WHERE kode_barang='$kode_barang'")->row();
    $stok = $barang->stock + $jumlah;
    $update = array(
        'stock' => $stok
    );

    $this->db->where('kode_barang',$kode_barang);
    $this->db->update('barang',$update);
}
    $this->db->select('RIGHT(reture.no_reture,4) as kode', FALSE);
    $this->db->order_by('no_reture','DESC');
    $this->db->limit(1);


        $query = $this->db->get('reture');

        if($query->num_rows() <> 0){
            //jika kode ternyata sudah ada.
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        }
        else {
            //jika kode belum ada
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "RTR-".$kodemax;

        $insert = array(
            'no_reture' => $kodejadi,
            'no_faktur_penjualan' => $no_faktur,
            'tgl_reture' => $date,
            'kode_barang' => $kode_barang,
            'total_barang' => $jumlah,
            'total_harga' => $harga,
            'status' => $status
        );

        $this->db->insert('reture',$insert);

//        $id_penjualan = $this->input->post('id_penjualan');
//        $penjualan_detail = $this->db->query("SELECT qty FROM penjualan_detail WHERE id_penjualan ='$id_penjualan'")->row();
//        $stok_penjualan = $penjualan_detail->qty - $jumlah;
//        $update_penjualan = array(
//            'qty' => $stok_penjualan
//        );
//        $this->db->where('id_penjualan',$id_penjualan);
//        $this->db->update('penjualan_detail',$update_penjualan);

    if($this->db->affected_rows() > 0){
        return true;
    }else{
        return false;
    }
}

public function showReture(){
    $query = $this->db->query("SELECT * FROM reture INNER JOIN barang ON reture.kode_barang = barang.kode_barang");
    return $query->result();

}

public function editReture(){
    $id = $this->input->get('id');
    $this->db->where('no_reture',$id);
    $query = $this->db->get('reture');
    if($query->num_rows() > 0){
        return $query->row();
    }else{
        return false;
    }
}

public function deleteReture(){
    $id = $this->input->get('id');
    $this->db->where('no_reture', $id);
    $this->db->delete('reture');
    if($this->db->affected_rows() > 0){
        return true;
    }else{
        return false;
    }
}

public function showPembayaran(){
    $query = $this->db->query("SELECT * FROM payment INNER JOIN customer ON payment.customer_id = customer.customer_id INNER JOIN penjualan ON payment.no_penjualan = penjualan.no_faktur_penjualan LEFT JOIN list_bank ON payment.id_bank = list_bank.id_bank");
    return $query->result();
}

public function showPenjualan(){
    $user_id = $this->session->userdata('ses_id');
    $query = $this->db->query("SELECT * FROM penjualan WHERE user_id ='$user_id'");
    return $query->result();
}
public function showReturPenjualan(){
    $id = $this->input->get('no_faktur');
    $query = $this->db->query("SELECT penjualan.no_faktur_penjualan,customer.nama_lengkap,barang.kode_barang,barang.nama_barang,penjualan_detail.qty,penjualan_detail.sub_total_harga,penjualan_detail.id_penjualan,penjualan_detail.harga_barang FROM penjualan INNER JOIN penjualan_detail ON penjualan.no_faktur_penjualan = penjualan_detail.no_faktur_penjualan
    INNER JOIN customer ON penjualan.customer_id = customer.customer_id INNER JOIN barang ON penjualan_detail.kode_barang = barang.kode_barang WHERE penjualan.no_faktur_penjualan = '$id' 
");
    return $query->result();
}

public function showLog(){
    $query = $this->db->query("SELECT log.id_log , log.time , log.action,user.username FROM log INNER JOIN user ON log.user_id = user.user_id ORDER BY log.time DESC")->result();
    return $query;
}
public function saveLog($param){
    $sql        = $this->db->insert('log',$param);
    return $this->db->affected_rows($sql    );
}
public function addCategory(){
        $this->load->database();
        
            $insert = array(
                'id_category' => $this->input->post("id_category"),
                'category_name' => $this->input->post("category_name"),                
                'prefix' => $this->input->post("prefix")                
        );
            $ins = $this->db->insert("category", $insert);
    }

public function delcategory(){
    $id = $this->input->get('id');
    $this->db->where('id_category', $id);
    $this->db->delete('category');
    if($this->db->affected_rows() > 0){
        return true;
    }else{
        return false;
    }
}    

public function editcategory(){
        $id = $this->input->get('id');
        $a = $this->db->where('id_category',$id);
        $query = $this->db->get('category');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

 public function getCategory(){
        $this->load->database();
        return $this->db->query("SELECT * FROM category")->result();
    }
    
 public function updatecategory()
    {
        $id = $this->input->post('id_category');
        $ins = array(            
            'category_name' => $this->input->post('category_name'),
            'prefix' => $this->input->post('prefix'),
        );
        helper_log('Kategori dengan ID"'.$id.'" telah diubah');
        $this->db->where('id_category', $id);
        $this->db->update('category', $ins);
        return true;
    }

    public function confirmBank(){
    $id = $this->input->post('no_penjualan');
    $update = array(
        'status' => 'lunas'
    );

    $this->db->where('id_payment',$id);
    $this->db->update('payment',$update);
    return true;

    }

    public function confirmTermin(){
        $id = $this->input->post('no_penjualan');
        $tgl_jatuh_tempo = $this->input->post('tgl_jatuh_tempo');
        $total_bayar = $this->input->post('total_bayar');
        $total_hutang = $this->input->post('total_hutang');
        $total_sisa = 0;
        $status = 'belum_lunas';

        if($total_hutang <= 0){
            $total_sisa +=  abs($total_hutang);
            $status = 'lunas';
            $total_hutang = 0;
        }
        $update = array(
            'status' => $status,
            'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
            'total_bayar' => $total_bayar,
            'total_hutang' => $total_hutang,
            'total_kembali' => $total_sisa
        );
        helper_log('Pembayaran dengan No Pembayaran "'.$id.'" telah dikonfirmasi');
        $this->db->where('id_payment',$id);
        $this->db->update('payment',$update);


    }

    public function laporanDataBarang(){
        $hsl=$this->db->query("SELECT * FROM barang JOIN category ON barang.id_category=category.id_category GROUP BY barang.id_category,barang.nama_barang");
        return $hsl;
    }

    public function laporanDataPenjualan(){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        $hsl = $this->db->query("SELECT penjualan.no_faktur_penjualan , DATE_FORMAT(penjualan.tgl_penjualan,'%d %M %Y') AS jual_tanggal,penjualan_detail.kode_barang,barang.nama_barang,barang.satuan,barang.harga_retail
         ,barang.harga_grosir,barang.harga_dropship,penjualan_detail.qty,penjualan_detail.diskon,penjualan.total_harga,penjualan_detail.sub_total_harga,penjualan.biaya_expedisi,
          payment.method_pembayaran,payment.id_bank,list_bank.nama_bank
          FROM penjualan INNER JOIN penjualan_detail ON penjualan.no_faktur_penjualan = penjualan_detail.no_faktur_penjualan
         INNER JOIN barang ON penjualan_detail.kode_barang = barang.kode_barang
          INNER JOIN payment ON penjualan.no_faktur_penjualan = payment.no_penjualan
          LEFT JOIN list_bank ON payment.id_bank = list_bank.id_bank
          ORDER BY penjualan.no_faktur_penjualan DESC ");
        return $hsl;
    }

    public function getTotalPenjualan(){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        $hsl = $this->db->query("SELECT SUM(total_harga) AS total,SUM(biaya_expedisi) AS total_expedisi FROM penjualan");
        return $hsl;
    }

    public function getTotalExpedisi(){
        $hsl = $this->db->query("SELECT no_faktur_penjualan,biaya_expedisi FROM penjualan WHERE biaya_expedisi != 0 ");
        return $hsl;
    }

    public function getBulanPenjualan(){
        $hsl=$this->db->query("SELECT DISTINCT DATE_FORMAT(tgl_penjualan,'%M %Y') AS bulan FROM penjualan");
        return $hsl;
    }

    public function getTahunPenjualan(){
        $hsl=$this->db->query("SELECT DISTINCT YEAR(tgl_penjualan) AS tahun FROM penjualan");
        return $hsl;
    }


    public function laporanDataPenjualanTanggal($tgl,$tgl_akhir){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        if($tgl_akhir == null){
            $hsl = $this->db->query("SELECT penjualan.no_faktur_penjualan , DATE_FORMAT(penjualan.tgl_penjualan,'%d %M %Y') AS jual_tanggal,penjualan_detail.kode_barang,barang.nama_barang,barang.satuan,barang.harga_retail
         ,barang.harga_grosir,barang.harga_dropship,penjualan_detail.qty,penjualan_detail.diskon,penjualan.total_harga,penjualan_detail.sub_total_harga,penjualan.biaya_expedisi,
           payment.method_pembayaran,payment.id_bank,list_bank.nama_bank
          FROM penjualan INNER JOIN penjualan_detail ON penjualan.no_faktur_penjualan = penjualan_detail.no_faktur_penjualan
         INNER JOIN barang ON penjualan_detail.kode_barang = barang.kode_barang
          INNER JOIN payment ON penjualan.no_faktur_penjualan = payment.no_penjualan
          LEFT JOIN list_bank ON payment.id_bank = list_bank.id_bank WHERE DATE(penjualan.tgl_penjualan) ='$tgl' ORDER BY penjualan.no_faktur_penjualan DESC ");
        }else{
            $hsl = $this->db->query("SELECT penjualan.no_faktur_penjualan , DATE_FORMAT(penjualan.tgl_penjualan,'%d %M %Y') AS jual_tanggal,penjualan_detail.kode_barang,barang.nama_barang,barang.satuan,barang.harga_retail
         ,barang.harga_grosir,barang.harga_dropship,penjualan_detail.qty,penjualan_detail.diskon,penjualan.total_harga,penjualan_detail.sub_total_harga,penjualan.biaya_expedisi,
             payment.method_pembayaran,payment.id_bank,list_bank.nama_bank
          FROM penjualan INNER JOIN penjualan_detail ON penjualan.no_faktur_penjualan = penjualan_detail.no_faktur_penjualan
         INNER JOIN barang ON penjualan_detail.kode_barang = barang.kode_barang
          INNER JOIN payment ON penjualan.no_faktur_penjualan = payment.no_penjualan
          LEFT JOIN list_bank ON payment.id_bank = list_bank.id_bank WHERE DATE(penjualan.tgl_penjualan) BETWEEN '$tgl' AND '$tgl_akhir' ORDER BY penjualan.no_faktur_penjualan DESC ");
        }
        return $hsl;
    }

    public function getTotalPenjualanTanggal($tgl,$tgl_akhir){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        if($tgl_akhir == null){
            $hsl = $this->db->query("SELECT SUM(total_harga) AS total,SUM(biaya_expedisi) AS total_expedisi FROM penjualan WHERE DATE(penjualan.tgl_penjualan) ='$tgl'");
        }else{
            $hsl = $this->db->query("SELECT SUM(total_harga) AS total,SUM(biaya_expedisi) AS total_expedisi FROM penjualan WHERE DATE(penjualan.tgl_penjualan) BETWEEN '$tgl' AND '$tgl_akhir'");
        }
        return $hsl;
    }

    public function getTotalExpedisiTanggal($tgl,$tgl_akhir){
        if($tgl_akhir == null){
            $hsl = $this->db->query("SELECT no_faktur_penjualan,biaya_expedisi FROM penjualan WHERE biaya_expedisi != 0 AND DATE(penjualan.tgl_penjualan) ='$tgl' ");
        }else{
            $hsl = $this->db->query("SELECT no_faktur_penjualan,biaya_expedisi FROM penjualan WHERE biaya_expedisi != 0 AND DATE(penjualan.tgl_penjualan) BETWEEN '$tgl' AND '$tgl_akhir' ");
        }
        return $hsl;

    }

    public function laporanDataPenjualanBulan($tgl){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        $hsl = $this->db->query("SELECT penjualan.no_faktur_penjualan , DATE_FORMAT(penjualan.tgl_penjualan,'%d %M %Y') AS jual_tanggal,DATE_FORMAT(penjualan.tgl_penjualan,'%M %Y') AS bulan_jual,penjualan_detail.kode_barang,barang.nama_barang,barang.satuan,barang.harga_retail
         ,barang.harga_grosir,barang.harga_dropship,penjualan_detail.qty,penjualan_detail.diskon,penjualan.total_harga,penjualan_detail.sub_total_harga,penjualan.biaya_expedisi,
            payment.method_pembayaran,payment.id_bank,list_bank.nama_bank
          FROM penjualan INNER JOIN penjualan_detail ON penjualan.no_faktur_penjualan = penjualan_detail.no_faktur_penjualan
         INNER JOIN barang ON penjualan_detail.kode_barang = barang.kode_barang
          INNER JOIN payment ON penjualan.no_faktur_penjualan = payment.no_penjualan
          LEFT JOIN list_bank ON payment.id_bank = list_bank.id_bank WHERE DATE_FORMAT(penjualan.tgl_penjualan,'%M %Y') ='$tgl' ORDER BY penjualan.no_faktur_penjualan DESC ");
        return $hsl;
    }

    public function getTotalPenjualanBulan($tgl){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        $hsl = $this->db->query("SELECT SUM(total_harga) AS total,SUM(biaya_expedisi) AS total_expedisi FROM penjualan WHERE DATE_FORMAT(penjualan.tgl_penjualan,'%M %Y') ='$tgl'");
        return $hsl;
    }

    public function getTotalExpedisiBulan($tgl){
        $hsl = $this->db->query("SELECT no_faktur_penjualan,biaya_expedisi FROM penjualan WHERE biaya_expedisi != 0 AND DATE_FORMAT(penjualan.tgl_penjualan,'%M %Y') ='$tgl' ");
        return $hsl;
    }


    public function laporanDataPenjualanTahun($tgl){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        $hsl = $this->db->query("SELECT penjualan.no_faktur_penjualan , DATE_FORMAT(penjualan.tgl_penjualan,'%d %M %Y') AS jual_tanggal,DATE_FORMAT(penjualan.tgl_penjualan,'%Y') AS tahun_jual,penjualan_detail.kode_barang,barang.nama_barang,barang.satuan,barang.harga_retail
         ,barang.harga_grosir,barang.harga_dropship,penjualan_detail.qty,penjualan_detail.diskon,penjualan.total_harga,penjualan_detail.sub_total_harga,penjualan.biaya_expedisi,
            payment.method_pembayaran,payment.id_bank,list_bank.nama_bank
          FROM penjualan INNER JOIN penjualan_detail ON penjualan.no_faktur_penjualan = penjualan_detail.no_faktur_penjualan
         INNER JOIN barang ON penjualan_detail.kode_barang = barang.kode_barang
          INNER JOIN payment ON penjualan.no_faktur_penjualan = payment.no_penjualan
          LEFT JOIN list_bank ON payment.id_bank = list_bank.id_bank WHERE YEAR(penjualan.tgl_penjualan) ='$tgl' ORDER BY penjualan.no_faktur_penjualan DESC ");
        return $hsl;
    }

    public function getTotalPenjualanTahun($tgl){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        $hsl = $this->db->query("SELECT SUM(total_harga) AS total,SUM(biaya_expedisi) AS total_expedisi FROM penjualan WHERE YEAR (penjualan.tgl_penjualan) ='$tgl'");
        return $hsl;
    }

    public function getTotalExpedisiTahun($tgl){
        $hsl = $this->db->query("SELECT no_faktur_penjualan,biaya_expedisi FROM penjualan WHERE biaya_expedisi != 0 AND YEAR(penjualan.tgl_penjualan) ='$tgl' ");
        return $hsl;
    }


    function laporanDataPenjualanLaba($bulan){
        $hsl=$this->db->query("SELECT DATE_FORMAT(penjualan.tgl_penjualan,'%d %M %Y %H:%i:%s') as jual_tanggal,
      barang.nama_barang,barang.satuan,barang.harga_hpp,penjualan_detail.harga_barang,penjualan_detail.harga_barang_asli,
      (penjualan_detail.harga_barang_asli-barang.harga_hpp) AS keunt,penjualan_detail.qty,(penjualan_detail.diskon) AS diskon,((penjualan_detail.harga_barang_asli - barang.harga_hpp)*penjualan_detail.qty)-penjualan_detail.diskon AS untung_bersih
        FROM penjualan JOIN penjualan_detail ON penjualan.no_faktur_penjualan=penjualan_detail.no_faktur_penjualan JOIN barang ON penjualan_detail.kode_barang = barang.kode_barang WHERE DATE_FORMAT(penjualan.tgl_penjualan,'%M %Y')='$bulan'");
        return $hsl;
    }
    function getTotalPenjualanLaba($bulan){
        $hsl=$this->db->query("SELECT DATE_FORMAT(penjualan.tgl_penjualan,'%M %Y') AS bulan,barang.nama_barang,barang.satuan,barang.harga_hpp,penjualan_detail.harga_barang,(penjualan_detail.harga_barang-barang.harga_hpp) AS keunt,penjualan_detail.qty,(barang.harga_retail * penjualan_detail.diskon) AS diskon,
SUM(((penjualan_detail.harga_barang_asli - barang.harga_hpp)*penjualan_detail.qty)- penjualan_detail.diskon) AS total
        FROM penjualan JOIN penjualan_detail ON penjualan.no_faktur_penjualan=penjualan_detail.no_faktur_penjualan JOIN barang ON penjualan_detail.kode_barang = barang.kode_barang WHERE DATE_FORMAT(penjualan.tgl_penjualan,'%M %Y')='$bulan'");
        return $hsl;
    }



    public function laporanDataReturTanggal($tgl,$tgl_akhir){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        if($tgl_akhir == null){
           $hsl = $this->db->query("SELECT no_reture,no_faktur_penjualan, DATE_FORMAT(tgl_reture,'%d %M %Y') AS jual_tanggal,kode_barang,total_barang,total_harga,status FROM reture WHERE DATE(tgl_reture) ='$tgl' ORDER BY no_reture DESC");
        }else{

            $hsl = $this->db->query("SELECT no_reture,no_faktur_penjualan, DATE_FORMAT(tgl_reture,'%d %M %Y') AS jual_tanggal,kode_barang,total_barang,total_harga,status FROM reture WHERE DATE(tgl_reture) BETWEEN '$tgl' AND '$tgl_akhir' ORDER BY no_reture DESC");

        }
        return $hsl;
    }

    public function getTotalReturTanggal($tgl,$tgl_akhir){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        if($tgl_akhir == null){
            $hsl = $this->db->query("SELECT SUM(total_harga) AS total FROM reture WHERE DATE(reture.tgl_reture) ='$tgl'");
        }else{
            $hsl = $this->db->query("SELECT SUM(total_harga) AS total FROM reture WHERE DATE(reture.tgl_reture) BETWEEN '$tgl' AND '$tgl_akhir'");
        }
        return $hsl;
    }
    public function laporanDataPiutangTanggal($tgl,$tgl_akhir){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        if($tgl_akhir == null){
            $hsl = $this->db->query("SELECT payment.no_penjualan, DATE_FORMAT(payment.tgl_pembayaran,'%d %M %Y') AS jual_tanggal,customer.nama_lengkap,penjualan.total_harga,payment.total_bayar,payment.total_hutang FROM payment
 INNER JOIN customer ON payment.customer_id = customer.customer_id INNER JOIN penjualan ON payment.no_penjualan = penjualan.no_faktur_penjualan
 WHERE DATE(payment.tgl_pembayaran) ='$tgl' AND payment.total_hutang != '0' OR payment.total_hutang IS NOT NULL GROUP BY payment.customer_id,payment.no_penjualan ORDER BY customer.nama_lengkap ASC");
        }else{
            $hsl = $this->db->query("SELECT payment.no_penjualan, DATE_FORMAT(payment.tgl_pembayaran,'%d %M %Y') AS jual_tanggal,customer.nama_lengkap,penjualan.total_harga,payment.total_bayar,payment.total_hutang FROM payment
 INNER JOIN customer ON payment.customer_id = customer.customer_id INNER JOIN penjualan ON payment.no_penjualan = penjualan.no_faktur_penjualan
 WHERE DATE(payment.tgl_pembayaran) BETWEEN '$tgl' AND '$tgl_akhir' AND payment.total_hutang != '0' OR payment.total_hutang IS NOT NULL GROUP BY payment.customer_id,payment.no_penjualan ORDER BY customer.nama_lengkap ASC");

//BETWEEN '$tgl' AND '$tgl_akhir'
        }
        return $hsl;
    }

    public function getTotalPiutangTanggal($tgl,$tgl_akhir){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        if($tgl_akhir == null){
            $hsl = $this->db->query("SELECT SUM(total_hutang) AS total FROM payment WHERE DATE(payment.tgl_pembayaran) ='$tgl'");
        }else{
            $hsl = $this->db->query("SELECT SUM(total_hutang) AS total FROM payment WHERE DATE(payment.tgl_pembayaran) BETWEEN '$tgl' AND '$tgl_akhir'");
        }
        return $hsl;
    }

    public function laporanDataBankTanggal($tgl,$tgl_akhir,$bank){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        if($tgl_akhir == null){
            $hsl = $this->db->query("SELECT payment.no_penjualan, DATE_FORMAT(payment.tgl_pembayaran,'%d %M %Y') AS jual_tanggal,payment.total_bayar,list_bank.nama_bank FROM payment JOIN list_bank ON payment.id_bank = list_bank.id_bank
            WHERE DATE(payment.tgl_pembayaran) ='$tgl' AND payment.id_bank ='$bank' ORDER BY payment.no_penjualan DESC");
        }else{
            $hsl = $this->db->query("SELECT payment.no_penjualan, DATE_FORMAT(payment.tgl_pembayaran,'%d %M %Y') AS jual_tanggal,payment.total_bayar,list_bank.nama_bank FROM payment JOIN list_bank ON payment.id_bank = list_bank.id_bank
            WHERE DATE(payment.tgl_pembayaran) BETWEEN '$tgl' AND '$tgl_akhir' AND payment.id_bank ='$bank' ORDER BY payment.no_penjualan DESC");

        }
        return $hsl;
    }

    public function getTotalBankTanggal($tgl,$tgl_akhir,$bank){
//        $hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
        if($tgl_akhir == null){
            $hsl = $this->db->query("SELECT SUM(total_bayar) AS total FROM payment WHERE DATE(tgl_pembayaran) ='$tgl' AND id_bank ='$bank' ");
        }else{
            $hsl = $this->db->query("SELECT SUM(total_bayar) AS total FROM payment WHERE DATE(tgl_pembayaran) BETWEEN '$tgl' AND '$tgl_akhir' AND id_bank ='$bank'");
        }
        return $hsl;
    }

    function showSetting(){
        $query = $this->db->get('site_setting')->result();
        return $query;
    }
    function editSetting(){
    $id = $this->input->get('id');
    $this->db->where('id_setting',$id);
    $query = $this->db->get('site_setting');
    return $query->result();
    }
    function updateSetting(){
    $id= $this->input->post('id');
    $nama_toko = $this->input->post('nama_toko');
    $alamat_toko = $this->input->post('alamat_toko');
    $telp_toko = $this->input->post('telp_toko');
    $hp_toko = $this->input->post('hp_toko');
    $update = array(
      'nama_toko' => $nama_toko,
      'telp_toko' => $telp_toko,
      'hp_toko' => $hp_toko,
      'alamat_toko' => $alamat_toko
    );
    $this->db->where('id_setting',$id);
    $this->db->update('site_setting',$update);
return true;
}

    public function addBank(){
        $this->load->database();

        $insert = array(
            'nama_bank' => $this->input->post("nama_bank"),
            'no_rek' => $this->input->post("no_rek")
        );
        $ins = $this->db->insert("list_bank", $insert);
    }

    public function delbank(){
        $id = $this->input->get('id');
        $this->db->where('id_bank', $id);
        $this->db->delete('list_bank');
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function editbank(){
        $id = $this->input->get('id');
        $this->db->where('id_bank',$id);
        $query = $this->db->get('list_bank');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    public function getBank(){
        $this->load->database();
        return $this->db->query("SELECT * FROM list_bank")->result();
    }

    public function updatebank()
    {
        $id = $this->input->post('id_bank');
        $ins = array(
            'nama_bank' => $this->input->post('nama_bank'),
            'no_rek' => $this->input->post('no_rek'),
        );

        $this->db->where('id_bank', $id);
        $this->db->update('list_bank', $ins);
        return true;
    }

    public function countTotalPenjualan(){
        $query = $this->db->query("SELECT COUNT(no_faktur_penjualan) as total FROM penjualan WHERE total_barang IS NOT NULL" )->row();
        return $query->total;
    }

    public function countTotalPenjualanDate(){
        $date = date("m Y");
        $query = $this->db->query("SELECT COUNT(no_faktur_penjualan) as total FROM penjualan WHERE total_barang IS NOT NULL AND DATE_FORMAT(tgl_penjualan,'%m %Y')='$date'" )->row();
        return $query->total;
    }

     public function countTotalPendapatan(){
        $date = date("m Y");
        $query = $this->db->query("SELECT SUM(total_harga) as total FROM penjualan WHERE total_barang IS NOT NULL" )->row();
        return $query->total;
    }

    public function countTotalPendapatanDate(){
        $date = date("m Y");
        $query = $this->db->query("SELECT SUM(total_harga) as total FROM penjualan WHERE total_barang IS NOT NULL AND DATE_FORMAT(tgl_penjualan,'%m %Y')='$date'" )->row();
        return $query->total;
    }

    public function penjualanTerbaru(){
        $query = $this->db->query("SELECT penjualan.* , customer.nama_lengkap FROM penjualan INNER JOIN customer ON penjualan.customer_id = customer.customer_id
            WHERE total_barang IS NOT NULL ORDER BY penjualan.tgl_penjualan DESC LIMIT 10" )->result();
        return $query;
    }

    public function stokBarangCek(){
        $query = $this->db->query("SELECT barang.*, supplier.nama_supplier FROM barang INNER JOIN supplier ON barang.id_supplier = supplier.id_supplier WHERE stock <= 6 ");
        return $query->result();
    }

    public function expedisicek(){
        $query = $this->db->query("SELECT * FROM penjualan WHERE expedisi !=0 AND expedisi IS NOT NULL");
        return $query->result();
    }    

    public function stoknya(){
        $id = $this->input->get('id');
        $stock = $this->input->post('stock');
        $kode_barang = $this->input->get('kode_barang');

        $get_kode = $this->db->query("SELECT stock FROM barang WHERE kode_barang='$kode_barang'")->row('stock');
        $sumStock = $get_kode + $stock;

        $updateBarang = array('stock' => $sumStock);
        $this->db->where('kode_barang',$kode_barang);
        $result = $this->db->update('barang',$updateBarang);
        return $result;
        
    }

    public function getstokedit(){
        $id = $this->input->get('id');
        $stock = $this->input->get('stock');
        $kode_barang = $this->input->post('kode_barang');

        $get_kode = $this->db->query("SELECT stock FROM barang WHERE kode_barang='$kode_barang'")->row('stock');
        return $get_kode;
    }

    public function profile_kasir(){
        $this->load->database();
        $us = $this->session->userdata('ses_id');
        return $this->db->query("SELECT * FROM user WHERE user_id = '$us'")->result();        
    }

    public function laporanPembelian(){
        $this->load->database();
        $query = $this->db->query('SELECT pembelian.*, pembelian_detail.kode_barang,pembelian_detail.sub_total_harga,supplier.*,barang.id_category,barang.berat,category.category_name,pembelian_detail.qty,pembelian_detail.id_pembelian,pembelian_detail.harga_barang,barang.nama_barang FROM pembelian INNER JOIN pembelian_detail ON pembelian.no_faktur_pembelian = pembelian_detail.no_faktur_pembelian INNER JOIN barang ON pembelian_detail.kode_barang = barang.kode_barang INNER JOIN supplier ON pembelian.id_supplier = supplier.id_supplier INNER JOIN category ON barang.id_category = category.id_category')->result();
        return $query;
    }

    public function InvoicePembelian($id_pembelian){
        $this->load->database();
        // $this->db->where('id_pembelian',$id_pembelian);
        $query = $this->db->query("SELECT pembelian.*, pembelian_detail.kode_barang, pembelian_detail.sub_total_harga,supplier.*,barang.id_category,barang.berat,category.category_name,pembelian_detail.qty,pembelian_detail.id_pembelian,pembelian_detail.harga_barang,barang.nama_barang FROM pembelian INNER JOIN pembelian_detail ON pembelian.no_faktur_pembelian = pembelian_detail.no_faktur_pembelian INNER JOIN barang ON pembelian_detail.kode_barang = barang.kode_barang INNER JOIN supplier ON pembelian.id_supplier = supplier.id_supplier INNER JOIN category ON barang.id_category = category.id_category WHERE id_pembelian = '$id_pembelian' ")->result();

        return $query;
    }
}