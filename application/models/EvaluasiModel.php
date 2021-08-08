<?php

class EvaluasiModel extends CI_Model
{

	function find_by_penelitian($id_penelitian)
	{
		$this->db->select(['status', 'komentar', 'evaluasi.id as id', 'nama', 'evaluasi.created_at as created_at']);
		$this->db->from('evaluasi');
		$this->db->where('id_penelitian', $id_penelitian);
		$this->db->join('user', 'user.id = evaluasi.id_pengecek');
		return $this->db->get()->row();
	}

	function find_by_id($id)
	{
		$this->db->select(['status', 'komentar', 'evaluasi.id as id', 'nama', 'evaluasi.created_at as created_at', 'id_penelitian']);
		$this->db->from('evaluasi');
		$this->db->where('evaluasi.id', $id);
		$this->db->join('user', 'user.id = evaluasi.id_pengecek');
		return $this->db->get()->row();
	}

	function find_all()
	{
		$this->db->select(['judul', 'status', 'komentar', 'evaluasi.id as id', 'nama', 'evaluasi.created_at as created_at', 'id_penelitian', 'penelitian.id_user as id_peneliti']);
		$this->db->from('evaluasi');
		$this->db->join('user', 'user.id = evaluasi.id_pengecek');
		$this->db->join('penelitian', 'penelitian.id = evaluasi.id_penelitian');
		return $this->db->get()->result();
	}
}
