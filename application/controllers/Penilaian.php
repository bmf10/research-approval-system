<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('PenelitianModel');
		$this->load->model('EvaluasiModel');
		$this->load->model('PenilaianModel');
	}

	public function index()
	{
		if ($this->input->post()) {


			if (get_role() !== 'anggota_pme') {
				$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Anda tidak memiliki akses") })</script>');
				redirect('penelitian/detail/' . $this->input->post('id_penelitian'));
			}

			$penilaian = $this->input->post();
			$id_penilai = get_session('id');
			$penilaian_mapped = [];
			$penilaian_length = count($penilaian['pernyataan']);

			for ($i = 0; $i < $penilaian_length; $i++) {
				$penilaian_mapped[$i] = [
					'pernyataan' => $penilaian['pernyataan'][$i],
					'bobot' => $penilaian['bobot'][$i],
					'skor' => $penilaian['skor'][$i],
					'nilai' => $penilaian['nilai'][$i],
					'id_penelitian' => $penilaian['id_penelitian'],
					'id_penilai' => $id_penilai
				];
			}

			$this->db->insert_batch('penilaian', $penilaian_mapped);
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("Penilaian berhasil diubah") })</script>');
			redirect('penelitian/detail/' . $this->input->post('id_penelitian'));
		} else {

			$data = [
				'title' => 'Penilaian',
				'penilaian' => $this->PenilaianModel->find_all(),
			];

			$this->template->load('template', 'penilaian/index', $data);
		}
	}

	public function get_by_penelitian($id)
	{
		$data = $this->db->get_where('penilaian', ['id_penelitian' => $id])->result();
		response($data);
	}

	public function get_one($id)
	{
		$data = $this->db->get_where('penilaian', ['id' => $id])->row();
		response($data);
	}

	public function edit()
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

		$this->db->update('penilaian', $data, ['id' => $data['id']]);
		$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("Penilaian berhasil diubah") })</script>');
		redirect('penelitian/detail/' . $this->input->post('id_penelitian'));
	}

	public function detail($id)
	{
		$penelitian = $this->PenelitianModel->find_one($id);
		$penilaian = $this->PenilaianModel->find_by_penelitian($id);

		$data = [
			'title' => 'Penilaian',
			'penilaian' => $penilaian,
			'penelitian' => $penelitian,
		];

		$this->template->load('template', 'penilaian/detail', $data);
	}
}
