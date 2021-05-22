<?php
class Employee_model extends CI_Model
{
    public $tableName = 'employee';

    public function create($data)
    {
        $q = $this->db->insert($this->tableName, $data);
        if ($q) {
            return TRUE;
        }
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $q = $this->db->update($this->tableName, $data);
        if ($q) {
            return TRUE;
        }
    }

    public function fetchAll()
    {
        $q = $this->db->select()
            ->from($this->tableName)
            ->get();

        return $q->result();
    }

    public function fetchById($id)
    {
        $q = $this->db->select()
            ->from($this->tableName)
            ->where('id', $id)
            ->get();

        return $q->row();
    }
}
