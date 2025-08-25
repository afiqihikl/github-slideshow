<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {
	private $table = 'items';

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
				'user_id' => array('type' => 'INTEGER'),
				'title' => array('type' => 'VARCHAR', 'constraint' => 150),
				'description' => array('type' => 'TEXT', 'null' => TRUE),
				'created_at' => array('type' => 'DATETIME', 'null' => TRUE),
				'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table($this->table, TRUE);
			$this->db->query("CREATE INDEX IF NOT EXISTS idx_items_user_id ON {$this->table}(user_id)");
		}
	}

	public function get_all_by_user($userId)
	{
		return $this->db->order_by('created_at', 'DESC')
			->get_where($this->table, array('user_id' => $userId))
			->result();
	}

	public function get_by_id_and_user($id, $userId)
	{
		return $this->db->get_where($this->table, array('id' => $id, 'user_id' => $userId))->row();
	}

	public function create($userId, $title, $description)
	{
		$data = array(
			'user_id' => $userId,
			'title' => $title,
			'description' => $description,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		);
		return $this->db->insert($this->table, $data);
	}

	public function update_item($id, $userId, $title, $description)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $userId);
		return $this->db->update($this->table, array(
			'title' => $title,
			'description' => $description,
			'updated_at' => date('Y-m-d H:i:s')
		));
	}

	public function delete_item($id, $userId)
	{
		return $this->db->delete($this->table, array('id' => $id, 'user_id' => $userId));
	}
}