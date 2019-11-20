<?php

/*
 * Action script for the JavaScript side of the system


session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/model/db_connection.php");
include($_SERVER["DOCUMENT_ROOT"] . "/model/db_functions.php");

if (isset($_POST["show_patient_booking"])) {

    $patient_id = $_SESSION["id"];
    $bk = get_patient_booking_by_id($patient_id);

    if ($bk->rowCount() > 0) {
        $s_p_b = get_single_patient_booking_by_id($patient_id);

        $s_p_booking_id = $s_p_b["booking_id"];
        $s_p_service_id = $s_p_b["service_id"];
        $_p_service_name = get_only_service_name_by_id($s_p_service_id);
        $s_p_patient_id = $s_p_b["patient_id"];
        $s_p_doctor_name = $s_p_b["doctor_name"];
        $s_p_booking_date = $s_p_b["booking_date"];
        $s_p_booking_time = $s_p_b["booking_time"];
        $s_p_booking_price = $s_p_b["booking_price"];

        echo "
                <h5 style='color:red;'>Below is your doctor booking. Please select a preferred doctor and time and update your booking.</h5><br><br>
                
                <div class='table-responsive'>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Booking</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Doctor</th>
                                <th colspan='2'>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    $_p_service_name
                                </td>
                                <td>
                                    $s_p_booking_date
                                </td>
                                <td>
                                    <select class='form-control form-control-sm' id='booking_time'>
                                        <option selected>Choose time..</option>
                                        <option value='9:00'>9:00</option>
                                        <option value='11:00'>11:00</option>
                                        <option value='13:00'>13:00</option>
                                        <option value='13:00'>15:00</option>
                                    </select>
                                </td>
                                <td>
                                    <select class='form-control form-control-sm' id='booking_doctor'>
                                        <option selected>Choose time..</option>
                                        <option value='Dr. Juju Masipa'>Dr. Juju Masipa</option>
                                        <option value='Dr. Mpho Xolani'>Dr. Mpho Xolani</option>
                                        <option value='Dr. Spencer Van Staden'>Dr. Spencer Van Staden</option>
                                    </select>
                                </td>
                                <td>R$s_p_booking_price</td>
                                <td><button class='btn btn-danger btn-sm delete_button' delete_id='$s_p_booking_id'> Delete</button></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                
                <!-- /.table-responsive -->

                <div class='box-footer'>
                   

                    <div class='pull-right' style='float:right;'>
                        <button class='btn btn-default btn-sm update_button' update_id='$s_p_booking_id'> Update</button>
                        <a href='?action=patient-review' class='btn btn-primary btn-sm'>Review</a>
                    </div>
                </div>";
    } else {

        echo "<div class='row'>
                <h2 style='color:red'>Sorry, you have no booking yet. <br><br> &nbsp; &nbsp;
                <img src='../images/sad.png' class='img-responsive' alt='sad face' width='200' height='200'/>
                </h2>
                
            </div>";
    }
}

if (isset($_POST["create_booking"])) {
    
    @$patient_id = $_SESSION["id"];
    $booking_id = $_POST["booking_id"];

    if (!isset($_SESSION["authenticated"])) {
        echo "<div class='alert alert-warning'>"
        . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                . "Please login/create an account first.</div>";
    } else {
        
        // validations 
        $patient_has_booking = check_if_user_has_booking($patient_id, $booking_id);
        
        if ($patient_has_booking->rowCount() > 0) {
            echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> You have a pending booking already.</div>";
            // check for mutiple booking
            $multiple_booking = check_client_booking($patient_id);
            if ($multiple_booking->rowCount() > 0) {
                echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Only one booking at a time allowed.</div>";
            
            }
        } else {
            // user has no booking  - place a new booking for them 
            $booking_info = get_selected_booking_by_id($booking_id); // get the info of the service selected 

            $service_id = $booking_info["service_id"];
            $patient_id = $_SESSION["id"];
            $doctor_name = null;
            $booking_date = new DateTime('tomorrow'); $booking_date = $booking_date->format("Y-m-d");
            $booking_time = "9:00";
            $booking_status = "Pending";
            $booking_price = $booking_info["service_price"];

            // insert the new booking 
            $service_insert = place_booking_for_service(null, $service_id, $patient_id, $doctor_name, $booking_date, $booking_time, $booking_status, $booking_price);
            
            if (isset($service_insert)) {
                echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Booking created successfully. Update your booking.</div>";
            }
        }
    }
}

// php code to process the update of the booking
if (isset($_POST["updateBooking"])) {
    $update_id = $_POST["update_id"];
    $booking_time = $_POST["booking_time"];
    $booking_doctor = $_POST["booking_doctor"];

    $update_booking = update_booking_doctor_and_time($update_id, $booking_doctor, $booking_time);

    if (isset($update_booking)) {
        echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Doctor and time updated successfully. Proceed to checkout.</b>.</div>";
    }
}

// php to process the delettion
if (isset($_POST["deleteBooking"])) {
    $delete_id = $_POST["delete_id"];

    $delete_booking = delete_booking($delete_id);
    if (isset($delete_booking)) {
        echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Booking deleted successfully.</b>.</div>";
    }
}

//////////////////////////////////////////Code To Add To Cart/////////////////////////////////////////
// processes the cart count
if (isset($_POST["cart_count"])) {
    @$patient_id = $_SESSION["id"];
    
    $query = "SELECT * FROM cart WHERE patient_id = '$patient_id'";
    $row = $conn->query($query)->rowCount();
    if($row < 1){
        echo "0";
    } else {
        echo $row;
    }
}

if (isset($_POST["addToCart"])) {

    if (isset($_SESSION["authenticated"])) {

        $supplement_id = $_POST["product_id"];
        @$patient_id = $_SESSION["id"];

        $query = "SELECT * FROM cart WHERE supplement_id = '$supplement_id' AND patient_id = '$patient_id'";
        $row = $conn->query($query);
        if ($row->rowCount() > 0) {
            echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Supplement already in cart.</b>.</div>";
        } else {
            // add the supplement newly to the cart 
            $query = "SELECT * FROM supplement WHERE supplement_id = '$supplement_id'";
            $row = $conn->query($query)->fetch();

            $supplement_id = $row["supplement_id"];
            $supplement_name = $row["supplement_name"];
            $supplement_price = $row["supplement_price"];
            $supplement_img = $row["supplement_img"];

            // insert the product into the cart
            $query = "INSERT INTO `cart`(`cart_id`, `supplement_id`, `patient_id`, `qty`, `price`, `total`) VALUES "
                    . "(NULL,'$supplement_id','$patient_id','1','$supplement_price','$supplement_price')";
            $row = $conn->exec($query);
            if (isset($row)) {
                echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Product added to cart.</b>.</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Please login first.</b>.</div>";
    }
}

if (isset($_POST["cart_view"])) {
    $patient_id = $_SESSION["id"];
    $no = 0;
    $total_amt = 0;
    
    $query = "SELECT * FROM cart WHERE patient_id = '$patient_id'";
    $row = $conn->query($query);
      
    if($row->rowCount() > 0){
        echo "<div class='table-responsive'>
                       <table class='table'>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th colspan='2'>Total</th>
                            </tr>
                        </thead>
                        <tbody>";
        foreach ($row as $rows){
            // get all data 
            $supplement_id = $rows["supplement_id"]; $supplement_name = get_supplement_name_only_by_id($supplement_id); $supplement_img = get_supplement_img_only_by_id($supplement_id);
            $qty = $rows["qty"];
            $price = $rows["price"];
            $total = $rows["total"];
            $no = $no + 1;
            
            
            $price_array = array($total);
            $total_sum = array_sum($price_array);
            @$total_amt = $total_amt + $total_sum;
            
            echo "<tr>
                        <td>
                            $no
                        </td>
                        <td>
                            <img src='../images/$supplement_img' alt='supplement image' width='50' height='70' />
                        </td>
                        <td>
                            $supplement_name
                        </td>
                        <td>
                            <input type='text' value='$price' class='form-control-sm price' product_id='$supplement_id' id='price-$supplement_id' readonly size='4'>
                        </td>
                        <td>
                            <input type='text' value='$qty' class='form-control-sm qty' product_id='$supplement_id' id='qty-$supplement_id' size='1' />
                        </td>
                        <td>
                            <input type='text' value='$total' class='form-control-sm total' product_id='$supplement_id' id='total-$supplement_id' readonly size='4'>
                        </td>
                        <td>
                            <a href='#'><i class='fas fa-trash-alt fa-2x delete' delete_id='$supplement_id' title='delete'></i></a> 
                            &nbsp; 
                            <a href='#'><i class='fas fa-check fa-2x update' update_id='$supplement_id' title='update'></i></a>
                        </td>
                    </tr>
                ";

        }
        
   
        
        echo "
                    </tbody>
                    
                    </table>
                </div>
                
                <div class='row' style='float:right;'>
                    <input type='text' class='form-control-sm' value='R$total_amt.00' id='cartTotal' readonly >
                </div>
                
                <br /><br /><hr>
                
                <div class='row' style='float: right;'>
                    <h1>Select a payment method </h1><br><br> &nbsp; &nbsp;
                   <img src='../images/gateway.png' class='img-responsive' /> &nbsp; <img src='../images/paypal.jpg' class='img-responsive' />
                </div>
                ";
        
        
    } else {
        echo "<div class='row'>
                <h2 style='color:red'>Sorry, you have no product in cart yet. <br><br> &nbsp; &nbsp;
                <i class='fas fa-empty-set fa-10x'></i>
                </h2>
            </div>";  
    }
}

if (isset($_POST["deleteFromCart"])) {
    $supplement_id = $_POST["product_id"];
    @$patient_id = $_SESSION["id"];
    
    $query = "DELETE FROM cart WHERE supplement_id = '$supplement_id' AND patient_id = '$patient_id'";
    $row = $conn->exec($query);
    
    if (isset($row)) {
        echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Supplement deleted from cart.</b>.</div>";
    }
}

if (isset($_POST["updateSupplement"])) {
    $supplement_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $total = $_POST["total"];
    @$patient_id = $_SESSION["id"];
    
    $query = "UPDATE cart SET qty = '$quantity', price = '$price', total = '$total' WHERE supplement_id = '$supplement_id' AND patient_id = '$patient_id'";
    $row = $conn->exec($query);
    if (isset($row)) {
        echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Supplement updated successfully.</b>.</div>";
    }
}
 */

?>