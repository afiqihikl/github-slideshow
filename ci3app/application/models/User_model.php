<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	private $table = 'users';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->dbforge();
		$this->ensure_table();
	}

	private function ensure_table()
	{
		if (!$this->db->table_exists($this->table)) {
			$fields = array(
				'id' => array('type' => 'INTEGER', 'auto_increment' => TRUE),
				'username' => array('type' => 'VARCHAR', 'constraint' => 100),
				'email' => array('type' => 'VARCHAR', 'constraint' => 150),
				'password_hash' => array('type' => 'VARCHAR', 'constraint' => 255),
				'created_at' => array('type' => 'DATETIME', 'null' => TRUE)
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table($this->table, TRUE);
			$this->db->query("CREATE UNIQUE INDEX IF NOT EXISTS idx_users_username ON {$this->table}(username)");
			$this->db->query("CREATE UNIQUE INDEX IF NOT EXISTS idx_users_email ON {$this->table}(email)");
		}
	}

	public function create_user($username, $email, $password)
	{
		$data = array(
			'username' => $username,
			'email' => $email,
			'password_hash' => password_hash($password, PASSWORD_BCRYPT),
			'created_at' => date('Y-m-d H:i:s')
		);
		return $this->db->insert($this->table, $data);
	}

	public function get_by_id($id)
	{
		return $this->db->get_where($this->table, array('id' => $id))->row();
	}

	public function get_by_username($username)
	{
		return $this->db->get_where($this->table, array('username' => $username))->row();
	}
}