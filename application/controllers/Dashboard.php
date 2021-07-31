<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'users' => $this->db->get('user')->result()
		];
		$this->template->load('template', 'dashboard', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
}
