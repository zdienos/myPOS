<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("model_data");
        //validasi jika user belum login
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url() . "index.php/login");
        }
    }
	public function index()
	{
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('dashboard');
		$this->load->view('footer');
	}

	public function Data_Pembelian()
	{
		$pembelian = array(
				'detail' => $this->model_data->laporanPembelian(),
				
		);
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('data-pembelian', $pembelian);
		$this->load->view('footer');
		// $a = $this->model_data->penjualanTerbaru();
		// print_r($a);
	}

	public function faktur_detail($id_pembelian)
	{
		$a = array(	'ad' => $this->model_data->InvoicePembelian($id_pembelian),
					'site' => $this->model_data->showSetting());
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('invoice-pembelian',$a);
		$this->load->view('footer');
	}


	public function dashboard()
	{
		if ($this->session->userdata('akses') == 1) {
		$this->load->model("model_data");
		$data = array( 
			'count' => $this->model_data->countTotalPenjualan(),
			'countonDate' => $this->model_data->countTotalPenjualanDate(),
			'countpendapatan' => $this->model_data->countTotalPendapatan(),
			'countpendapatandate' => $this->model_data->countTotalPendapatanDate(),
			'cek' => $this->model_data->stokBarangCek(),
			'ex' => $this->model_data->expedisicek(),
			'penjualanTerbaru' => $this->model_data->penjualanTerbaru());
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('dashboard-admin',$data);
		$this->load->view('footer');
	}else{
		$this->load->view('404');
	}
}

	public function HPP()
	{
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('aturhpp');
		$this->load->view('footer');
	}

	public function Retail()
	{
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('aturretail');
		$this->load->view('footer');
	}

	// USER---------------------------------------------------------------------------------------------------

	public function User()
	{
		$this->load->model("model_data");
    	if ($this->input->method() == "post") {
    		helper_log('User telah ditambahkan');
			$insert = $this->model_data->add_user(array(
				'user_id' => $this->input->post("user_id"),
				'username' => $this->input->post("username"),
				'password' => $this->input->post("password"),
				'role_id' => $this->input->post("role_id"),
				'id_province' => $this->input->post("id_province"),
				'id_city' => $this->input->post("id_city"),
		));
		}
    	$data = array("user" => $this->model_data->view_user());
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('manageuser',$data);
		$this->load->view('footer');
	}
	
	public function delete_user($user_id)
	{
		$this->load->model("model_data");
		$where = array('user_id' => $user_id);
		$dihapus = $this->model_data->delete_user('user',$where);
		if ($dihapus >=1) {
			helper_log('User dengan user ID "' .$user_id. '" telah dihapus');
		    redirect(base_url()."index.php/Administrator/user");
        }else{
        	echo"gagal";
			}
	}

	public function Edit_User($user_id = 'user_id')
	{
		$this->load->model("model_data");
		$where = array('user_id' => $user_id);
		$data['user'] = $this->model_data->edit_user($where,'user')->result();
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('edit_user',$data);
		$this->load->view('footer');
	}
	function update(){
		$this->load->model("model_data");
	$user_id = $this->input->post('user_id');
	$username = $this->input->post('username');
	$password = $this->input->post('password');
	$role = $this->input->post('role_id');
	$prov = $this->input->post('id_province');
	$city = $this->input->post('id_city');

	$data = array(
		'username' => $username,
		'password' => $password,
		'role_id' => $role,
		'id_province' => $prov,
		'id_city' => $city
	);

	$where = array(
		'user_id' => $user_id
	);
	helper_log('User dengan ID "'.$user_id.'" telah diubah');
	$this->model_data->update_data($where,$data,'user');
	redirect('administrator/user');
	}

	
	function editstockBarang(){
        
    $id = $this->input->post('kode_barang');
    $a = $this->model_data->getstokedit();
    $b = $this->input->post('stock');
    $stok = $a + $b;

    $data = array(
        
        'stock' => $a + $b 
    );
    $where = array(
        'kode_barang' => $id
    );
    $this->model_data->update_data($where,$data,'barang');
    redirect('administrator/dashboard');
}

	// USER---------------------------------------------------------------------------------------------------

	// CUSTOMER-----------------------------------------------------------------------------------------------
	public function customer()
    {
        $config['upload_path']   = FCPATH.'/upload/';
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $this->load->library('upload',$config);

        $this->load->model("model_data");

        if ($this->input->method() == "post") {

            if (!$this->upload->do_upload('picture')) {
                $error = $this->upload->display_errors();
                // menampilkan pesan error
            }
            $result = $this->upload->data('file_name');
            $insert = $this->model_data->add_customer(array(
                'customer_id' => $this->input->post("customer_id"),
                'nama_lengkap' => $this->input->post("nama_lengkap"),
                'email' => $this->input->post("email"),
                'alamat' => $this->input->post("alamat"),
                'picture' => $this->upload->data('file_name'),
                'no_telp' => $this->input->post("no_telp"),
                'role_id' => $this->input->post("role_id"),
                'id_province' => $this->input->post("id_province"),
                'id_city' => $this->input->post("id_city"),
            ));
            if ($insert) {
            	helper_log('Data customer telah ditambah');
                redirect(base_url()."index.php/Administrator/customer");
                $this->session->set_flashdata('success', 'success');
            }else{
                $this->session->set_flashdata('error', 'error');
            }
        }



        $data = array("customer" => $this->model_data->view_customer());
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('customer',$data);
        $this->load->view('footer');

    }


	public function delete_customer($customer_id)
	{
		$this->load->model("model_data");
		$where = array('customer_id' => $customer_id);
		$dihapus = $this->model_data->delete_customer('customer',$where);
		if ($dihapus >=1) {
			helper_log('Data customer dengan ID "'.$customer_id.'" telah dihapus');
		    redirect(base_url()."index.php/Administrator/customer");
        }else{
        	echo"gagal";
			}
	}

	public function edit_customer($customer_id = 'customer_id')
	{
		$this->load->model("model_data");
		$where = array('customer_id' => $customer_id);
		$data['customer'] = $this->model_data->edit_customer($where,'customer')->result();
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('edit_customer',$data);
		$this->load->view('footer');
	}
	function update_customer(){
		$this->load->model("model_data");
	$customer_id = $this->input->post('customer_id');
	$nama_lengkap = $this->input->post('nama_lengkap');
	$alamat = $this->input->post('alamat');
	$no_telp = $this->input->post('no_telp');
	$email = $this->input->post('email');
	$role_id = $this->input->post('role_id');
	$prov = $this->input->post('id_province');
	$city = $this->input->post('id_city');

	$data = array(
		'nama_lengkap' => $nama_lengkap,
		'alamat' => $alamat,
		'no_telp' => $no_telp,
		'email' => $email,
		'role_id' => $role_id,
		'id_province' => $prov,
		'id_city' => $city	
	);

	$where = array(
		'customer_id' => $customer_id
	);
	helper_log('Data customer dengan ID "'.$customer_id.'" telah diubah');
	$this->model_data->update_data($where,$data,'customer');
	redirect('administrator/customer');
	}

	public function upload(){
		$config['upload_path']          = './upload/profile/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('picture')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('customer', $error);
		}else{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('customer', $data);
		}
	}

	public function profile($customer_id = 'customer_id')
	{
		$this->load->model("model_data");
		$where = array('customer_id' => $customer_id);
		$data['customer'] = $this->model_data->edit_customer($where,'customer')->result();
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('profile',$data);
		$this->load->view('footer');
	}

	// CUSTOMER-----------------------------------------------------------------------------------------------

	// SUPLIER------------------------------------------------------------------------------------------------
    public function getSupplier(){
        $result = $this->model_data->view_supp();
        echo json_encode($result);
    }
    public function supplier()
	{
		$this->load->model("model_data");
    	if ($this->input->method() == "post") {
			$insert = $this->model_data->add_supp(array(
				'id_supplier' => $this->input->post("id_supplier"),
				'nama_supplier' => $this->input->post("nama_supplier"),
				'alamat' => $this->input->post("alamat"),
				'no_telp' => $this->input->post("no_telp"),
				'email' => $this->input->post("email")
		));
			if ($insert) {
				helper_log('Data supplier telah ditambah');
				$this->session->set_flashdata('something', TRUE);
			}else{
				$this->session->set_flashdata('some', TRUE);
			}
		}
    	$data = array("supplier" => $this->model_data->view_supp());
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('supplier',$data);
		$this->load->view('footer');
	}

	public function delete_supp($id_supplier)
	{
		$this->load->model("model_data");
		$where = array('id_supplier' => $id_supplier);
		$dihapus = $this->model_data->delete_supp('supplier',$where);
		if ($dihapus >=1) {
			helper_log('Data supplier dengan ID "'.$id_supplier.'" telah dihapus');
		    redirect(base_url()."index.php/Administrator/supplier");
        }else{
        	echo"gagal";
			}
	}

	public function edit_supp($id_supplier = 'id_supplier')
	{
		$this->load->model("model_data");
		$where = array('id_supplier' => $id_supplier);
		$data['supplier'] = $this->model_data->edit_supp($where,'supplier')->result();
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('edit_supp',$data);
		$this->load->view('footer');
	}
	function update_supp(){
		$this->load->model("model_data");
	$id_supplier = $this->input->post('id_supplier');
	$nama_supplier = $this->input->post('nama_supplier');
	$alamat = $this->input->post('alamat');
	$no_telp = $this->input->post('no_telp');
	$email = $this->input->post('email');

	$data = array(
		'nama_supplier' => $nama_supplier,
		'alamat' => $alamat,
		'no_telp' => $no_telp,
		'email' => $email	
	);

	$where = array(
		'id_supplier' => $id_supplier
	);
	helper_log('Data supplier dengan ID "'.$id_supplier.'" telah diubah');
	$this->model_data->update_data($where,$data,'supplier');
	redirect('administrator/supplier');
	}
	// SUPPLIER

	public function editsupplier(){
        $id = $this->input->get('id');
        $where = array('id_supplier' => $id);
        $data = $this->model_data->edit_supp($where,'supplier')->result();
        echo json_encode($data);

    }

	public function showAllSupplier()
    {
        $result = $this->model_data->view_supp();
        echo json_encode($result);
    }

    public function error_404()
    {
        $this->load->view('header');
		$this->load->view('404');
		$this->load->view('footer');
    }

 
	public function Pembelian()
	{	
		if($this->session->userdata('akses') == 1){
		// $this->load->model("model_data");
		$data = array("supplier" => $this->model_data->pembelian(),
					  "barang" => $this->model_data->barangnya(),
					  "pembelian" => $this->model_data->data_beli(),
					   );
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('pembelian', $data);
		$this->load->view('footer');
		}else{
			redirect(base_url()."index.php/Administrator/error_404");
		}
	}
	//beli barang
	function beli(){
		$result = $this->model_data->beli();
		$msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
	}

	//delete pembelian (Edit another table)
	public function editPembelian(){
      $result = $this->model_data->editPembelian();
      echo json_encode($result);
    }

    //delete pembelian
	public function deletePembelian(){
		$result = $this->model_data->delPembelian();
		$msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
		echo json_encode($msg);
	}
	//get data pembelian
	 public function getitem(){
      $result = $this->model_data->getitem();
      echo json_encode($result);
    }
    //count sub total pembelian
    public function subtotal(){
        $result = $this->model_data->totalbelanja();
        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    //count total pembelian
	function totalItem(){
		$this->load->model("model_data");
	$num = $this->input->post('no_faktur_pembelian');
	$tgl = $this->input->post('tgl_pembelian');
	$id = $this->input->post('id_supplier');
	$item = $this->input->post('total_barang');
	$price = $this->input->post('total_belanja');

	$data = array(
		'no_faktur_pembelian' => $num,
		'tgl_pembelian' => date('Y/m/d h:i:s'),
		
		'id_supplier' => $id,
		'total_barang' => $item,
		
		'total_harga' => $price	
	);

	$where = array(
		'no_faktur_pembelian' => $num
	);


	helper_log('Pembelian telah dilakukan');
	$this->model_data->update_data($where,$data,'pembelian');
	$this->session->set_flashdata('success');
	redirect('administrator/pembelian');
	}

	public function Penjualan()
	{
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('penjualan');
		$this->load->view('footer');
	}

	public function Barang()
	{
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('data_barang');
		$this->load->view('footer');
	}

	public function Grosir()
	{
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('aturgrosir');
		$this->load->view('footer');
	}

	public function Diskon()
	{
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('aturdiskon');
		$this->load->view('footer');
	}

	public function Invoice()
	{
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('invoice');
		$this->load->view('footer');
	}

	public function Laporan()
	{
        $data['jual_bln']=$this->model_data->getBulanPenjualan();
        $data['jual_thn']=$this->model_data->getTahunPenjualan();

		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('laporanpenjualan',$data);
		$this->load->view('footer');
	}

	public function Retur()
	{
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('Retur');
		$this->load->view('footer');
	}

	public function Log()
	{
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('logaktivitas');
		$this->load->view('footer');
	}

	public function faktur($no_penjualan)
	{
        $result = $this->model_data->getInvoice($no_penjualan);
        $site = $this->model_data->showSetting();
        $data = array(
            'invoice' => $result,
            'site' => $site
        );
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('invoice-pengiriman',$data);
		$this->load->view('footer');
	}


	//Method Barang
    public function showAllBarang()
    {
        $result = $this->model_data->showAllBarang();
        echo json_encode($result);
    }

    public function addBarang()
    {
//      $nama_barang = $this->input->post('nama_barang');

        $result = $this->model_data->addBarang();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);

    }

    public function editBarang()
    {
        $result = $this->model_data->editBarang();
        echo json_encode($result);
    }

    public function updateBarang()
    {
        $result = $this->model_data->updateBarang();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function deleteBarang()
    {
        $result = $this->model_data->deleteBarang();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function cobaBarcode($code)
    {
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');

        $imageResource = Zend_Barcode::factory('code128', 'image', array('text' => $code), array())->draw();
        $imageName = $code . '.jpg';
        $imagePath = 'assets/image/barcode/'; // penyimpanan file barcode
        imagejpeg($imageResource, $imagePath . $imageName);
        $pathBarcode = $imagePath . $imageName; //Menyimpan path image bardcode kedatabase
        echo $pathBarcode;
    }

    // Method Penjualan
    public function showAllCustomer()
    {
        $result = $this->model_data->view_customer();
        echo json_encode($result);
    }

    public function editCustomer(){
        $id = $this->input->get('id');
        $where = array('customer_id' => $id);
        $data = $this->model_data->edit_customer($where,'customer')->result();
        echo json_encode($data);

    }

    public function get_autocomplete()
    {
        if (isset($_GET['term'])) {
            $result = $this->model_data->searchBarang($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->kode_barang;
                echo json_encode($arr_result);
            }
        }
    }

    public function addToCart()
    {
        $result = $this->model_data->addToCart();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function showCart()
    {
        $result = $this->model_data->showCart();
        echo json_encode($result);
    }

    public function editPenjualan()
    {
        $result = $this->model_data->editPenjualan();
        echo json_encode($result);

    }

    public function deletePenjualan()
    {
        $result = $this->model_data->deletePenjualan();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function showAllBank()
    {
        $result = $this->model_data->view_bank();
        echo json_encode($result);


    }

    public function cekOngkir(){
        $origin = $this->input->get('origin');
        $destination = $this->input->get('destination');
        $weight = $this->input->get('weight');
        $courier = $this->input->get('courier');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: c37dd6dae4903faedec310006d7dd5bb"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function cekProvinceId(){
        $id = $this->input->get('id');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: c37dd6dae4903faedec310006d7dd5bb"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo false;
        } else {
            echo $response;
        }
    }
    public function cekCityId(){
        $id = $this->input->get('id');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: c37dd6dae4903faedec310006d7dd5bb"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo false;
        } else {
            echo $response;
        }
    }

    public function cekProvince(){
    	$result = $this->model_data->getprovince();
    	// $response = json_encode($result);
    	echo $result;
    }

    public function cekCity(){
    	$result = $this->model_data->getCity();

    	// $response = json_encode($result);
    	echo $result;
    }

    public function pembayaran(){

        $result = $this->model_data->pembayaran();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }


    public function printInvoice($no_penjualan){
    	helper_log('Invoice telah tercetak');
        $result = $this->model_data->getInvoice($no_penjualan);
        $site = $this->model_data->showSetting();
        $data = array(
          'invoice' => $result,
            'site' => $site
        );
        $this->load->view('header');
		$this->load->view('navbar-top');
        $this->load->view('invoice-penjualan',$data);
        $this->load->view('footer');        //        print_r($result);

    }

    public function printInvoiceKecil($no_penjualan){
    	helper_log('Invoice telah tercetak');
        $result = $this->model_data->getInvoice($no_penjualan);
        $site = $this->model_data->showSetting();
        $data = array(
          'invoice' => $result,
            'site' => $site
        );
        $this->load->view('invoice_email',$data);
               //        print_r($result);

    }

    

    public function sendInvoice(){
        $email = $this->input->post('email');
        $no_penjualan = $this->input->post('no_penjualan');
        $result = $this->model_data->getInvoice($no_penjualan);
        $site = $this->model_data->showSetting();
        $data = array(
            'invoice' => $result,
            'site' => $site
        );
        $message = $this->load->view('invoice_email',$data,TRUE);
        $this->load->library('email');

        $this->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => '',
            'smtp_pass' => '',
            'smtp_port' => 587,
            'mailtype' => 'html'
        ));

        $this->email->from('admin@zolaqu.com', 'Admin');
        $this->email->to($email);
        $this->email->subject('Invoice');
        $this->email->message($message);
        $msg['success'] = false;
        if($this->email->send()){
        	helper_log('Invoice terkirim');
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function printLabel(){

        $pagination_limit = 10;

        $config = array();
        $config['base_url'] = base_url().'index.php/administrator/printLabel/';

        $config['display_pages'] = true;
        $config['first_link'] = 'Pertama';
        $config['last_link'] = 'Terakhir';

        $config['total_rows'] = $this->model_data->countBarang();
        $config['per_page'] = $pagination_limit;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = "<ul class='pagination pagination-right margin-none'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = '<li>';
        $config['next_tagl_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tagl_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['results'] = $this->model_data->fetchLabelBarang($config['per_page'], $page);

        $data['links'] = $this->pagination->create_links();

        if ($page == 0) {
            $have_count = $this->model_data->countBarang();
            $sh_text = 'Menampilkan 1 dari '.count($data['results']).' of '.$this->model_data->countBarang().' data';
        } else {
            $start_sh = $page + 1;
            $end_sh = $page + count($data['results']);
            $sh_text = "Menampilkan $start_sh dari $end_sh ".$this->model_data->countBarang().' data';
        }

        $data['displayshowingentries'] = $sh_text;
        $data['lang_print_label_header'] = "Setiap gambar akan di print di halaman terpisah. Mohon gunakan Printer Barcode untuk mencetak halaman ini.";
        $data['getBarang'] = $this->model_data->showAllBarang();
        $this->load->view('print_label', $data);
    }

    public function printLabelById($kode_barang){
        $result = $this->model_data->fetchLabelBaragById($kode_barang);
        $data['results'] = $result;
        $data['lang_print_label_header'] = "Setiap gambar akan di print di halaman terpisah. Mohon gunakan Printer Barcode untuk mencetak halaman ini.";
        $this->load->view('print_label_id', $data);
    }

    public function addReture(){
        $result = $this->model_data->addReture();
        helper_log('Reture telah dilakukan');
        $msg['success'] = false;
        if ($result) {        	
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function showReture(){
        $result = $this->model_data->showReture();
        echo json_encode($result);
    }

    public function editReture()
    {
        $result = $this->model_data->editReture();
        echo json_encode($result);

    }

    public function deleteReture(){
        $result = $this->model_data->deleteReture();
        helper_log('Retur telah di batalkan');
        $msg['success'] = false;
        if ($result) {        	
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function dataPembayaran(){
    $this->load->view('header');
        $this->load->view('navbar-top');
     $this->load->view('pembayaran');
        $this->load->view('footer');
    }

    public function showPembayaran(){
        $result = $this->model_data->showPembayaran();
        echo json_encode($result);
    }

    public function returBarang(){
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('returBarang');
        $this->load->view('footer');
    }

    public function showPenjualan(){
        $result = $this->model_data->showPenjualan();
        echo json_encode($result);
    }

    public function showReturPenjualan(){
        $result = $this->model_data->showReturPenjualan();
        echo json_encode($result);
    }

    public function showLog(){
        $result = $this->model_data->showLog();
        echo json_encode($result);
    }
     public function addCategory(){
        $result = $this->model_data->addCategory();
        helper_log('Kategori telah ditambah');
        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function getCategory(){
      $result = $this->model_data->getCategory();
      echo json_encode($result);
    }

     public function delcategory(){
        $result = $this->model_data->delcategory();
        helper_log('Kategori telah dihapus');
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function editcategory(){
      $result = $this->model_data->editcategory();
      echo json_encode($result);
    }

    public function category(){
		$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('category');
		$this->load->view('footer');
    }

    public function updatecategory()
    {
        $result = $this->model_data->updatecategory();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function confirmBank()
    {
        $result = $this->model_data->confirmBank();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function confirmTermin()
    {
        $result = $this->model_data->confirmTermin();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function laporanDataBarang(){
        $result = $this->model_data->laporanDataBarang();

        $x['data'] = $result;
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('laporan_data_barang',$x);
        $this->load->view('footer');
    }
    public function laporanDataBarangStok(){
        $result = $this->model_data->laporanDataBarang();

        $x['data'] = $result;
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('laporan_data_barang_stok',$x);
        $this->load->view('footer');
    }

    public function laporanDataPenjualan(){
        $result = $this->model_data->laporanDataPenjualan();
        $x['jml']=$this->model_data->getTotalPenjualan();
        $x['data'] = $result;
        $x['expedisi_total'] = $this->model_data->getTotalExpedisi();
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('laporan_data_penjualan',$x);
        $this->load->view('footer');
    }

    public function laporanDataPenjualanTanggal(){
        $tgl = $this->input->post('tgl');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $result = $this->model_data->laporanDataPenjualanTanggal($tgl,$tgl_akhir);
        $x['jml']=$this->model_data->getTotalPenjualanTanggal($tgl,$tgl_akhir);
        $x['data'] = $result;
        $x['expedisi_total'] = $this->model_data->getTotalExpedisiTanggal($tgl,$tgl_akhir);
        $x['tgl_awal'] = $tgl;
        $x['tgl_akhir'] = $tgl_akhir;
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('laporan_data_penjualan_tanggal',$x);
        $this->load->view('footer');
    }

    public function laporanDataPenjualanBulan(){
        $tgl = $this->input->post('bln');
        $result = $this->model_data->laporanDataPenjualanBulan($tgl);
        $x['jml']=$this->model_data->getTotalPenjualanBulan($tgl);
        $x['data'] = $result;
        $x['expedisi_total'] = $this->model_data->getTotalExpedisiBulan($tgl);
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('laporan_data_penjualan_bulan',$x);
        $this->load->view('footer');
    }

    public function laporanDataPenjualanTahun(){
        $tgl = $this->input->post('thn');
        $result = $this->model_data->laporanDataPenjualanTahun($tgl);
        $x['jml']=$this->model_data->getTotalPenjualanTahun($tgl);
        $x['data'] = $result;
        $x['expedisi_total'] = $this->model_data->getTotalExpedisiTahun($tgl);
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('laporan_data_penjualan_tahun',$x);
        $this->load->view('footer');
    }

    public function laporanDataReturTanggal(){
        $tgl = $this->input->post('tgl_retur');
        $tgl_akhir = $this->input->post('tgl_akhir_retur');
        $result = $this->model_data->laporanDataReturTanggal($tgl,$tgl_akhir);
        $x['jml']=$this->model_data->getTotalReturTanggal($tgl,$tgl_akhir);
        $x['data'] = $result;
//        $x['expedisi_total'] = $this->model_data->getTotalExpedisiTanggal($tgl,$tgl_akhir);
        $x['tgl_awal'] = $tgl;
        $x['tgl_akhir'] = $tgl_akhir;
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('laporan_data_retur_tanggal',$x);
        $this->load->view('footer');
    }

    public function laporanDataBankTanggal(){
        $bank = $this->input->post('bank');
        $tgl = $this->input->post('tgl_bank');
        $tgl_akhir = $this->input->post('tgl_akhir_bank');
        $result = $this->model_data->laporanDataBankTanggal($tgl,$tgl_akhir,$bank);
        $x['jml']=$this->model_data->getTotalBankTanggal($tgl,$tgl_akhir,$bank);
        $x['data'] = $result;
//        $x['expedisi_total'] = $this->model_data->getTotalExpedisiTanggal($tgl,$tgl_akhir);
        $x['tgl_awal'] = $tgl;
        $x['tgl_akhir'] = $tgl_akhir;
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('laporan_data_bank_tanggal',$x);
        $this->load->view('footer');
    }

    public function laporanDataPiutangTanggal(){
        $tgl = $this->input->post('tgl_piutang');
        $tgl_akhir = $this->input->post('tgl_akhir_piutang');
        $result = $this->model_data->laporanDataPiutangTanggal($tgl,$tgl_akhir);
        $x['jml']=$this->model_data->getTotalPiutangTanggal($tgl,$tgl_akhir);
        $x['data'] = $result;
//        $x['expedisi_total'] = $this->model_data->getTotalExpedisiTanggal($tgl,$tgl_akhir);
        $x['tgl_awal'] = $tgl;
        $x['tgl_akhir'] = $tgl_akhir;
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('laporan_data_piutang_tanggal',$x);
        $this->load->view('footer');
    }

    public function laporanDataPenjualanLaba(){
        $tgl = $this->input->post('bln');
        $result = $this->model_data->laporanDataPenjualanLaba($tgl);
        $x['jml']=$this->model_data->getTotalPenjualanLaba($tgl);
        $x['data'] = $result;
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('laporan_data_penjualan_laba',$x);
        $this->load->view('footer');
    }




     public function siteSetting(){
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('site_setting');
        $this->load->view('footer');
    }
    public function showSetting(){
        echo json_encode($this->model_data->showSetting());
    }
    public function editSetting(){
        echo json_encode($this->model_data->editSetting());
    }
    public function updateSetting(){
        $result = $this->model_data->updateSetting();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    public function listBank(){
        $this->load->view('header');
        $this->load->view('navbar-top');
        $this->load->view('listBank');
        $this->load->view('footer');
    }
    public function addBank(){
        $result = $this->model_data->addBank();
        helper_log('Bank telah ditambah');
        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function getBank(){
        $result = $this->model_data->getBank();
        echo json_encode($result);
    }

    public function delBank(){
        $result = $this->model_data->delbank();
        helper_log('Bank telah dihapus');
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function editBank(){
        $result = $this->model_data->editbank();
        echo json_encode($result);
    }
    public function updateBank()
    {
        $result = $this->model_data->updatebank();
        helper_log('Bank telah diubah');
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    public function stoknya()
    {
        $result = $this->model_data->stoknya();
        // $msg['success'] = false;
        // if ($result) {
        //     $msg['success'] = true;
        // }
        // echo json_encode($msg);

    }

    public function profil(){
    	$this->load->model('model_data');
    	$a = array( 'profil' => $this->model_data->profile_kasir() );
    	$this->load->view('header');
		$this->load->view('navbar-top');
		$this->load->view('profil',$a);
		$this->load->view('footer');
    }

    function update_profil(){
	$this->load->model("model_data");
	$user_id = $this->input->post('user_id');
	$username = $this->input->post('username');
	$password = $this->input->post('password');
	$role = $this->input->post('role_id');

	$data = array(
		'username' => $username,
		'password' => $password,
		'role_id' => $role,
	);

	$where = array(
		'user_id' => $this->session->userdata('ses_id')
	);
	helper_log('User dengan ID "'.$user_id.'" telah diubah');
	$this->model_data->update_data($where,$data,'user');
	redirect('administrator/profil');
	}

}
