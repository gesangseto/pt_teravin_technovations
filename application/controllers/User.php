<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function index()
	{
		$this->load->model('_Dashboard');
		$check_user = $this->_Dashboard->_check_user();
		if ($check_user['statusCode'] != 00) {
			$data['status'] = array(
				'statusCode' => '01',
				'message' => "There's Currently No Data Exists,<br> Please Create by Clicking ADD Button Bellow"
			);
		} else {
			$data['all_user'] = $this->_Dashboard->_get_all_user();
		}

		if (isset($_GET['keyword'])) {
			$keyword = $_GET['keyword'];
			$data['all_user'] = $this->_Dashboard->_search_user($keyword);
		}
		$this->load->view('User/Index', $data);
	}
	public function create()
	{
		$this->load->model('_Dashboard');
		$date = date("Y M D, H:i:s");
		$id = strtotime($date);
		if (isset($_POST["address"]) && is_array($_POST["address"])) {
			$fullname = $_POST['fullname'];
			$phone_number = $_POST['phone_number'];
			$email = $_POST['email'];
			$data['user'] = array(
				'id' => $id,
				'fullname' => $fullname,
				'phone_number' => $phone_number,
				'email' => $email,
			);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$data['status'] = array(
					'statusCode' => '01',
					'message' => "Format Email Tidak Valid"
				);
				$this->load->view('User/Create', $data);
			} else {
				$check_duplicate = $this->_Dashboard->_check_duplicate_user($data);
				if ($check_duplicate['statusCode'] != 0) {
					$data['status'] = $check_duplicate;
					$this->load->view('User/Create', $data);
				} else {
					$this->db->insert('user', $data['user']);
					foreach ($_POST['address'] as $row) {
						$data['address'] = array(
							'user_id' => $id,
							'address' => $row
						);
						$this->db->insert('user_address', $data['address']);
					}
					$data['all_user'] = $this->_Dashboard->_get_all_user();
					$data['status'] = array(
						'statusCode' => '00',
						'message' => "Sukses Tambah User"
					);
					echo '<script type="text/javascript"> alert("Success Add User"); window.location.href = "' . site_url("User/Index") . '"; </script>';
				}
			}
		} else {
			$this->load->view('User/Create');
		}
	}
	public function read()
	{
		$id = $this->input->get('id', TRUE);
		$data['user'] = $this->db->get_where('user', array('id' => $id))->result_array();
		$data['user_address'] = $this->db->get_where('user_address', array('user_id' => $id))->result_array();
		var_dump($data['user_address']);
		// die;
		$this->load->view('User/Read', $data);
	}
	public function update()
	{
		$this->load->model('_Dashboard');
		if ($_POST) {
			$id = $_POST['id'];
			$fullname = $_POST['fullname'];
			$phone_number = $_POST['phone_number'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$data['user'] = array(
				'id' => $id,
				'fullname' => $fullname,
				'phone_number' => $phone_number,
				'email' => $email,
			);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$data['status'] = array(
					'statusCode' => '01',
					'message' => "Format Email Tidak Valid"
				);
				$this->load->view('User/Update', $data);
			} else {
				$check_duplicate = $this->_Dashboard->_check_duplicate_update_user($data);
				if ($check_duplicate['statusCode'] != 00) {
					$data['status'] = $check_duplicate;
					$this->load->view('User/Update', $data);
				} else {
					$this->db->where('id', $id);
					$this->db->update('user', $data['user']);
					$data['all_user'] = $this->_Dashboard->_get_all_user();
					$data['status'] = array(
						'statusCode' => '00',
						'message' => "Sukses Ubah User"
					);
					echo '<script type="text/javascript"> alert("Success Ubah User"); window.location.href = "' . site_url("User/Index") . '"; </script>';
				}
			}
		} else {
			$id = $this->input->get('id', TRUE);
			$data['user'] = $this->db->get_where('user', array('id' => $id))->result_array();
			$data['user_address'] = $this->db->get_where('user_address', array('user_id' => $id))->result_array();
			$this->load->view('User/Update', $data);
		}
	}
	public function delete()
	{
		$this->load->model('_Dashboard');
		if (isset($_GET['id'])) {
			$id = $this->input->get('id', TRUE);
			$this->db->delete('user', array('id' => $id));
			echo '<script type="text/javascript"> alert("Success Delete"); window.location.href = "' . site_url("User/Index") . '"; </script>';
		} else {
			echo '<script type="text/javascript"> alert("Hey How are you doing?"); window.location.href = "' . site_url("User/Index") . '"; </script>';
		}
	}
	function get_user()
	{
		$this->load->model('_Ajax_Dashboard');
		$BaseData = array(
			'table' => 'user',
			'column_order' => array(null, 'fullname', 'email', 'phone_number'),
			'column_search' => array('fullname', 'email', 'phone_number'),
			'order' => array('id' => 'asc')
		);
		$list = $this->_Ajax_Dashboard->get_datatables($BaseData);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->fullname;
			$row[] = $field->email;
			$row[] = $field->phone_number;
			// $row[] = $field->address;
			$row[] = '<button onclick="hapus(' . $field->id . ')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
            <a href="' . site_url('User/Update') . '?id=' . $field->id . '" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="' . site_url('User/Read') . '?id=' . $field->id . '" class="btn btn-success"><i class="glyphicon glyphicon-search"></i></a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->_Ajax_Dashboard->count_all($BaseData),
			"recordsFiltered" => $this->_Ajax_Dashboard->count_filtered($BaseData),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
}
