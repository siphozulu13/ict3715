<?php

/*
 * Alt Health - Appointment booking system
 */
session_start();

require("model/db_connection.php");
require("model/db_functions.php");

// get the required action
$action = filter_input(INPUT_POST, "action");
if ($action == null) {
    $action = filter_input(INPUT_GET, "action");
    if ($action == null) {
        $action = "home";
    }
}

switch ($action){
    case "home":
        include("view/index.php");
        break;
    
    case "consultation":
        @$id = $_GET["id"];
        $consultation = get_consultation($id);
        include("view/consultation-details.php");
        break;
    
    case "about":
        include("view/about.php");
        break;
    
    case "contact":
        include("view/contact.php");
        break;
    
    case "prices":
        $prices = show_all_consultations();
        include("view/prices.php");
        break;
    
    case "consultations":
        include("view/booking.php");
        break;
    
    case "login":
        include("view/login.php");
        break;
    case "register_user":
        // 1. get all the data from the form 
        @$user_id = $_POST["user_id"];
        @$user_first_name = $_POST["user_first_name"];
        @$user_surname = $_POST["user_surname"];
        @$user_tel_h = $_POST["user_tel_h"];
        @$user_tel_w = $_POST["user_tel_w"];
        @$user_tel_c = $_POST["user_tel_c"];
        @$user_email = $_POST["user_email"];
        @$user_password = $_POST["user_password"];
        @$user_password_confirm = $_POST["user_password_confirm"];
        @$user_reference = $_POST["user_reference"];
        @$user_dob = $_POST["user_dob"];
        @$user_address = $_POST["user_address"];
        @$user_gender = $_POST["user_gender"];
        // 2. vaidate the field for validity
        if(empty($user_id)|| empty($user_tel_h) || empty($user_tel_w) || empty($user_tel_c) || empty($user_email) 
                || empty($user_password) || empty($user_password_confirm) || empty($user_reference) || empty($user_dob) 
                || empty($user_address) || empty($user_gender)){
            $message = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Please fill in all the fields.</div>";
            include("view/login.php");
            exit();
        }
        
        if(strlen($user_id) > 13){
            $message = "<div class='alert alert-warning'>"
                    . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "<b>$user_id</b> is not a valid ID/Passport number.</div>";
            include("view/login.php");
            exit();
        }
        
        if((!is_numeric($user_tel_h) && strlen($user_tel_h) < 10 && strlen($user_tel_h) > 10) || (!is_numeric($user_tel_c) && strlen($user_tel_c) < 10 && strlen($user_tel_c) > 10) || (!is_numeric($user_tel_w) && strlen($user_tel_w) < 10 && strlen($user_tel_w) > 10)){
            $message = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Provide valid phone number.</div>";
            include("view/login.php");
            exit();
        }
        
        if($user_password !== $user_password_confirm){
           $message = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Password does not match.</div>";
            include("view/login.php");
            exit(); 
        }
        
        if(validity_email($user_email)->rowCount() > 0){
            $message = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> $user_email already exists.</div>";
            include("view/login.php");
            exit(); 
        }
        
        // 3. hash the password
        $user_password = md5($user_password);
        
        // 4. insert the patient details in the database 
        $register = register_user($user_id, $user_first_name, $user_surname, $user_tel_h, $user_tel_w, $user_tel_c, $user_email, $user_password, $user_reference, $user_dob, $user_address, $user_gender);
        if (isset($register)) {
            $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Patient registeration successful.</div>";
            $user_id = $user_first_name = $user_surname = $user_tel_h =  $user_tel_w = $user_tel_c = $user_email = $user_password = $user_password_confirm = $user_reference = $user_dob = $user_address = $user_gender = "";
            include("view/login.php");
            exit(); 
        }
        break;
        
    case "login_patient":
        // 1. get the email and password
        @$login_email = $_POST["login_email"];
        @$login_password = $_POST["login_password"];
        
        // 2. validate the credentials
        if (empty($login_email) || empty($login_password)) {
            $login_message = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "Enter email and password.</div>";
            include("view/login.php");
            exit(); 
        }
        
        $login = login_user($login_email, $login_password);
        
        if ($login > 0) {
            // login the user
            $_SESSION["authenticated"] = true;
            $_SESSION["id"] = $login["user_id"];
            $_SESSION["name"] = $login["user_first_name"];
            $_SESSION["auth"] = rand(1, 1000);
            // get user previous bookings
            $bookings = get_user_bookings($_SESSION["id"]);
            include("view/bookings.php");
            exit(); 
        } else {
            // display the login error message
            $login_message = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Email/Password does not match. Try again.</div>";
            include("view/login.php");
            exit();
        }
        
        break;
     
     case "logout":
        session_destroy();
        header("Location: ../index.php");
        break;  
    case "profile":
        // get user previous bookings
        $bookings = get_user_bookings($_SESSION["id"]);
        include("view/bookings.php");
        exit(); 
        break;
    case "appointment":
        // get consultation 
        $bookings = show_all_consultations();
        $doctors = show_all_doctors();
        include("view/make-appointment.php");
        exit(); 
        break;
    case "saveAppointment":
        $user_id = $_SESSION["id"];
        $session_id = $_SESSION["auth"];
        if(get_user_session($user_id, $session_id)->rowCount() > 0){
            $message = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>No multiple bookings. Delete this one instead.</strong>.</div>";
            $session_booking = get_user_session($user_id, $session_id);
            include("view/booking.php");
            exit();
        }
        
        // get all data 
        @$consultation = $_POST["consultation"]; $_SESSION["consultation"] = $consultation;
        $user_id = $_SESSION["id"];
        $session_id = $_SESSION["auth"];
        $booking_date = new DateTime('tomorrow'); $booking_date = $booking_date->format('Y-m-d'); $_SESSION["booking_date"] = $booking_date;
        @$doctor = $_POST["doctor"]; $_SESSION["doctor"] = $doctor;
        @$time = $_POST["time"]; $_SESSION["time"] = $time;
        $booking_status = "pending";
        $booking_price = get_booking_price($_SESSION["consultation"]); $_SESSION["price"] = $booking_price;

        $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Booking created. Please review and confirm.</div>";
        include("view/booking.php");
        exit();
        break;
    case "booking":
        $user_id = $_SESSION["id"];
        $session_id = $_SESSION["auth"];
        $session_booking = get_user_session($user_id, $session_id);
        include("view/booking.php");
        break;
    case "delete":
        // unset the session variables 
        unset($_SESSION["consultation"]);unset($_SESSION["booking_date"]);unset($_SESSION["doctor"]);
        unset($_SESSION["time"]);unset($_SESSION["price"]);
        //header("Location: ../view/booking.php");
        include("view/booking.php");
        break;
    case "insertAppointment":
        // insert 
        $booking = make_appointment(null, $_SESSION["consultation"], $_SESSION["id"], $_SESSION["doctor"], $_SESSION["auth"], $_SESSION["booking_date"], $_SESSION["time"], 'Pending', $_SESSION["price"]);
        
        $date = date("Y-m-d");
        $invoice = make_invoice(null, $_SESSION["id"], $_SESSION["consultation"], $_SESSION["price"], $date);
        
        $to = get_user_email($_SESSION["id"]);
        $message = "Hi " . $_SESSION["name"] . ", <br>Thanks for placing a booking at Alt Health with. Looking foward to seeing you tomorrow";
        
        // mail($to, 'ALT HEALTH BOOKING', $message, 'ALT HEALTH MEDICAL CENTRE');
        // display message 
        if(isset($booking)){
            $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Booking created.</div>";
            // get user previous bookings
            $bookings = get_user_bookings($_SESSION["id"]);
            include("view/bookings.php");
            exit();
        }else{
            $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Booking created. Please review and confirm.</div>";
            include("view/booking.php");
            exit();
        }
        break;
    case "update":
        // update the user's profile 
        $user = get_user_details($_SESSION["id"]);
        include("view/update.php");
        exit();
        break;
    case "update_user":
        // get user details 
        $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> User updated.</div>";
        include("view/update.php");
        exit();
        break;
    default :
        // $home_sup = get_home_supplement();
        include("view/index.php");
        break;
}

?>