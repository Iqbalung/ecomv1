<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Delivery extends CI_controller{
		
		function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('pagination');
		}

		function getCity($province){		

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$province",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "key: 5f0b2b7dc71dd2bab399fbc0c11eeb43"
			  ),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  //echo $response;
			$data = json_decode($response, true);
		  //echo json_encode($k['rajaongkir']['results']);
		  for ($j=0; $j < count($data['rajaongkir']['results']); $j++){
		    echo "<option value='".$data['rajaongkir']['results'][$j]['city_id']."'>".$data['rajaongkir']['results'][$j]['city_name']."</option>";
		  
		  }
		}
	}
	function carabeli(){
		$this->load->view('index/header');
		$this->load->view('index/cara_beli');
		$this->load->view('index/footer');
	}
	function refund(){
		$this->load->view('index/header');
		$this->load->view('index/cara_beli');
		$this->load->view('index/footer');
	}
	function kirim_pertanyaan(){
		$this->load->view('index/header');
		$this->load->view('index/kirim_pertanyaan');
		$this->load->view('index/footer');
	}

	function profil(){
		$this->load->view('index/header');
		$this->load->view('index/profil');
		$this->load->view('index/footer');
	}
	function blog()
	{
		$data = array(
						'menu'=> 'blog',
						'blog'=> $this->m_model_admin->select_all_blog()
					);
		$this->load->view('index/header');
		$this->load->view('blog/blog',$data);
		$this->load->view('index/footer');
	}
	function blog_detail($id){
											
				$data['blog'] = $this->m_model_admin->select_a_blog_slug($id);
				$this->load->view('index/header');
				$this->load->view('blog/blog_detail', $data);
				$this->load->view('index/footer');
										
					
		}

	function getCost()
	{
		$origin = $this->input->get('origin');
		$destination = $this->input->get('destination');
		$berat = $this->input->get('berat');
		$courier = $this->input->get('courier');

		$data = array('origin' => $origin,
						'destination' => $destination, 
						'berat' => $berat, 
						'courier' => $courier 

		);
		
		$this->load->view('rajaongkir/getCost', $data);
	}

		public function index(){
			$this->load->database();
    		$this->db->query('DELETE FROM invoices WHERE SERVICE =""');
			$data['products'] = $this->model_products->last();
			$data['kategori'] = $this->m_showkat->select_all_kategori();
			$config = array();
			$config["base_url"] = base_url() . "index.php/index/index/";
			
			$config["total_rows"] = $this->db->count_all('v_feature');
			$config["per_page"] = 6;
			$config['use_page_numbers'] = TRUE;
			// $choice = $config["total_rows"] / $config["per_page"];
   //      	$config["num_links"] = floor($choice);
	        
	        $config['cur_tag_open'] = '<li class="active"><a href="#">';
	       
			$config["uri_segment"] = 3;
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['products_f'] = $this->model_products->feature($config["per_page"],  $data['page']);
			$data['pagination'] = $this->pagination->create_links();
			$top['top'] = $this->model_products->top();
			$data['blog'] = $this->m_model_admin->select_all_blog();
			$this->load->view("index/header");
			$this->load->view("shop/search",$data);
			$this->load->view('index/menu_select',$data);
			//$this->load->view("shop/search");
			$this->load->view("index/terbaru",$data);
			$this->load->view("index/featured-produk",$data);
			// View data according to array.
			
		
			//$this->load->view("index/populer-thumb",$top);
			//$this->load->view("index/best",$top);
			//$this->load->view("index/blog",$data);
			$this->load->view("index/footer");
		}
		
		public function delivery(){
			
			$this->template->display("/inc/checkout/delivery");

			
			
		}

		public function add_to_cart()
		{
			$this->load->helper(array('form'));
			
         /* Load form validation library */ 
         	$this->load->library('form_validation');
			$this->form_validation->set_rules('qty2','qty2','required');
			$this->form_validation->set_rules('quantity','Quantity','required|matches[qty2]');
			$pro_id = $this->input->post('id');
			$qty = $this->input->post('qty');
			$qty2 = $this->input->post('qty2');
			$slug = $this->input->post('slug');
			$kat = $this->input->post('kat');
			$size = $this->input->post('size');
			//label qty 2
			if(($qty)<($qty2)){
				$this->session->set_flashdata('info','notsaved');
				header('Location: '.base_url().'index.php/produk_detail/index/'.$kat.'/'.$slug.'');
				//echo '<a href="'. base_url().'index.php/produk_detail/index/'.$kat.'/'.$slug.'">kembali ke produk</a>';
			}elseif(  ($qty2==$qty) || ($qty>=$qty2) ){
				$product = $this->model_products->find($pro_id);
				$data = array(
				 		array(
								'id'      => $product->pro_id,
								'qty'     => $qty,
								'price'   => $product->pro_price,
								'name'    => $product->pro_name,
								'title'	  => $product->pro_title,
								'image'	  => $product->pro_image,
								'weight'  => $product->pro_weight*$qty,
								'kategori'  => $product->pro_kategori,
								'size' => $size
						)
				);
				
				$this->cart->insert($data);	
				 
				 		redirect('index/cart');
			
						
			}
		}
			public function add_fast()
		{
			$this->load->helper(array('form'));

			$pro_id = $this->input->post('id');
			$qty = $this->input->post('quantity');
			$product = $this->model_products->find($pro_id);
			$data = array(
							'id'      => $product->pro_id,
							'qty'     => $qty,
							'price'   => $product->pro_price_wholesale,
							'name'    => $product->pro_name,
							'title'	  => $product->pro_title,
							'image'	  => $product->pro_image,
							'kategori'  => $product->pro_kategori,
							'weight'  => $product->pro_weight
							);
			
			$this->cart->insert($data);	
			 
			 		redirect('index/fast_order');
			
					
			
		}
		public function increase(){

		$rowid =  $this->input->post('id');


		  foreach ($this->cart->contents() as $items) {
			  if($rowid==$items['rowid']){
			   		$qty=$items['qty'];
			   }
		  }

		$in = $this->input->post('in');


		if($in=='+'){
			
			$data = array(
        'rowid'   => $rowid,
        'qty'     => $items['qty']+1,
		);

		}elseif($in=='-'){
			$data = array(
        'rowid'   => $rowid,
        'qty'     => $items['qty']-1,
        );
		}elseif($in=='Reload'){
			$data = array(
        'rowid'   => $rowid,
        'qty'     => $items['qty'],
        );

		}

		

			$this->cart->update($data);
			redirect('index/cart');
		}
		public function increase_fast(){

			$rowid =  $this->input->POST('id');


			  foreach ($this->cart->contents() as $items) {
				  if($rowid==$items['rowid']){
				   		$qty=$items['qty'];
				   }
			  }

			$in = $this->input->post('in');
			if($in=='+'){
				$data = array(
	        'rowid'   => $rowid,
	        'qty'     => $items['qty']+1,
			);

			}elseif($in=='-'){
				$data = array(
	        'rowid'   => $rowid,
	        'qty'     => $items['qty']-1,
	        );

		}

			$this->cart->update($data);
			redirect('index/cart');
		}

		public function delcart(){

			$rowid =  $this->input->POST('id');

	        $data = array(
			'rowid'   => $rowid,
			'qty'     => 0,
			);

			$this->cart->update($data); 
			redirect('index/cart');

    	}
		 
		public function delcart_fast(){

		$rowid =  $this->input->POST('id');

        $data = array(
		'rowid'   => $rowid,
		'qty'     => 0,
		);

		$this->cart->update($data); 
			redirect('index/cart');

    	}
		 
		
	
	
		
		public function cart()
		{
			if ($user=$this->session->userdata('group')=='2'){
				redirect(base_url('index.php/index/cart_fast'));

			 }
			

			$data['get_sitename'] = $this->model_settings->sitename_settings();
			$data['get_footer'] = $this->model_settings->footer_settings();	
			$this->load->view("index/header");
			
			$this->load->view('show_cart',$data);	
			
		}
		public function cart_fast()
		{

			$data['get_sitename'] = $this->model_settings->sitename_settings();
			$data['get_footer'] = $this->model_settings->footer_settings();	
			$this->load->view("index/header");
			$data['diskon'] = $this->model_orders->diskon_volume();
			$this->load->view('show_cart_fast',$data);	
			
		}///view inside cart
		public function checkout()
		{
			

			if(!$this->session->userdata('username'))

		{
			redirect('login');
		}
			$data['shipping'] = $this->input->post('shipping');
			
			// $this->session->set_userdata($data);
			$this->load->view("index/header");
			$this->load->view("checkout",$data);
		
			
		}//view inside cart
		public function get_user_id_by_session()
		{ 
		$usr_name = $this->session->userdata('username');
		$gry = $this->db->where('usr_name',$usr_name)
						->select('usr_id')
						->limit(1)
						->get('users');
				if($gry->num_rows() > 0 )
					{
							return $gry->row()->usr_id;
					}else{
						
							return 0;
						 }	
		}
		public function final_checkout()
		{
			if(!$this->session->userdata('username'))
			{
				redirect('login');
			}
			if ( ! isset($_POST['shipping']))
			{
            	$something = FALSE;
        	}
       		else
       		{
	            $something = $_POST['shipping'];
	            list($biaya, $service, $kota, $kurir) = explode(":", $something);
	            $tujuan = $this->session->userdata('alamat') .''. $kota;
	        }
			
			

			
			
			$this->load->view("index/header");
			
			if ( ! isset($_POST['alamat_lain']))
          	{
            	$tot = $this->cart->total()+$biaya;
				$idinvoice = date('YmdHis');
				$invoice = array(
						'id'		=> $idinvoice,
						'data'		=>	date('Y-m-d H:i:s'),
						'due_date'	=>	date('Y-m-d H:i:s',mktime(date('H'),date('i'),date('s'),date('m'),date('d') + 1,date('Y'))),
						'user_id'	=> $this->get_user_id_by_session(),
						'status'	=>	'1',
						'service'	=> $service,
						'total_harga'=> $tot,
						'biaya_kirim' => $biaya,
						'lengkap'	=> $tujuan
						);
			$this->db->insert('invoices',$invoice);
			//here for put ordered items in orders table
			foreach ($this->cart->contents() as $item)
			{
				$data2 = array(
							'invoice_id'		=> $idinvoice,
							'product_id'		=> $item['id'],
							'product_type'		=> $item['name']." Ukuran ".$item['size'],
							'product_title'		=> $item['title']." Ukuran ".$item['size'],
							'qty'				=> $item['qty'],
							'price'				=> $item['price'],
							 );
				$this->db->insert('orders',$data2);

			}

			foreach ($this->cart->contents() as $item1)
			{
				$data = array(
							'invoice_id'		=> $idinvoice,
							'product_id'		=> $item['id'],
							'product_type'		=> $item['name']." Ukuran ".$item['size'],
							'product_title'		=> $item['title']." Ukuran ".$item['size'],
							'qty'				=> $item['qty'],
							'price'				=> $item['price'],
							''
							
							 );
				
			}
            	$this->load->view("final_checkout",$data);
            	$this->cart->destroy();

          	}else{
          		$data['invoice'] = date('YmdHis');
          		$this->load->view("final_checkout");
          	}
          	
			
			

		}//view inside cart
	
	
		public function clear_cart()
		{
			$this->cart->destroy();
			redirect(base_url());
		}
		public function test()
		{
			$this->load->view('test');
		}
		public function fast_order()
		{
			if($this->session->userdata('group')!="2"){

				redirect(base_url());
			}
				$data['diskon'] = $this->model_orders->diskon_volume();
				$this->load->view("index/header");
				$this->load->view("shop/search_fast");
				$this->load->view("show_cart_fast",$data);
		}
	
		public function report($pro_id)
		{
			$product = $this->model_products->find($pro_id);
			
			if($this->session->userdata('group')	!=	('2' ||'3'))
			{
				$group_usr = Gost;
				$name_usr = Gost;	
			}else{
					$group_usr = $this->session->userdata('group');
					$name_usr = $this->session->userdata('username');
				}
			
			
			
			$report_products = array
			(
				'rep_id_product'			=> $product->pro_id,
				'rep_name'					=> $product->pro_name,
				'rep_title_product'			=> $product->pro_title,
				'rep_usr_name'				=> $name_usr,
				'rep_usr_group'				=> $group_usr
			);
			$this->model_products->report($report_products);
			redirect(base_url());
			
		}
	public function contact_us(){
			// ,
			$long = "-6.139710";
			$latt = "106.867920";
			$config['center'] = $long.",".$latt;
			$config['zoom'] = 'auto';
			$this->googlemaps->initialize($config);
			$this->googlemaps->initialize();
			
			$marker = array();
			$marker['position'] = $long.",".$latt;
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();

			$this->load->view("index/header",$data);
			$this->load->view('index/contact-us',$data);
			// $this->load->view('index/contact-us');
			$this->load->view("index/footer");
		}

		function about_us(){
			$this->load->view("index/header");
			$this->load->view('index/about-us');
			$this->load->view("index/footer");	
		}
			
		
		
		
	}

?>