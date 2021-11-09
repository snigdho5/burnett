<?php

class CommonModel extends CI_Model
{
    function __construct()
    {
        parent:: __construct();
    }

    public function checkExists($table,$field,$value)
    {
        $sql ="select * from $table where $field=?";
        return $this->db->query($sql,array($value))->num_rows();
    }

    public function getData($table,$field='',$value='')
    {
        if($field!='' && $value!=''){
            $query = $this->db->select('*')->from($table)->where($field, $value)->get();
        }else {
            $query = $this->db->select('*')->from($table)->get();
        }
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }

        return false;
    }

    public function getAllData($table)
    {

        $query = $this->db->select('*')->from($table)->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }


    public function saveData($table,$data){
        $this->db->insert($table,$data);
        if ($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }
        return false;

    }

    public function updateData($table,$field,$field_value,$data){
        $this->db->where($field,$field_value)->update($table,$data);
        if ($this->db->affected_rows() == 1){
            return true;
        }
        return false;

    }

    function send_email($type,$subject,$email,$data)
    {
        $this->load->library('email');
        $this->email->from($this->config->item('webmaster_email'), $this->config->item('website_name'));
        $this->email->reply_to($this->config->item('webmaster_email'), $this->config->item('website_name'));
        $this->email->to($email);
        $this->email->subject(sprintf($subject, $this->config->item('website_name')));
        $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
        //$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
        $this->email->send();
    }


}