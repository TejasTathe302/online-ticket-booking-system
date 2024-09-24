<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('My_model');
        $this->load->helper('My_helper');
    }
    private function load_view($view, $data = [])
    {
        $this->load->view('customer/navbar');
        $this->load->view($view, $data);
        $this->load->view('customer/footer');
    }
    public function index()
    {
        $this->load_view('customer/index');
    }
    public function booking()
    {
        if (!isset($_SESSION['customer_tbl_id'])) {
            redirect("login",'refresh');
        }
        if (isset($_GET['from']) && isset($_GET['to'])) {
            $from = $_GET['from'];
            $to = $_GET['to'];
            $count = ['amount_to_reach_single' => 0, 'amount_to_reach_double' => 0];
            if ($from > $to) {
                $data['pricing'] = $this->getTicketPrice($count, $from);
                $data['booking_data'] = $this->db->query("
                SELECT booking_seat_details_tbl.seat_name 
                FROM booking_seat_details_tbl 
                JOIN booking_tbl 
                ON booking_tbl.booking_tbl_id = booking_seat_details_tbl.booking_tbl_id 
                WHERE booking_tbl.status = 'active' 
                AND booking_seat_details_tbl.status = 'active'
                AND (
                    (booking_tbl.from_location >= $from AND booking_tbl.to_location <= $to) OR
                    (booking_tbl.from_location >= $from AND booking_tbl.to_location < $from) OR
                    (booking_tbl.from_location > $to AND booking_tbl.to_location <= $to)
                )
            ")->result_array();
            } else {
                $data['pricing'] = $this->getTicketPrice($count, $to);
                $data['booking_data'] = $this->db->query("
                SELECT booking_seat_details_tbl.seat_name 
                FROM booking_seat_details_tbl 
                JOIN booking_tbl 
                ON booking_tbl.booking_tbl_id = booking_seat_details_tbl.booking_tbl_id 
                WHERE booking_tbl.status = 'active' 
                AND booking_seat_details_tbl.status = 'active'
                AND (
                    (booking_tbl.from_location <= $from AND booking_tbl.to_location >= $to) OR
                    (booking_tbl.from_location <= $from AND booking_tbl.to_location > $from) OR
                    (booking_tbl.from_location < $to AND booking_tbl.to_location >= $to)
                )
            ")->result_array();
            }
            
            $data['booked_seats']=[];
            foreach($data['booking_data'] as $row){
                array_push($data['booked_seats'],$row['seat_name']);
            }
        }
        $data['citys'] = $this->My_model->select_where("city_tbl", ['status' => 'active']);
        $this->load_view('customer/booking', $data);
    }
    

    private function getTicketPrice($count, $city_tbl_id)
    {
        $city_det = $this->My_model->select_where("city_tbl", ['city_tbl_id' => $city_tbl_id, 'status' => 'active']);
        if (!empty($city_det)) {
            if ($city_det[0]['prev_city'] != $city_tbl_id) {
                $newCount = ['amount_to_reach_single' => $count['amount_to_reach_single'] + $city_det[0]['amount_to_reach_single'], 'amount_to_reach_double' => $count['amount_to_reach_double'] + $city_det[0]['amount_to_reach_double']];
                return $this->getTicketPrice($newCount, $city_det[0]['prev_city']);
            } else {
                $newCount = ['amount_to_reach_single' => $count['amount_to_reach_single'] + $city_det[0]['amount_to_reach_single'], 'amount_to_reach_double' => $count['amount_to_reach_double'] + $city_det[0]['amount_to_reach_double']];
                return $newCount;
            }
        } else {
            $count = ['amount_to_reach_single' => 0, 'amount_to_reach_double' => 0];
            return $count;
        }
    }

    public function save_booking()
    {
        $booking_tbl_data['customer_tbl_id'] = $_SESSION['customer_tbl_id'];
        $booking_tbl_data['booked_seats'] = implode(", ", $_POST['selectedSeats']);
        $booking_tbl_data['from_location'] = $_POST['from'];
        $booking_tbl_data['to_location'] = $_POST['to'];
        $booking_tbl_data['totalPrice'] = $_POST['totalPrice'];
        $booking_tbl_data['entry_by'] = $_SESSION['customer_tbl_id'];
        $booking_tbl_id = $this->My_model->insert("booking_tbl", $booking_tbl_data);
        foreach ($_POST['selectedSeats'] as $row) {
            $booking_seat_details_tbl_data['customer_tbl_id'] = $_SESSION['customer_tbl_id'];
            $booking_seat_details_tbl_data['seat_name'] = $row;
            $booking_seat_details_tbl_data['booking_tbl_id'] = $booking_tbl_id;
            $booking_seat_details_tbl_data['entry_by'] = $_SESSION['customer_tbl_id'];
            $booking_seat_details_tbl_id = $this->My_model->insert("booking_seat_details_tbl", $booking_seat_details_tbl_data);
        }
        if ($booking_tbl_id) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'fail']);
        }
    }
    public function your_booking()
    {
        if (!isset($_SESSION['customer_tbl_id'])) {
            redirect("login",'refresh');
        }
        $data['booking_tbl_data']=$this->My_model->select_where("booking_tbl",['customer_tbl_id'=>$_SESSION['customer_tbl_id'],'status'=>'active']);
        $this->load_view('customer/your_booking',$data);
    }
    public function roads()
    {
        $data['citys'] = $this->My_model->select_where("city_tbl", ['status' => 'active']);
        if (isset($_GET['from']) && isset($_GET['to'])) {
            $count = 0;
            $routs=[];
            if ($_GET['from'] > $_GET['to']) {
                $data['routs'] = $this->getRouts2($count, $routs, $_GET['from'],$_GET['to']);
            } else {
                $data['routs'] = $this->getRouts1($count, $routs, $_GET['from'],$_GET['to']);
            }
        }
        $this->load_view('customer/roads',$data);
    }

    private function getRouts1($count, $rout, $from, $to)
    {
        $city_det = $this->My_model->select_where("city_tbl", ['city_tbl_id' => $from, 'status' => 'active']);
        if (!empty($city_det)) {
            if ($city_det[0]['city_tbl_id'] != $to) {
                if($count == 0){
                $newRout=$rout;
                $newRout[$count] = ['city_name'=>$city_det[0]['city_name'],'amount_to_reach_single' => 0, 'amount_to_reach_double' => 0];
                return $this->getRouts1(1, $newRout, $city_det[0]['city_tbl_id']+1, $to);
                }
                $newRout=$rout;
                $newRout[$count] = ['city_name'=>$city_det[0]['city_name'],'amount_to_reach_single' => $rout[$count-1]['amount_to_reach_single'] + $city_det[0]['amount_to_reach_single'], 'amount_to_reach_double' => $rout[$count-1]['amount_to_reach_double'] + $city_det[0]['amount_to_reach_double']];
                return $this->getRouts1($count + 1, $newRout, $city_det[0]['city_tbl_id']+1, $to);
            } else {
                if($count == 0){
                    $newRout=$rout;
                    $newRout[$count] = ['city_name'=>$city_det[0]['city_name'],'amount_to_reach_single' => 0, 'amount_to_reach_double' => 0];
                    return $newRout;
                    }
                    $newRout=$rout;
                    $newRout[$count] = ['city_name'=>$city_det[0]['city_name'],'amount_to_reach_single' => $rout[$count-1]['amount_to_reach_single'] + $city_det[0]['amount_to_reach_single'], 'amount_to_reach_double' => $rout[$count-1]['amount_to_reach_double'] + $city_det[0]['amount_to_reach_double']];
                    return $newRout;
            }
        } else {
            $newRout = [];
            return $newRout;
        }
    }
    private function getRouts2($count, $rout, $from, $to)
    {
        $city_det = $this->My_model->select_where("city_tbl", ['city_tbl_id' => $from, 'status' => 'active']);
        if (!empty($city_det)) {
            if ($city_det[0]['city_tbl_id'] != $to) {
                if($count == 0){
                $newRout=$rout;
                $newRout[$count] = ['city_name'=>$city_det[0]['city_name'],'amount_to_reach_single' => 0, 'amount_to_reach_double' => 0];
                return $this->getRouts2(1, $newRout, $city_det[0]['city_tbl_id']-1, $to);
                }
                $newRout=$rout;
                $count_city_det = $this->My_model->select_where("city_tbl", ['city_tbl_id' => $from+1, 'status' => 'active']);
                $newRout[$count] = ['city_name'=>$city_det[0]['city_name'],'amount_to_reach_single' => $rout[$count-1]['amount_to_reach_single'] + $count_city_det[0]['amount_to_reach_single'], 'amount_to_reach_double' => $rout[$count-1]['amount_to_reach_double'] + $count_city_det[0]['amount_to_reach_double']];
                return $this->getRouts2($count + 1, $newRout, $city_det[0]['city_tbl_id']-1, $to);
            } else {
                if($count == 0){
                    $newRout=$rout;
                    $newRout[$count] = ['city_name'=>$city_det[0]['city_name'],'amount_to_reach_single' => 0, 'amount_to_reach_double' => 0];
                    return $newRout;
                    }
                    $newRout=$rout;
                    $count_city_det = $this->My_model->select_where("city_tbl", ['city_tbl_id' => $from+1, 'status' => 'active']);
                    $newRout[$count] = ['city_name'=>$city_det[0]['city_name'],'amount_to_reach_single' => $rout[$count-1]['amount_to_reach_single'] + $count_city_det[0]['amount_to_reach_single'], 'amount_to_reach_double' => $rout[$count-1]['amount_to_reach_double'] + $count_city_det[0]['amount_to_reach_double']];
                    return $newRout;
            }
        } else {
            $newRout = [];
            return $newRout;
        }
    }
}
