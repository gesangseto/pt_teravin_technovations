<?php
defined('BASEPATH') or exit('No direct script access allowed');

class _Dashboard extends CI_Model
{
    public function _check_user()
    {

        $execute = $this->db->get('user');
        if ($execute->num_rows() == 0) {
            $data = array(
                'statusCode' => '01',
                'message' => "There's Currently No Data Exists"
            );
        } else {
            $data = array(
                'statusCode' => '00',
                'message' => 'Data Found'
            );
        }
        return $data;
    }
    public function _get_all_user()
    {
        $execute = $this->db->get('user');
        return ($execute->result_array());
    }
    public function _get_user_address($id)
    {
        $execute = $this->db->get_where('user_address', array('user_id' => $id));
        return ($execute->result_array());
    }
    public function _search_user($keyword)
    {
        $this->db->like('fullname', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('phone_number', $keyword);
        $query = $this->db->get('user');
        return $query->result_array();
    }
    public function _check_duplicate_user($data)
    {
        $execute = $this->db->get_where('user', array('phone_number' => $data['user']['phone_number']));
        if ($execute->num_rows() > 0) {
            $data = array(
                'statusCode' => '01',
                'message' => "No.Hp Sudah Terpakai, Silahkan Gunakan No.Hp Lain"
            );
        } else {
            $execute = $this->db->get_where('user', array('email' => $data['user']['email']));
            if ($execute->num_rows() > 0) {
                $data = array(
                    'statusCode' => '01',
                    'message' => "Email Sudah Terpakai, Silahkan Gunakan Email Lain"
                );
            } else {
                $data = array(
                    'statusCode' => '00',
                    'message' => 'Ready to Insert'
                );
            }
        }
        return $data;
    }
    public function _check_duplicate_update_user($data)
    {
        $execute = $this->db->get_where('user', array('phone_number' => $data['user']['phone_number']));
        if ($execute->num_rows() > 1) {
            $data = array(
                'statusCode' => '01',
                'message' => "No.Hp Sudah Terpakai, Silahkan Gunakan No.Hp Lain"
            );
        } else {
            $execute = $this->db->get_where('user', array('email' => $data['user']['email']));
            if ($execute->num_rows() > 1) {
                $data = array(
                    'statusCode' => '01',
                    'message' => "Email Sudah Terpakai, Silahkan Gunakan Email Lain"
                );
            } else {
                $data = array(
                    'statusCode' => '00',
                    'message' => 'Ready to Insert'
                );
            }
        }
        return $data;
    }
}
