<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('My_model');
        $this->load->helper('My_helper');
    }

    private function load_view($view, $data = [])
    {
        $this->load->view('admin/navbar');
        $this->load->view($view, $data);
        $this->load->view('admin/footer');
    }
    private function setToastMessage($message, $color)
    {
        $_SESSION['toast_message'] = $message;
        $_SESSION['toast_color'] = $color;
    }

    public function index()
    {
        $this->authenticate_admin();
        $data['total_booking']=$this->db->query("SELECT COUNT(booking_tbl_id) as total_booking FROM booking_tbl WHERE status='active'")->result_array()[0]['total_booking'];
        $data['totalPrice']=$this->db->query("SELECT SUM(totalPrice) as totalPrice FROM booking_tbl WHERE status='active'")->result_array()[0]['totalPrice'];
        $data['total_buses']=$this->db->query("SELECT COUNT(buses_tbl_id) as total_buses FROM buses_tbl WHERE status='active'")->result_array()[0]['total_buses'];
        $data['total_customer']=$this->db->query("SELECT COUNT(customer_tbl_id) as total_customer FROM customer_tbl WHERE status='active'")->result_array()[0]['total_customer'];
        $this->load_view('admin/index',$data);
    }

    public function check_login()
    {
        $admin_data = $this->My_model->select_where("admin_tbl", ['admin_mobile' => $_POST['admin_mobile'], 'admin_password' => $_POST['admin_password']]);
        if (isset($admin_data[0])) {
            $_SESSION['admin_tbl_id'] = $admin_data[0]['admin_tbl_id'];
            $this->setToastMessage('Login successful... ', 'Success');
            redirect('admin/index', 'refresh');
        } else {
            $this->setToastMessage('Fail to login... ', 'Danger');
            redirect('admin/login', 'refresh');
        }
    }
    public function log_out()
    {
        session_destroy();
        redirect('admin/login', "refresh");
    }

    public function authenticate_admin()
    {
        if (!isset($_SESSION['admin_tbl_id'])) {
            redirect("admin/login", 'refresh');
        }
    }

    public function login()
    {
        $this->load_view('admin/login');
    }

    public function buses()
    {
        $data['buses'] = $this->My_model->select_where("buses_tbl", ['status' => 'active']);
        $this->load_view('admin/buses', $data);
    }

    public function save_bus()
    {
        $_POST['entry_by'] = $_SESSION['admin_tbl_id'];
        $buses_tbl_id = $this->My_model->insert('buses_tbl', $_POST);
        if ($buses_tbl_id) {
            $this->setToastMessage('Bus Added Successfully... ', 'Success');
            redirect("admin/buses");
        } else {
            $this->setToastMessage('Fail To Add Bus... ', 'Danger');
            redirect("admin/buses");
        }
    }

    public function edit_bus($buses_tbl_id)
    {
        $data['buses'] = $this->My_model->select_where("buses_tbl", ['status' => 'active']);
        $data['det'] = $this->My_model->select_where("buses_tbl", ['buses_tbl_id' => $buses_tbl_id]);
        $this->load_view('admin/buses', $data);
    }

    public function save_edited_bus()
    {
        $buses_tbl_id = $this->My_model->update('buses_tbl', ['buses_tbl_id' => $_POST['buses_tbl_id']], $_POST);
        if ($buses_tbl_id) {
            $this->setToastMessage('Bus Updated Successfully... ', 'Success');
            redirect("admin/buses");
        } else {
            $this->setToastMessage('Fail To Update Bus... ', 'Danger');
            redirect("admin/buses");
        }
    }

    public function delete_bus($buses_tbl_id)
    {
        $buses_tbl_id = $this->My_model->update('buses_tbl', ['buses_tbl_id' => $buses_tbl_id], ['status' => 'deleted']);
        if ($buses_tbl_id) {
            $this->setToastMessage('Bus Deleted Successfully... ', 'Success');
            redirect("admin/buses");
        } else {
            $this->setToastMessage('Fail To Delete Bus... ', 'Danger');
            redirect("admin/buses");
        }
    }
 
    public function roads()
    {
        $data['buses']=$this->My_model->select_where("buses_tbl",['status'=>'active']);
        if(isset($_GET['buses_tbl_id'])){
            $data['bus_det']=$this->My_model->select_where("buses_tbl",['status'=>'active','buses_tbl_id'=>$_GET['buses_tbl_id']]);
            $data['routs']=$this->My_model->select_where("city_tbl",['status'=>'active','buses_tbl_id'=>$_GET['buses_tbl_id']]);
        }
        $this->load_view('admin/roads',$data);
    }

    public function save_routs() {
        $this->My_model->update('city_tbl',['city_tbl_id'=>$_POST['city_tbl_id']],['status'=>'deleted']);
        $last_row=$this->db->query("SELECT city_tbl_id FROM city_tbl ORDER BY city_tbl_id DESC LIMIT 1")->result_array()[0]['city_tbl_id'];
        $last_id=$last_row + 1;
        foreach($_POST['city_name'] as $key=>$value){
            $city_tbl_data['buses_tbl_id']=$_POST['city_tbl_id'];
            $city_tbl_data['city_name']=$value;
            $city_tbl_data['status']='active';
            $city_tbl_data['entry_time']=time();
            $city_tbl_data['entry_by']=$_SESSION['admin_tbl_id'];
            $city_tbl_data['prev_city']=$last_id;
            $city_tbl_data['distance_form_parent']=$_POST['distance_form_parent'][$key];
            $city_tbl_data['amount_to_reach_single']=$_POST['amount_to_reach_single'][$key];
            $city_tbl_data['amount_to_reach_double']=$_POST['amount_to_reach_double'][$key];
            $last_id=$this->My_model->insert("city_tbl",$city_tbl_data);
        }
        $this->setToastMessage('Route Added Successfully... ', 'Success');
        redirect("admin/roads");
    }
 
    public function booking()
    {
        $data['buses']=$this->My_model->select_where("buses_tbl",['status'=>"active"]);
        if(isset($_GET['buses_tbl_id'])){
            if($_GET['buses_tbl_id']=='all'){
                $data['bookings']=$this->My_model->select_where("booking_tbl",['status'=>'active']);
                $data['bus_det']="All Buses";
            }else{
                $data['bus_det']=$this->My_model->select_where("buses_tbl",['status'=>'active','buses_tbl_id'=>$_GET['buses_tbl_id']])[0]['bus_name'];
                $data['bookings']=$this->My_model->select_where("booking_tbl",['status'=>'active','buses_tbl_id'=>$_GET['buses_tbl_id']]);
            }
        }
        $this->load_view('admin/booking',$data);
    }

    public function customers() {
        $data['customers']=$this->db->get("customer_tbl")->result_array();
        $this->load_view('admin/customers',$data);
    }

    public function block_customer($customer_tbl_id) {
        $this->My_model->update('customer_tbl',['customer_tbl_id'=>$customer_tbl_id],['status'=>'blocked']);
        $this->setToastMessage('Customer Blocked Successfully... ', 'Success');
        redirect("admin/customers");
    }

    public function activate_customer($customer_tbl_id) {
        $this->My_model->update('customer_tbl',['customer_tbl_id'=>$customer_tbl_id],['status'=>'active']);
        $this->setToastMessage('Customer Activated Successfully... ', 'Success');
        redirect("admin/customers");
    }


}
