<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Console extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		// $this->load->model('traders_model','tmodel');
		$this->output->enable_profiler(TRUE);
		$this->load->model('traders_model','tmodel');
		
	}

	public function index(){
		// $this->output->enable_profiler(TRUE);
		// if(!$this->session->userdata('userid'))
		// {
		// 	$this->load->view('main');
		// }
		// else redirect('console/dashboard/');


        if(!$this->check_login())
        {
        	$this->load->view('main');
        }
        else{
                // $this->load->view('console/dashboard');
        		// $this->dashboard();
        	redirect('console/dashboard', 'referesh');
            }        
	}

	function check_login()
	{
		if($this->session->userdata('userId')) return TRUE;
		else return FALSE;
	}


	 function login(){
        // session_start();
        if(!$this->check_login())
        {
	        if($this->input->post('email') && $this->input->post('password'))
	        {
	            $uemail = $this->input->post('email');
	            $upassword = $this->input->post('password');
	            // $this->load->model('traders_model','auth');
	            $row = $this->tmodel->login($uemail, $upassword);
	            if($row)
	            {
	                $this->session->set_userdata($row);
	               $this->index();

	            }
	            else{ 
	            	$data['message']="Invalid Credentials! <br /> <small>Please try again</small>"; 
	            	$this->load->view('console/message',$data);}
	        }
	        else if($this->input->post('login'))
	         {
	         	$data['message'] = "Please enter credentials";
	         	$this->load->view('console/message', $data);
	         }
	         else $this->login_page();

        }
         else $this->dashboard();
    }
    
    function logout(){
         $this->session->sess_destroy();
         // $message = "You have been successfully Logged Out!";
         $this->index();
        
    }      
	
	function signup(){
		$userId = $this->session->userdata('userId');
		$userEmail = $this->session->userdata('userEmail');
		if($userId && $userEmail)redirect('console/dashboard','referesh');

		if(!$this->input->post('signup'))
			{
                // $data['main']="traders/signup";
                $this->load->view('console/signup');
			}
			
			elseif($this->input->post('signup')) {
			
			if($this->input->post('name') && $this->input->post('email') 
			&& $this->input->post('password')
			 && $this->input->post('cpassword'))
        	{
				if($this->input->post('password') == $this->input->post('cpassword')){
					
					// $this->load->model('traders_model');
					$values = array(
						'userName' =>$this->input->post("name"),
						'userEmail'=>$this->input->post("email"),
						'userPassword'=>$this->input->post("password")
					);

				$id = $this->tmodel->register($values);
				if(is_numeric($id)){
						$data['message'] = "<div class='alert-success'>User Account Successfully Created!</div>";
						$this->load->view('console/message', $data);
					}
					else {
						$data['message'] = "<div class='alert-error'>System Error!<br /> <small>Registration unsuccessful! </small> </div>";
						$this->load->view('console/message', $data);
					}
				}
				else {
						$data['message'] = "<div class='alert-error'>Password and Confirm Password Doesn't Match!</div>";
						$this->load->view('console/message', $data);
					}
			}
			else{
					$data['message'] = "<div class='alert-error'>No Information Entered!</div>";
						$this->load->view('console/message', $data);
				}
			}
		}
    


	function dashboard($data = NULL)
	{
		session_start();
		// $this->index();

		$stats = $this->get_statistics();
		// print_r($stats);
		// echo $stats;
		$this->session->set_userdata($stats);
		$data['stats'] = $stats;
		if($this->check_login()) $this->load->view('console/dashboard', $data);
		else $this->login_page();
	}

	function continent($cid=NULL)
	{
		// session_start();
		// $this->login();
		if($cid == 1) $cname = "South America";
		if($cid == 2) $cname = "North America";
		if($cid == 3) $cname = "Europe";
		if($cid == 4) $cname = "Australia";
		if($cid == 5) $cname = "Asia";
		if($cid == 6) $cname = "Africa";

		// $this->load->model('traders_model','tmodel');
		$row = $this->tmodel->get_countaries($cid);
		$data['countaries'] = $row;
		$data['cname'] = $cname;
		// $this->load->view('console/dashboard', $data);
		$this->dashboard($data);

	}

	function goods($countryId=NULL)
	{

		// $this->load->model('traders_model','tmodel');
		$row = $this->tmodel->get_goods();
		$coname = $this->tmodel->get_market_name($countryId);

		$data['coname'] = $coname['countryName'];
		$data['countryId'] = $countryId;
		$cid = $coname['cId'];;
		$data['cId'] = $cid;

		if($cid == 1) $cname = "South America";
		if($cid == 2) $cname = "North America";
		if($cid == 3) $cname = "Europe";
		if($cid == 4) $cname = "Australia";
		if($cid == 5) $cname = "Asia";
		if($cid == 6) $cname = "Africa";
		$data['continentName'] = $cname;

		$data['countries'] = $this->tmodel->get_countaries($cid);
		// $row = &$row;
		// for($a=0; $a<count($row); $a++)
		// {
		// 	echo $row[$a]['goodPrice']+$this->effect_prices();
		// }

		// foreach ($row as $r){
		// 	$gp = $r['goodPrice'];
		// 	 $gp = $gp+$this->effect_prices();
		// }

		

		$data['goods'] = &$row;
		// $this->load->view('console/dashboard', $data);
		$this->dashboard($data);

	}
	

	// public function signup(){
	// 	$this->load->view('console/signup');
	// }

	// public function login(){
	// 	$check = $this->session->userdata('userId');
	// 	if(!$check)
	// 	 $this->load->view('console/login');
	// 	 else redirect('console/dashboard/');
	// }	

	public function login_page()
	{
		$this->load->view('console/login');
	}

	public function effect_prices($good_id=NULL)
	{
		// $arr = array(1,2,3,4,5,6,7,8,9, 10);
		$rand = rand(1,10);
		while($rand==0){$rand = $this->get_random();}

		$r = rand(10,srand(time()));
		if($r==1)
		{
			$price_increment = $rand*$r;
		}
		else $price_increment = $rand*$r;

		return floor($price_increment);
	}

	// load game stats
	function get_statistics(){

		$userId = $this->session->userdata('userId');
		return $this->tmodel->get_statistics($userId);	

	}



	// load game details
	public function get_continents(){}
	public function get_contries($continents){}
	// public function get_cities($contry){}
	public function show_goods($city){}

	// purchase
	public function check_balance($cont){}
	public function buy_good($good_id, $amount){}
	public function show_bought_goods($cont){}

	// sale
	public function sale_goods($good_id, $amount){}
	public function add_money($amount, $user_id){}
	public function show_balance($cont){}
	public function sale_status(){} // good sale/ bad sale
	
	// Loan functions 
	public function outstanding_load($user_id){}
	public function borrow_money($cont){
		$this->add_money($amount, $user_id);
	}
	public function total_money_can_borrow($cont){}
	public function return_load($amount){}

	// stock fucntions
	public function show_account_stock(){}
	

	public function update_session($goodId=NULL, $quantity=NULL, $type=NULL)
	{
		session_start();
		// $this->session->unset_userdata('goods_owned');

		$post = $this->input->post('post'); // checking if the values are posted or not
		if(isset($post))
			{
				// echo "goodId: ";
				 $goodId = $this->input->post('goodId');
				// echo "quantity: ";
				 $quantity = $this->input->post('quantity');
				// echo "type: ";
				 $type = $this->input->post('type'); // 0/1 => 0 is + and 1 is -
			}

		/// got vars till now /// asuming we have go all the vars

		$new = array('goodId'=>$goodId, 'quantity'=>$quantity); //make an array of new goods

		$goods_in_session = $this->session->userdata('goods_owned');
		if($goods_in_session!=FALSE) // if we have the session
		{
			$prev_gowned = $this->session->userdata('goods_owned'); // getting session array
			echo "array from session: ";print_r($prev_gowned);
			// now foreach index of array we have to check whether the good is in session or not 

			$c = count($prev_gowned); 

			for($a=0; $a<$c; $a++) /// traversing each index of array
			{if(!array_key_exists($a, $prev_gowned))$a++;
				echo "<br />inside loop: times:".$a."<br />";
				// echo "<br /> checking if $prev_gowned\[".$a."]['goodId']".$prev_gowned[$a]['goodId']."==".$goodId."<br />";


				if($prev_gowned[$a]['goodId']==$goodId) //---FINE// if we have that item in session
				{
					echo "found it<br />";
					
					$p_gowned['goods_owned'][$a]['goodId'] = $goodId;
					$p_gowned['goods_owned'][$a]['quantity'] = $quantity;
					echo "array ready to update: "; print_r($p_gowned);
					$this->session->set_userdata($p_gowned);
					// if($type == 0) /// 0 is plus
					// {
					// 	$prev_gowned[$c]['quantity'] = (int)$prev_gowned[$c]['quantity'] + (int)$quantity;
					// }
					// else $prev_gowned[$c]['quantity'] = (int)$prev_gowned[$c]['quantity'] - (int)$quantity;
				}
				else {$not_found = 1; //not found flag
					echo "item not in session<br />";}
			}
			
			if(isset($not_found))
			{
				$new_values[$c]['goodId'] = $new['goodId'];
				$new_values[$c]['quantity'] = $new['quantity'];

				// $new_values = array($new_values);
				echo "New Values:"; print_r($new_values);

				$previous_values = $prev_gowned;
				echo "Previous Values:"; print_r($previous_values);


				// $arr = array_push($previous_values, $new_values);
				$arr = $previous_values + $new_values;
				$ar['goods_owned'] = $arr;

				$newish = $ar;
				echo "Final array to update: ";
				 print_r($newish);

				$this->session->set_userdata($newish);	
			}
		}
		else{ // if no goods in session //---FINE

			// we got the goods put it in session
			$new_values['goods_owned'][0] = $new;
			print_r($new_values);
			$this->session->set_userdata($new_values);
			}

		}

		public function test()
		{
			$a = Array ( Array ( 'goodId' => 1, 'quantity' => 1 ) ,
						 Array ( 'goodId' => 2, 'quantity' => 1 ) 
					   ) ;
			echo $a[0]['goodId'];
			echo "<br />";
			echo $a[1]['quantity'];

		}


		public function test2()
		{
			$a = $this->session->userdata('goods_owned');
			echo $a[0]['goodId'];
			echo "<br />";
			echo $a[1]['goodId'];

		}
		

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */