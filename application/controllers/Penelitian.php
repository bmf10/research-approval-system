<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penelitian extends CI_Controller
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
			if (get_role() !== 'peneliti') {
				$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Hanya peneliti yang bisa menambahkan atau mengubah penelitian") })</script>');
				redirect('penelitian');
			}
			$data = $this->input->post();
			$insert_id = $data['id'];
			if (!isset($data['id']) || $data['id'] == '') {
				$data['id_user'] = get_session('id');
				$this->db->insert('penelitian', $data);
				$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("Penelitian Berhasil Ditambahkan") })</script>');
				$insert_id = $this->db->insert_id();
			} else {
				$this->db->update('penelitian', $data, ['id' => $data['id']]);
				$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("Penelitian Berhasil Diubah") })</script>');
			}
			redirect('penelitian/detail/' . $insert_id);
		} else {
			$peneliti = [];
			if (get_role() === 'peneliti') {
				$peneliti = $this->PenelitianModel->find_all(get_session('id'));
			} else {
				$peneliti = $this->PenelitianModel->find_all();
			}

			$data = [
				'title' => 'Penelitian',
				'penelitian' => $peneliti,
			];

			$this->template->load('template', 'penelitian/index', $data);
		}
	}

	public function detail($id)
	{
		if (!$id) {
			redirect('penelitian');
		}

		$penelitian = $this->PenelitianModel->find_one($id);

		if (!$penelitian) {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Penelitian tidak ditemukan") })</script>');
			redirect('penelitian');
		}

		if (get_role() === 'peneliti' && $penelitian->id_user !== get_session('id')) {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Anda tidak memiliki akses") })</script>');
			redirect('penelitian');
		}

		$evaluasi = $this->EvaluasiModel->find_by_penelitian($id);
		$pernyataan = $evaluasi ? $this->db->get_where('pernyataan', ['id_evaluasi' => $evaluasi->id])->result() : [];
		$penilaian = $this->PenilaianModel->find_by_penelitian($id);

		$data = [
			'title' => 'Detail Penelitian',
			'penelitian' => $penelitian,
			'tahapan' => $this->db->get_where('tahapan', ['id_penelitian' => $id])->result(),
			'evaluasi' => $evaluasi,
			'pernyataan' => $pernyataan,
			'penilaian' => $penilaian
		];

		$this->template->load('template', 'penelitian/detail', $data);
	}

	public function tahapan()
	{
		if (!$this->input->post()) {
			redirect('penelitian');
		}

		if (get_role() !== 'peneliti') {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Hanya peneliti yang bisa menambahkan atau mengubah penelitian") })</script>');
			redirect('penelitian');
		}

		$data = $this->input->post();


		$penelitian = $this->PenelitianModel->find_one($data['id_penelitian']);

		if (get_role() === 'peneliti' && $penelitian->id_user !== get_session('id')) {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.danger("Anda tidak memiliki akses") })</script>');
			redirect('penelitian');
		}

		$upload = upload_document('document_upload');
		if ($upload['fileuploaded']) {
			$data['file'] = $upload['filename'];
			$this->db->insert('tahapan', $data);
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("Tahapan Berhasil Ditambahkan") })</script>');
		} else {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Upload Document Gagal") })</script>');
		}

		redirect('penelitian/detail/' . $data['id_penelitian']);
	}

	public function delete_tahapan($id, $id_penelitian = 0)
	{
		if (!$id || !$id_penelitian) {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Ada sesuatu yang salah!") })</script>');
			redirect('penelitian');
		}

		if (get_role() !== 'peneliti') {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Hanya peneliti yang bisa menambahkan atau mengubah penelitian") })</script>');
			redirect('penelitian');
		}

		$this->db->delete('tahapan', ['id' => $id]);
		$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("Tahapan Berhasil Dihapus") })</script>');

		redirect('penelitian/detail/' . $id_penelitian);
	}

	public function get_one($id)
	{
		$data = $this->db->get_where('penelitian', ['id' => $id])->row();
		response($data);
	}

	public function delete($id)
	{

		$penelitian = $this->PenelitianModel->find_one($id);

		if (get_role() === 'peneliti' && $penelitian->id_user !== get_session('id') || get_role() === 'anggota_pme' || get_role() === 'kepala_pme') {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Anda tidak memiliki akses") })</script>');
			redirect('penelitian');
		}

		$this->db->update('penelitian', ['aktif' => false], ['id' => $id]);
		$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("Penelitian Berhasil Dihapus") })</script>');
		redirect('penelitian');
	}

	public function export_pdf($id)
	{
		$this->load->library('pdf');

		$evaluasi = $this->EvaluasiModel->find_by_penelitian($id);
		$penelitian = $this->PenelitianModel->find_one($id);

		if (!$evaluasi || !$penelitian) {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Data Tidak Ditemukan") })</script>');
			redirect('penelitian');
		}

		$pernyataan = $this->db->get_where('pernyataan', ['id_evaluasi' => $evaluasi->id])->result();

		$total_bobot = 0;
		$total_skor = 0;
		$total_nilai = 0;

		for ($i = 0; $i < count($pernyataan); $i++) {
			$total_bobot = $total_bobot + $pernyataan[$i]->bobot;
			$total_skor = $total_skor + $pernyataan[$i]->skor;
			$total_nilai = $total_nilai + $pernyataan[$i]->nilai;
		}

		$data = [
			'penelitian' => $penelitian,
			'evaluasi' => $evaluasi,
			'pernyataan' => $pernyataan,
			'total_bobot' => $total_bobot,
			'total_skor' => $total_skor,
			'total_nilai' => $total_nilai
		];

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = time() . "-Laporan Monitoring " . $penelitian->judul . ".pdf";
		$this->pdf->load_view('pdf/evaluasi', $data);
	}
}
