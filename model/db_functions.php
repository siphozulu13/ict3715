<?php
/*
 * FUNCTION FOR DATABASE INTERACTION AND FULL WEBSITE FUNCTIONALITY
 */
include("db_connection.php"); // gives access to the database

function show_all_consultations(){
    global $conn;
    $query = "SELECT * FROM consultation";
    $rows = $conn->query($query);
    return $rows;
}

function show_all_doctors(){
    global $conn;
    $query = "SELECT * FROM hcp";
    $rows = $conn->query($query);
    return $rows;
}


function get_consultation($id){
    global $conn;
    $query = "SELECT * FROM consultation WHERE consultation_id = '$id'";
    $rows = $conn->query($query);
    return $rows;
}

function validity_email($user_email){
    global $conn;
    $query = "SELECT * FROM user WHERE user_email = '$user_email'";
    $rows = $conn->query($query);
    return $rows;
}

function register_user($user_id, $user_first_name, $user_surname, $user_tel_h, $user_tel_w, $user_tel_c, $user_email, $user_password, $user_reference, $user_dob, $user_address, $user_gender){
    global $conn;
    $query = "INSERT INTO `user`(`user_id`, `user_first_name`, `user_surname`, `user_tel_h`, `user_tel_w`, `user_tel_c`, `user_email`, `user_password`, `user_reference`, `user_dob`, `user_address`, `user_gender`) VALUES "
            . "('$user_id','$user_first_name','$user_surname','$user_tel_h','$user_tel_w','$user_tel_c','$user_email','$user_password','$user_reference','$user_dob','$user_address','$user_gender')";
    $rows = $conn->exec($query);
    return $rows;
}

// function to authenticate the user 
function login_user($email, $password){
    global $conn;
    $password = md5($password);
    $query = "SELECT * FROM user WHERE user_email = '$email' AND user_password = '$password' LIMIT 1";
    $rows = $conn->query($query)->fetch();
    return $rows;
}

// get logged in user from database 
function get_logged_in_user($id){
    global $conn;
    $query = "SELECT * FROM user WHERE user_id = '$id' LIMIT 1";
    $rows = $conn->query($query)->fetch();
    return $rows;
}

// gets user previous bookings 
function get_user_bookings($id){
    global $conn;
    $query = "SELECT * FROM booking WHERE user_id = '$id'";
    $rows = $conn->query($query);
    return $rows;
}

function make_appointment($booking_id, $consultation_id, $user_id, $hcp_id, $session_id, $booking_date, $booking_time, $booking_status, $booking_price){
    global $conn;
    $query = "INSERT INTO `booking`(`booking_id`, `consultation_id`, `user_id`, `hcp_id`, `session_id`, `booking_date`, `booking_time`, `booking_status`, `booking_price`) VALUES "
            . "('$booking_id','$consultation_id','$user_id','$hcp_id','$session_id','$booking_date','$booking_time','$booking_status','$booking_price')";
    $rows = $conn->exec($query);
    return $rows;
}

function get_booking_price($id){
    global $conn;
    $query = "SELECT consultation_price FROM consultation WHERE consultation_id = '$id'";
    $rows = $conn->query($query)->fetchColumn();
    return $rows;
}

function get_booking_name($id){
    global $conn;
    $query = "SELECT consultation_name FROM consultation WHERE consultation_id = '$id'";
    $rows = $conn->query($query)->fetchColumn();
    return $rows;
}

function get_doctor_name($id){
    global $conn;
    $query = "SELECT hcp_name FROM hcp WHERE hcp_id = '$id'";
    $rows = $conn->query($query)->fetchColumn();
    return $rows;
}

function get_user_name($id){
    global $conn;
    $query = "SELECT user_first_name FROM user WHERE user_id = '$id'";
    $rows = $conn->query($query)->fetchColumn();
    return $rows;
}

function get_user_session($user_id, $session_id){
    global $conn;
    $query = "SELECT * FROM booking WHERE user_id = '$user_id' AND session_id = '$session_id'";
    $rows = $conn->query($query);
    return $rows;
}

function delete_booking($id){
    global $conn;
    $query = "DELETE FROM booking WHERE booking_id = '$id'";
    $rows = $conn->exec($query);
    return $rows;
}

function make_invoice($invoice_id, $user_id, $booking_id, $invoice_total, $invoice_date){
    global $conn;
    $query = "INSERT INTO `invoice`(`invoice_id`, `user_id`, `booking_id`, `invoice_total`, `invoice_date`) VALUES "
            . "('$invoice_id','$user_id','$booking_id','$invoice_total','$invoice_date')";
    $rows = $conn->exec($query);
    return $rows;
}

function get_user_email($id){
    global $conn;
    $query = "SELECT user_email FROM user WHERE user_id = '$id'";
    $rows = $conn->query($query)->fetchColumn();
    return $rows;
}
/////////////////ADMIN FUNCTIONS/////////////////

// function to authenticate the user 
function login_admin($email, $password){
    global $conn;
    //$password = md5($password);
    $query = "SELECT * FROM hcp WHERE hcp_email = '$email' AND hcp_password = '$password' LIMIT 1";
    $rows = $conn->query($query)->fetch();
    return $rows;
}

// function to calculate financial figures
// function to calculate daily income 
function monthly_income(){
    $conn = new PDO("mysql:host=localhost;dbname=id11305519_test", "id11305519_sipho", "sipho");
    $result = $conn->query("SELECT SUM(invoice_total) FROM invoice WHERE MONTH(invoice_date) = MONTH(CURRENT_DATE);")->fetchColumn();
    if($result > 0){
        $sum = $result;
    }else{
        $sum = "0";
    }
    return $sum;
}

function weekly_income(){
    $conn = new PDO("mysql:host=localhost;dbname=id11305519_test", "id11305519_sipho", "sipho");
    $result = $conn->query("SELECT SUM(invoice_total) FROM invoice WHERE WEEK(invoice_date) = WEEK(CURRENT_DATE);")->fetchColumn();
    if($result > 0){
        $sum = $result;
    }else{
        $sum = "0";
    }
    return $sum;
}

function daily_income(){
    $conn = new PDO("mysql:host=localhost;dbname=id11305519_test", "id11305519_sipho", "sipho");
    $result = $conn->query("SELECT SUM(invoice_total) FROM invoice WHERE invoice_date = CURRENT_DATE;")->fetchColumn();
    if($result > 0){
        $sum = $result;
    }else{
        $sum = "0";
    }
    return $sum;
}


function get_bookings(){
    global $conn;
    $query = "SELECT * FROM booking ORDER BY booking_id DESC";
    $result = $conn->query($query);
    return $result;
}

function get_users(){
    global $conn;
    $query = "SELECT * FROM user;";
    $result = $conn->query($query);
    return $result;
}

function get_user_details($id){
    global $conn;
    $query = "SELECT * FROM user WHERE user_id = '$id' LIMIT 1;";
    $result = $conn->query($query)->fetch();
    return $result;
}

function get_admin($id){
    global $conn;
    $query = "SELECT * FROM hcp WHERE hcp_id = '$id' LIMIT 1;";
    $result = $conn->query($query)->fetch();
    return $result;
}

function get_search_user($search){
    global $conn;
    $query = "SELECT * FROM user WHERE user_first_name LIKE '%$search%'";
    $result = $conn->query($query);
    return $result;
}

function sum_all_particular_month_payment($month){
    $conn = new PDO("mysql:host=localhost;dbname=id11305519_test", "id11305519_sipho", "sipho");
    $result = $conn->query("SELECT SUM(invoice_total) FROM invoice WHERE MONTH(invoice_date) = '$month'")->fetchColumn();
    return $result;
    /*
    if($result > 0){
        $sum = $result;
    }else{
        $sum = "0";
    }
    return $sum;
     */
}

?>


