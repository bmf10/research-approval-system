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

	function count_by_penelitian()
	{
		$this->db->select('count(distinct id_penelitian) as total');
		$this->db->from('penilaian');
		return $this->db->get()->row();
	}

	function find_all()
	{
		$this->db->select(['sum(bobot) as total_bobot', 'sum(nilai) as total_nilai', 'sum(skor) as total_skor', 'penilaian.created_at as created_at', 'nama', 'judul', 'penelitian.id as id']);
		$this->db->from('penilaian');
		$this->db->join('user', 'user.id = penilaian.id_penilai');
		$this->db->join('penelitian', 'penelitian.id = penilaian.id_penelitian');
		$this->db->group_by('id_penelitian');
		return $this->db->get()->result();
	}
}
