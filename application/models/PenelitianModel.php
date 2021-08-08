<?php

class PenelitianModel extends CI_Model
{

	function find_all($id_user = null)
	{
		$this->db->select(['nama', 'judul', 'lokasi', 'jumlah_anggota', "jumlah_biaya", 'penelitian.id as id', 'status']);
		$this->db->from('penelitian');
		if ($id_user) {
			$this->db->where('id_user', $id_user);
		}
		$this->db->where('aktif', true);
		$this->db->join('user', 'user.id = penelitian.id_user');
		$this->db->join('evaluasi', 'evaluasi.id_penelitian = penelitian.id', 'left');
		return $this->db->get()->result();
	}

	function find_one($id)
	{
		$this->db->select(['nama', 'judul', 'lokasi', 'jumlah_anggota', "jumlah_biaya", 'objek_penelitian', 'masa_pelaksanaan', 'target_temuan', 'abstrak', 'tanggal_pelaksanaan', 'penelitian.id as id', 'user.id as id_user', 'anggota']);
		$this->db->from('penelitian');
		$this->db->where('penelitian.id', $id);
		$this->db->where('aktif', true);
		$this->db->join('user', 'user.id = penelitian.id_user');
		return $this->db->get()->row();
	}
}
