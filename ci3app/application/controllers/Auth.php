<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('User_model');
	}

	public function register()
	{
		if ($this->current_user) {
			redirect('items');
			return;
		}

		$this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[150]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

		if ($this->input->method() === 'post' && $this->form_validation->run()) {
			$username = trim($this->input->post('username'));
			$email = trim($this->input->post('email'));
			$password = $this->input->post('password');

			if ($this->User_model->get_by_username($username)) {
				$this->session->set_flashdata('error', 'Username already taken.');
				redirect('register');
				return;
			}

			if ($this->User_model->create_user($username, $email, $password)) {
				$this->session->set_flashdata('success', 'Registration successful. Please login.');
				redirect('login');
				return;
			} else {
				$this->session->set_flashdata('error', 'Registration failed. Try again.');
			}
		}

		$this->load->view('auth/register');
	}

	public function login()
	{
		if ($this->current_user) {
			redirect('items');
			return;
		}

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->input->method() === 'post' && $this->form_validation->run()) {
			$username = trim($this->input->post('username'));
			$password = $this->input->post('password');

			$user = $this->User_model->get_by_username($username);
			if ($user && password_verify($password, $user->password_hash)) {
				$this->session->set_userdata('user_id', $user->id);
				redirect('items');
				return;
			} else {
				$this->session->set_flashdata('error', 'Invalid credentials.');
			}
		}

		$this->load->view('auth/login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}