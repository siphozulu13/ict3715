<?php include 'header.php'; ?>
<!-- Page Content -->
<br><br>
<div class="container">
    
    <div class="row my-4">
        <div class="col-sm-8 offset-sm-2">
            <?php if(isset($message)){echo $message; }else{ echo ""; } ?>
        </div>
        <?php if(isset($_SESSION["booking_date"])){ ?>
        <div class="col-md-8 offset-md-2">
            <h2 class="lead">Previous appointments</h2>
            <table class="table-bordered">
                <tr><th>Booking</th><th>Doctor</th><th>Booking Date</th><th>Booking Time</th><th>Booking Price</th><th>&nbsp;</th></tr>
                
                <tr>
                    <td><?php echo get_booking_name($_SESSION["consultation"]); ?></td>
                    <td><?php echo get_doctor_name($_SESSION["doctor"]); ?></td>
                    <td><?php echo $_SESSION["booking_date"]; ?></td>
                    <td><?php echo $_SESSION["time"]; ?></td>
                    <td><?php echo "R".$_SESSION["price"] . ".00"; ?></td>
                    <td><a href="?action=delete" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
            
            </table>
            <br><br>
            <center>
                <a href="?action=insertAppointment" class="btn btn-primary btn-lg">Confirm Booking</a>
            </center>
            
        </div>
        <?php }else{ ?>
            <div class="col-md-8 offset-md-2">
                <h2 class="lead">You have no booking. Place a booking.</h2>
            </div>
        <?php } ?>
    </div>
</div>
