<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluasi extends CI_Controller
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
		if ($this->input->post()) {
			if (get_role() !== 'anggota_pme') {
				$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Anda tidak memiliki akses") })</script>');
				redirect('penelitian/detail/' . $this->input->post('id_penelitian'));
			}


			$pernyataan = $this->input->post();
			unset($pernyataan['status']);
			unset($pernyataan['komentar']);
			unset($pernyataan['id_penelitian']);

			$evaluasi = $this->input->post();
			unset($evaluasi['pernyataan']);
			unset($evaluasi['bobot']);
			unset($evaluasi['skor']);
			unset($evaluasi['nilai']);
			$evaluasi['id_pengecek'] = get_session('id');

			$this->db->insert('evaluasi', $evaluasi);
			$id_evaluasi = $this->db->insert_id();


			$pernyataan_mapped = [];
			$pernyataan_length = count($pernyataan['pernyataan']);

			for ($i = 0; $i < $pernyataan_length; $i++) {
				$pernyataan_mapped[$i] = [
					'pernyataan' => $pernyataan['pernyataan'][$i],
					'bobot' => $pernyataan['bobot'][$i],
					'skor' => $pernyataan['skor'][$i],
					'nilai' => $pernyataan['nilai'][$i],
					'id_evaluasi' => $id_evaluasi
				];
			}

			$this->db->insert_batch('pernyataan', $pernyataan_mapped);

			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("Evaluasi berhasil ditambahkan") })</script>');
			redirect('penelitian/detail/' . $this->input->post('id_penelitian'));
		} else {
			$evaluasi = $this->EvaluasiModel->find_all();

			if (get_role() === 'peneliti') {
				$evaluasi = array_filter($evaluasi, function ($var) {
					return  $var->id_peneliti === get_session('id');
				});
			}

			$data = [
				'title' => 'Evaluasi',
				'evaluasi' => $evaluasi,
			];

			$this->template->load('template', 'evaluasi/index', $data);
		}
	}

	public function get_one($id)
	{
		$data = $this->db->get_where('evaluasi', ['id' => $id])->row();
		response($data);
	}

	public function edit()
	{
		if (get_role() !== 'anggota_pme') {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Anda tidak memiliki akses") })</script>');
			redirect('penelitian/detail/' . $this->input->post('id_penelitian'));
		}

		$data = $this->input->post();
		$this->db->update('evaluasi', $data, ['id' => $data['id']]);
		$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("Evaluasi berhasil diedit") })</script>');
		redirect('penelitian/detail/' . $this->input->post('id_penelitian'));
	}

	public function detail($id)
	{
		$evaluasi = $this->EvaluasiModel->find_by_id($id);

		if (!$evaluasi) {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Data tidak ditemukan") })</script>');
			redirect('evaluasi');
		}

		$penelitian = $this->PenelitianModel->find_one($evaluasi->id_penelitian);
		$pernyataan = $this->db->get_where('pernyataan', ['id_evaluasi' => $evaluasi->id])->result();

		$data = [
			'title' => 'Evaluasi',
			'evaluasi' => $evaluasi,
			'penelitian' => $penelitian,
			'pernyataan' => $pernyataan
		];

		$this->template->load('template', 'evaluasi/detail', $data);
	}

	public function hasil()
	{
		$evaluasi = $this->EvaluasiModel->find_all();

		if (get_role() === 'peneliti') {
			$evaluasi = array_filter($evaluasi, function ($var) {
				return $var->id_peneliti === get_session('id');
			});
		}

		$data = [
			'title' => 'Hasil Evaluasi',
			'evaluasi' => $evaluasi,
		];

		$this->template->load('template', 'evaluasi/hasil', $data);
	}
}
