<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * Channel Workflow Module Control Panel File
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Module
 * @author		RBC
 * @link		http://paleosun.com
 */

class Channel_workflow_mcp {
	
	public $return_data;
	
	private $_base_url;
	
  public function __construct()
	{
		$this->EE =& get_instance();
		
		$this->_base_url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=channel_workflow';
		
    /*
		$this->EE->cp->set_right_nav(array(
			'module_home'	=> $this->_base_url,
			'configuration'	=> BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=channel_workflow'.AMP.'method=configuration',
		));
     */
	}
	
  //main index/default module page
	public function index()
	{
		$this->EE->cp->set_variable('cp_page_title', lang('channel_workflow_module_name'));
    $this->EE->load->library('table');
		
		$vars = array();
    $vars['_base_url'] = $this->_base_url;
    $vars['channel_fields_url'] = BASE.AMP.'C=admin_content'.AMP.'M=field_group_management';
		
	  //get channels like this $channel_id=>('url_name,' 'Friendly Name', 'has_status_field')  
    $channels = $this->getChannelArray();
    $vars['channels'] = $channels;

		return $this->EE->load->view('index', $vars, TRUE);

	}

  //render statuses for a given channel
  public function viewStatus() {

    //echo "channel id is ".$channel_id;

  }
  
	//returns array of channels like this $channel_id=>('url_name,' 'Friendly Name', 'has_status_field')  
  function getChannelArray() 
  {

    $return_array = array();
	
		$this->EE->db->select('*');
		$this->EE->db->from('exp_channels');
		$query = $this->EE->db->get();
		$results = $query->result_array();
		
		foreach($results as $result) {
      $return_array[$result['channel_id']] = array(
        'url_title' => $result['channel_name'],
        'channel_title' => $result['channel_title'],
      ); 
		}
    
    //does a completion status field exist for this channel
    $channel_field_map = $this->getChannelFieldMap();
		//echo "<pre>".print_r($channel_field_map,true)."</pre>";

    foreach ($return_array as $id=>$arr) {
      
      
      $field_string = $arr['url_title']."_status";
      //echo $field_string."<br>";
      if (array_key_exists($field_string, $channel_field_map)) {
        $return_array[$id]['has_status'] = true;
      }
      else {
        $return_array[$id]['has_status'] = false;
      }

    }

		//die("<pre>".print_r($return_array,true)."</pre>");
    return $return_array;
  }

	//adds completion status
  function addCompletionStatus($channel_name) 
  {
		
		//append completion status to channel_name_prefix
		
		//add dropdown field
		
	}
	
	//renders view of all channels' entries with status feedback
  function displayCompletionStatus($channel_id) 
  {
		
	}
	
	//helpers
  function getChannelsAndFields() 
  {
		
		$return_array = array();
		$channel_map = $this->getChannelMap();

    //$this->getChannelFieldMap();

		foreach($channel_map as $channel=>$id) {
      //echo $id."<br>";
		}
		
		//for each channel, get all its fields
		//die("<pre>".print_r($channel_map,true)."</pre>");
	}

	//returns array of channel_name to channel_id
  function getChannelMap() 
  {
		
		$return_array = array();
		
		$this->EE->db->select('channel_id, channel_name');
		$this->EE->db->from('exp_channels');
		$query = $this->EE->db->get();
		$results = $query->result_array();
		
		foreach($results as $result) {
			$return_array[$result['channel_name']] = $result['channel_id'];
		}

		return $return_array;
	}
	
	//returns array of field_name to field_id
  function getChannelFieldMap() 
  {
		
		$return_array = array();
		
		$this->EE->db->select('field_id, field_name');
		$this->EE->db->from('exp_channel_fields');
		$query = $this->EE->db->get();
		$results = $query->result_array();
		
		foreach($results as $result) {
			$return_array[$result['field_name']] = $result['field_id'];
		}
		//die("<pre>".print_r($return_array,true)."</pre>");
		return $return_array;
	}
	
}
/* End of file mcp.channel_workflow.php */
/* Location: /system/expressionengine/third_party/channel_workflow/mcp.channel_workflow.php */
