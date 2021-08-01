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
}
