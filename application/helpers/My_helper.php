<?php
 
 function getCityName($id)
 {
     $data = $GLOBALS['CI']->My_model->select_where("city_tbl",['city_tbl_id'=>$id]);
     if(isset($data[0]))
     {
         return $data[0]['city_name'];
     }
     else{
         return '-';
     }
 }
 function getBusName($id)
 {
     $data = $GLOBALS['CI']->My_model->select_where("buses_tbl",['buses_tbl_id'=>$id]);
     if(isset($data[0]))
     {
         return $data[0]['bus_name'];
     }
     else{
         return '-';
     }
 }
 function getCustomerName($id)
 {
     $data = $GLOBALS['CI']->My_model->select_where("customer_tbl",['customer_tbl_id'=>$id]);
     if(isset($data[0]))
     {
         return $data[0]['name'];
     }
     else{
         return '-';
     }
 }
 
?>