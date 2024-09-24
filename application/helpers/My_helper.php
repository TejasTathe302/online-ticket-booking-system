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
 
?>