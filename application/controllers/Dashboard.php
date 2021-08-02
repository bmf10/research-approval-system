<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('PenilaianModel');
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'total_user' => $this->db->count_all('user'),
			'total_penelitian' => $this->db->count_all('penelitian'),
			'total_penilaian' => $this->PenilaianModel->count_by_penelitian()->total
		];

		$this->template->load('template', 'dashboard', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
}
