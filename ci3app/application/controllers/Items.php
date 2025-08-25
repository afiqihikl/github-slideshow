<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->require_login();
		$this->load->library('form_validation');
		$this->load->model('Item_model');
	}

	public function index()
	{
		$data['user'] = $this->current_user;
		$data['items'] = $this->Item_model->get_all_by_user($this->current_user->id);
		$this->load->view('items/index', $data);
	}

	public function create()
	{
		$this->form_validation->set_rules('title', 'Title', 'required|max_length[150]');
		$this->form_validation->set_rules('description', 'Description', 'max_length[10000]');

		if ($this->input->method() === 'post' && $this->form_validation->run()) {
			$this->Item_model->create(
				$this->current_user->id,
				$this->input->post('title'),
				$this->input->post('description')
			);
			redirect('items');
			return;
		}

		$this->load->view('items/create');
	}

	public function edit($id)
	{
		$item = $this->Item_model->get_by_id_and_user($id, $this->current_user->id);
		if (!$item) {
			show_404();
			return;
		}

		$this->form_validation->set_rules('title', 'Title', 'required|max_length[150]');
		$this->form_validation->set_rules('description', 'Description', 'max_length[10000]');

		if ($this->input->method() === 'post' && $this->form_validation->run()) {
			$this->Item_model->update_item(
				$item->id,
				$this->current_user->id,
				$this->input->post('title'),
				$this->input->post('description')
			);
			redirect('items');
			return;
		}

		$this->load->view('items/edit', array('item' => $item));
	}

	public function delete($id)
	{
		$this->Item_model->delete_item($id, $this->current_user->id);
		redirect('items');
	}
}