<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->input->post()) {
			$data = $this->input->post();
			if (!isset($data['password']) || $data['password'] == '') {
				unset($data['password']);
			} else {
				$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			}

			if (!isset($data['id']) || $data['id'] == '') {
				$this->db->insert('user', $data);
				$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("User Berhasil Ditambahkan") })</script>');
			} else {
				$this->db->update('user', $data, ["id" => $data['id']]);
				$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("User Berhasil Diubah") })</script>');
			}
			redirect('user');
		} else {
			$data = [
				'title' => 'Daftar User',
				'users' => $this->db->get('user')->result()
			];
			$this->template->load('template', 'user', $data);
		}
	}

	public function get_one($id)
	{
		$data = $this->db->get_where('user', ['id' => $id])->row();
		response($data);
	}

	public function delete($id)
	{
		$penelitian_check = $this->db->get_where('penelitian', ['id_user' => $id])->num_rows();
		$evaluasi_check = $this->db->get_where('evaluasi', ['id_pengecek' => $id])->num_rows();

		if ($penelitian_check == 0 && $evaluasi_check == 0) {
			$this->db->delete('user', ['id' => $id]);
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.success("User Berhasil Dihapus") })</script>');
		} else {
			$this->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("User Tidak Dapat Dihapus") })</script>');
		}

		redirect('user');
	}
}
