<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $current_user;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('User_model');

		$userId = $this->session->userdata('user_id');
		$this->current_user = null;
		if ($userId) {
			$this->current_user = $this->User_model->get_by_id($userId);
		}
	}

	protected function require_login()
	{
		if (!$this->current_user) {
			$this->session->set_flashdata('error', 'Please login first.');
			redirect('login');
			exit;
		}
	}
}