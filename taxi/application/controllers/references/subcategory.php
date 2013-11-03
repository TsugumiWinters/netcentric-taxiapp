<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subcategory extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('references/subcategory_model');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['subcategories'] = $this->subcategory_model->retrieve();
		$data['title'] = 'Subcategories';

		$this->load->view('templates/header', $data);
		$this->load->view('references/subcategory/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('references/category_model');
		$this->load->model('references/level_model');

		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('subcategory', 'Subcategory', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$data = array(
				'idCategory' => $this->input->post('category'),
				'idLevel' => $this->input->post('level'),
				'subcategory' => $this->input->post('subcategory')
			);

			$this->subcategory_model->create($data);
			$this->index();
		}
		else
		{
			$data['categories'] = $this->category_model->retrieve();

			if (empty($data['categories']))
			{
				echo anchor('category/create', 'Please create a category');
				return;
			}

			$data['levels'] = $this->level_model->retrieve();

			if (empty($data['levels']))
			{
				echo anchor('level/create', 'Please create a level');
				return;
			}
			
			$data['title'] = 'Add a New Subcategory';

			$this->load->view('templates/header', $data);
			$this->load->view('references/subcategory/create', $data);
			$this->load->view('templates/footer');
		}
	}

	public function update($id)
	{

	}
}

/* End of file subcategory.php */
/* Location: ./application/controllers/references/subcategory.php */