<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('My_model');
    }
    private function load_view($view, $data = [])
    {
        $this->load->view('customer/navbar');
        $this->load->view($view, $data);
        $this->load->view('customer/footer');
    }
    private function setToastMessage($message, $color)
    {
        $_SESSION['toast_message'] = $message;
        $_SESSION['toast_color'] = $color;
    }
    public function index()
    {
        $this->load_view('customer/login');
    }
    public function check_login()
    {
        $user_data = $this->My_model->select_where("customer_tbl", ['mobile' => $_POST['mobile'], 'password' => $_POST['password']]);
        if (isset($user_data[0])) {
            $_SESSION['customer_tbl_id'] = $user_data[0]['customer_tbl_id'];
            $this->setToastMessage('Login successful... ', 'Success');
            redirect('customer/index', 'refresh');
        } else {
            $this->setToastMessage('Fail to login... ', 'Danger');
            redirect('login', 'refresh');
        }
    }
    public function save_customer()
    {
        $old_data = $this->My_model->select_where("customer_tbl", ['mobile' => $_POST['mobile']]);
        if (isset($old_data[0])) {
            $this->setToastMessage('Mobile Number is already exist...', 'Danger');
            redirect("login/registration", 'refresh');
        } else {
            $inserted_tbl_id = $this->My_model->insert("customer_tbl", $_POST);
            if ($inserted_tbl_id) {
                $_SESSION['customer_tbl_id'] = $inserted_tbl_id;
                $this->setToastMessage('Registration successful... ', 'Success');
                redirect('customer/index', 'refresh');
            } else {
                $this->setToastMessage('Fail to register...', 'Danger');
                redirect("login", 'refresh');
            }
        }
    }
    public function registration()
    {
        $this->load_view('customer/registration');
    }

    public function log_out()
    {
        session_destroy();
        redirect('customer/index',"refresh");
    }
}
