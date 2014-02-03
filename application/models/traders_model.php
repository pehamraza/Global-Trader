<?php
    
    class Traders_model extends CI_Model{
        protected $table_name = "traders";
        function __construct(){
            parent::__construct();
            
        }
        
        function login($uemail, $upassword){
        
        $q = $this->db->get_where($this->table_name, array('userEmail'=>$uemail,
                                         'userPassword'=>$upassword));
         if($q->num_rows()>0){
            $row = $q->row_array();
                return $row;
                }else return FALSE;
                    
    }
	
	function register($data){
			 $this->db->insert($this->table_name,$data);
			  $id = $this->db->insert_id();
			  $this->set_stats($id);
			  return $id;
				
			}
			
		function settings($data){
		$userId = $this->session->userdata('userId');
		if($userId){
			$this->db->where('userId',$userId);
			 $this->db->update($this->table_name,$data);
			  //return $this->db->insert_id();
			  return TRUE;
			}
			else return FALSE;
			}

		function get_countaries($id){
			$q = $this->db->query("select * from countaries where cid = '$id'");
			if($q->num_rows()>0){
            $row = $q->result_array();
                return $row;
                }else return FALSE;
		}

		function get_market_name($cid){
			$q = $this->db->query("select *  from countaries where countryId = '$cid'");
            return $row = $q->row_array();
            // return $row[0]['cname'];
		}

		function get_goods(){
			$q = $this->db->query("select * from goods order by goodName asc");
			if($q->num_rows()>0){
            $row = $q->result_array();
                return $row;
                }else return FALSE;
		}

		function get_statistics($id)
		{
				$q = $this->db->query("select * from trader_statistics where userId = '$id' order by statsId asc");
				
				if($q->num_rows()>0)
				{
	            	$row = $q->row_array();
	                return $row;
	            }
	            else return FALSE;
		}

		function set_stats($id){
			// $this->db->insert('trader_statistics')->into()
			$data = array('userId' => $id);

			$this->db->insert('trader_statistics', $data); 

		}
        
    }
?>