<?php include 'header.php'; ?>
<!-- Page Content -->
<br><br>
<div class="container">
    
    <div class="row my-4">
        
        <div class="col-md-8 offset-md-2">
            <a href="?action=appointment" class="btn btn-success btn-lg">Make an Appointment</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <?php if(isset($message)){echo $message; }else{ echo ""; } ?>
        </div>
        <?php if($bookings->rowCount() > 0){ ?>
        <div class="col-md-8 offset-md-2">
            <h2 class="lead">Previous appointments</h2>
            <?php foreach ($bookings as $book): ?>
                <div class="card card-body bg-light">
                    <p> <?php echo "<strong>" . get_booking_name($book["consultation_id"]) . "</strong> with Dr. " . get_doctor_name($book["hcp_id"]) . " on <strong>" . $book["booking_date"] . "</strong>"; ?> </p>
                </div>
                <br>
            <?php endforeach; ?>
        </div>
        <?php }else{ ?>
            <div class="col-md-8 offset-md-2">
                <h2 class="lead">You have no previous bookings</h2>
            </div>
        <?php } ?>
    </div>
</div>
