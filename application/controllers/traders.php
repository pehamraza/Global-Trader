<?php 

/*----
This is the authentication controller, 
used to verify login, logout, check login status
----*/

class Traders extends CI_Controller {

    protected $userid = "userId";
    protected $username = "userName";
    protected $useremail = "userEmail";
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
     function __construct(){
     	parent::__construct();
     	$this->output->enable_profiler(TRUE);
     }
	public function index($message=FALSE)
	{
      
	}
    
    
   



   function packages(){
                $data['user_id'] = $this->session->userdata($this->userid);
				$data['user_name'] = $this->session->userdata($this->username);
                $data['main']="traders/packages";
				$data['sidebar']="traders/blocks/sidebar1";
                $this->load->view('traders/template_with_sidebar',$data);
	   }
	function mydocuments(){
		$data['user_id'] = $this->session->userdata($this->userid);
		$data['user_name'] = $this->session->userdata($this->username);
                $data['main']="traders/my_documents";
				$data['sidebar']="traders/blocks/sidebar1";
                $this->load->view('traders/template_with_sidebar',$data);
		}
	function downloads(){
		$data['user_id'] = $this->session->userdata($this->userid);
		$data['user_name'] = $this->session->userdata($this->username);
                $data['main']="traders/downloads";
				$data['sidebar']="traders/blocks/sidebar1";
                $this->load->view('traders/template_with_sidebar',$data);
				}
	function payments(){
			$data['user_id'] = $this->session->userdata($this->userid);
			$data['user_name'] = $this->session->userdata($this->username);
                $data['main']="traders/payments";
				$data['sidebar']="traders/blocks/sidebar1";
                $this->load->view('traders/template_with_sidebar',$data);
		}

	function settings(){
		
		if(!$this->input->post('signup'))
			{
				
                $data['name']=$this->session->userdata('userName');
				$data['email']=$this->session->userdata('userEmail');
                $this->load->view('traders/settings',$data);
			}
			
			elseif($this->input->post('signup')){
			
			if($this->input->post('name') && $this->input->post('email') 
			&& $this->input->post('password')
			 && $this->input->post('cpassword'))
        	{
				if($this->input->post('password') == $this->input->post('cpassword')){
					
					$this->session->set_userdata('userName',$this->input->post('name'));
				$this->load->model('user_model');
				$values = array(
					'userName' =>$this->input->post("name"),
					'userEmail'=>$this->input->post("email"),
					'userPassword'=>$this->input->post("password")
				);
				$id = $this->user_model->settings($values);
				if($id){
						$data['message'] = "<div class='alert-success'>User Account Updated!</div>";
						$this->load->view('traders/settings_message', $data);
					}
				}
				else {
						$data['message'] = "<div class='alert-error'>Password and Confirm Password Doesn't Match!</div>";
						$this->load->view('traders/settings_message', $data);
					}
			}
			else{
					$data['message'] = "<div class='alert-error'>No Information Entered!</div>";
						$this->load->view('traders/settings_message', $data);
				}
			}
		}
		
		function Edit(){
			$userId = $this->input->post('userId');
			$userFName = $this->input->post('userFName');
			$userLName = $this->input->post('userLName');
			$userSex = $this->input->post('userSex');
			$userDob = $this->input->post('userDob');
			$userEmail = $this->input->post('userEmail');
			$userPassword = $this->input->post('userPassword');
			$userPhone = $this->input->post('userPhone');
			$userAddress = $this->input->post('userAddress');
			$userCity = $this->input->post('userCity');
			$userCountry = $this->input->post('userCountry');
			$userRegDate = $this->input->post('userRegDate');
			$userIp = $this->input->post('userIp');
			$userType = $this->input->post('userType');
			$userStatus = $this->input->post('userStatus');
			$userPackageId = $this->input->post('userPackageId');
			$userFranchiseId = $this->input->post('userFranchiseId');


            $insert_array = array(
            userFName => $userFName, 
			userLName => $userLName, 
			userSex => $userSex, 
			userDob => $userDob, 
			userEmail => $userEmail, 
			userPassword => $userPassword, 
			userPhone => $userPhone, 
			userAddress => $userAddress, 
			userCity => $userCity, 
			userCountry => $userCountry, 
			userRegDate => $userRegDate, 
			userIp => $userIp, 
			userType => $userType, 
			userStatus => $userStatus, 
			userPackageId => $userPackageId, 
			userFranchiseId => $userFranchiseId, 
			);
            if($this->admin_users_model->Update($userId, $insert_array))
            	echo "Success"; else echo "Failure";
            
		}
    
		 function projects_show($start=0){
			$this->load->model('admin_projects_model');
			$id = $this->session->userdata('userId');
           $data['projects'] = $this->admin_projects_model->ShowPro($id);
				$json_obj = json_encode($data);
			echo $json_obj;
            
        }

        function show_project_detail($id){
        	$this->load->model('admin_projects_model');
           $data['projects'] = $this->admin_projects_model->Show_Project($id);
				$json_obj = json_encode($data);
			echo $json_obj;
        }

        function project_notes($id){
        	$this->load->model('admin_notes_model');
           $data['notes'] = $this->admin_notes_model->show_notes_from($id);
				$json_obj = json_encode($data);
			echo $json_obj;}


		function project_images($id){
        	$this->load->model('admin_projects_model');
           $data['project_images'] = $this->admin_projects_model->show_images_from($id);
				$json_obj = json_encode($data);
			echo $json_obj;}


		function project_files($id){
        	$this->load->model('admin_files_model');
           $data['project_files'] = $this->admin_files_model->show_files_from($id);
				$json_obj = json_encode($data);
			echo $json_obj;}






		function note_comments($noteid)
		{
			$this->session->set_userdata('noteId',$noteid);
			$this->load->model('admin_notes_model');
			$var['notes'] = 	$this->admin_notes_model->show_note_details($noteid);
			$var['note_comments'] = $this->admin_notes_model->note_comments($noteid);
			echo json_encode($var);
		}	

		function comment_post()
		{
			$n = $this->session->userdata('noteId');
			$u = $this->session->userdata('userId');
			$by = '1';
			$c = $this->input->post('comment');

			$this->load->model('admin_notes_model');
			if($this->admin_notes_model->comment_post($c,$by,$u,$n))
			{
				$var['note_comments'] = $this->admin_notes_model->note_comments($n);
/*				$this->load->library('email');
				$this->email->from($this->session->userdata('userEmail'), $this->session->userdata('userFName')." ".$this->session->userdata('userLName'));
				$this->email->to();
				$this->email->subject('Comment Notification - Abdullah Khan Architects');
				$message = "You have got a comment on the note you added. <br />Comment added on note: ".$this->session->userdata('noteTitle')."<br />Comment Added on: ".$var['note_comments']['commentDate']."<br />Comment At: ".$var['note_comments']['commentTime']."<br />Please login to your account and check the comment.";
				$this->email->message($message);
				if($this->email->send())
				{
					$var['status'] = "Email Sent";
				}
*/
				echo json_encode($var);
			}
		}

		function load_my_tickets($id){
        	$this->load->model('admin_notes_model');
           $data['tickets'] = $this->admin_notes_model->load_my_tickets($id);
				$json_obj = json_encode($data);
			echo $json_obj;}


		function ticket_post()
		{
			$tt = $this->input->post('ttitle');
			$td = $this->input->post('tdesc');
			$tp = $this->input->post('tpriority');
			$u = $this->session->userdata('userId');

			$this->load->model('admin_notes_model');
			if($this->admin_notes_model->ticket_post($tt,$td,$tp,$u))
			{
				$var['tickets'] = $this->admin_notes_model->load_my_tickets($u);
/*				$this->load->library('email');
				$this->email->from($this->session->userdata('userEmail'), $this->session->userdata('userFName')." ".$this->session->userdata('userLName'));
				$this->email->to();
				$this->email->subject('Comment Notification - Abdullah Khan Architects');
				$message = "You have got a comment on the note you added. <br />Comment added on note: ".$this->session->userdata('noteTitle')."<br />Comment Added on: ".$var['note_comments']['commentDate']."<br />Comment At: ".$var['note_comments']['commentTime']."<br />Please login to your account and check the comment.";
				$this->email->message($message);
				if($this->email->send())
				{
					$var['status'] = "Email Sent";
				}
*/
				echo json_encode($var);
			}
		}


		
}


