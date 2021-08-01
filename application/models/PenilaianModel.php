<?php

class PenilaianModel extends CI_Model
{

	function find_by_penelitian($id_penelitian)
	{
		$this->db->select(['nama', 'pernyataan', 'bobot', 'skor', "nilai", 'penilaian.created_at as created_at', 'penilaian.id as id']);
		$this->db->from('penilaian');
		$this->db->where('id_penelitian', $id_penelitian);
		$this->db->join('user', 'user.id = penilaian.id_penilai');
		return $this->db->get()->result();
	}
}
