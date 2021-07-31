<?php

function is_login()
{
	$CI = get_instance();
	$is_login = $CI->session->userdata('is_login');
	if (!$is_login) {
		$CI->session->set_userdata('current_url', current_url());
		$CI->session->set_flashdata('msg', '<script>$(document).ready(function() { toastr.error("Mohon Login Untuk Melanjutkan") })</script>');
		redirect('login');
	}
}

function get_role()
{
	is_login();

	$CI = get_instance();
	$role = $CI->session->userdata('role');
	return $role;
}

function get_session($name)
{
	$CI = get_instance();
	return $CI->session->userdata($name);
}

function date_readable($date, $is_datetime = false)
{
	if ($is_datetime) {
		$phpdate = strtotime($date);
		$newDate = date('d/m/Y H:i:s', $phpdate);
	} else {
		$phpdate = strtotime($date);
		$newDate = date('d/m/Y', $phpdate);
	}

	return $newDate;
}

function response($data, $status = 200)
{
	header("Content-Type: application/json; charset=UTF-8");

	echo json_encode($data);
}

function date_input($date)
{
	$date = date_create($date);
	return date_format($date, "Y-m-d");
}


function rupiah($value)
{
	return 'Rp ' . number_format($value, 2, ",", ".");
}


function upload_document($name, $upload_by = 'user')
{
	if (!file_exists($_FILES[$name]['tmp_name'])) {
		header('HTTP/1.0 400 Bad error');
		echo "Please insert the file";
		die;
	}

	$files = $_FILES[$name]['name'];
	$ext = pathinfo($files, PATHINFO_EXTENSION);
	if ($ext != "pdf" && $ext != "doc" && $ext != "docx") {
		header('HTTP/1.0 400 Bad error');
		echo "Sorry, only PDF, DOC, & DOCX files are allowed.";
		die;
	}

	$path = './upload/';
	if (isset($_FILES[$name]['name'])) {
		$file_uploaded = false;
		$filename = '';
		$tmpFilePath = $_FILES[$name]['tmp_name'];
		if (!empty($tmpFilePath) && $tmpFilePath != '') {
			_maybe_create_upload_path($path);
			$filename =  $upload_by . '-' . time() . '-' . $_FILES[$name]['name'];
			$newFilePath = $path . $filename;
			if (move_uploaded_file($tmpFilePath,  $newFilePath)) {
				$file_uploaded = true;
			}
		}
	}

	$return = [
		'fileuploaded' => $file_uploaded,
		'filename' => $filename
	];

	return $return;
}

function _maybe_create_upload_path($path)
{
	if (!file_exists($path)) {
		mkdir($path, 0755);
		fopen(rtrim($path, '/') . '/' . 'index.html', 'w');
	}
}
