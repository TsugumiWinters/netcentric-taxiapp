<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function retrieve($id = FALSE)
	{
		if ($id == FALSE)
		{
			$query = $this->db->get('category');
			return $query->result_array();
		}
	}
}