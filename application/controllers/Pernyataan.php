<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pernyataan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('PenelitianModel');
		$this->load->model('EvaluasiModel');
	}

	public function index()
	{
		if (!$this->input->post()) {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Metode Salah") })</script>');
			redirect('penelitian/detail/' . $this->input->post('id_penelitian'));
		}

		if (get_role() !== 'anggota_pme') {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Anda tidak memiliki akses") })</script>');
			redirect('penelitian/detail/' . $this->input->post('id_penelitian'));
		}

		$data = $this->input->post();
		unset($data['id_penelitian']);

		$this->db->update('pernyataan', $data, ['id' => $data['id']]);
		$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("Pernyataan berhasil diubah") })</script>');
		redirect('penelitian/detail/' . $this->input->post('id_penelitian'));
	}

	public function get_one($id)
	{
		$data = $this->db->get_where('pernyataan', ['id' => $id])->row();
		response($data);
	}

	public function get_by_evaluasi($id)
	{
		$data = $this->db->get_where('pernyataan', ['id_evaluasi' => $id])->result();
		response($data);
	}
}
