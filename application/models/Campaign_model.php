<?php
class Campaign_model extends CI_Model{
  function __construct() {
    parent::__construct();
    $this->load->library('session');
  }


  function insertCompaign($array) {
    $this->db->insert('vi_campaigns', $array);
    return $this->db->insert_id();
  }

  function list_all() {
    $userid = $this->session->userdata('id');
     // return $this->db->get('vi_campaigns')->result();
    $this->db->select('*');
    $this->db->from('vi_campaigns');
    $this->db->where('vi_campaigns.uid', $userid);
    $this->db->order_by("vi_campaigns.cid", "desc");
    $rs = $this->db->get();
    
    $counter = 0;
    $resultArray = array();
    foreach($rs->result() as $array)
    {
        $resultArray[$counter]  = $array;
        $this->db->select('count(hit) as hit');
        $this->db->from('tracking_campaign');
        $this->db->where('campaign_id', $array->cid);
        $this->db->group_by("campaign_id", $array->cid);
        $rs1 = $this->db->get();
        $rsResult =  json_decode(json_encode($rs1->result()), true) ;

        if(!empty($rsResult))
        {
          $resultArray[$counter]->hit = $rsResult[0]['hit'];  
        }
        else
        {
          $resultArray[$counter]->hit  = 0;
        }  
        

        $counter++;

    }

    return $resultArray;

  }

  function delete_campaign($cid) {
    $this->db->delete('vi_campaigns', array('cid' => $cid)); 
  }

  function edit_campaign($cid) {
    return $this->db->get_where('vi_campaigns', array('cid' => $cid))->result();
  }

  function updateCampaign($array,$cid) {
    $this->db->where('cid', $cid);
    return $this->db->update('vi_campaigns', $array); 
  }


  function insertTracking($array) {
    $this->db->insert('tracking_campaign', $array);
    return $this->db->insert_id();
  }
  
  
  function getSettings()
  {
	$this->db->select('*');
    $this->db->from('settings');  
	$rs = $this->db->get();
	return $rs->result();
  }
  
  function updateSettings($array,$settingID) {
    $this->db->where('id', $settingID);
    return $this->db->update('settings', $array); 
  }
  
}
?>