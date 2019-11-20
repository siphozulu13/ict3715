<?php include 'header.php'; ?>
<!-- Page Content -->
<br><br>
<div class="container" style="height: 600px;">

    <div class="row my-4" style="margin-top: 100px;">
        <div class="col-md-8 offset-md-2">
            <h2 class="lead">Make an appointment with your doctor.</h2>
            <form action="index.php" method="post">
                <div class="col-sm-12">
                    <?php if(isset($login_message)){echo $login_message; }else{ echo ""; } ?>
                </div>
                <input type="hidden" name="action" value="saveAppointment">
                <div class="form-group">
                    <label for="consultation">Consultation</label>
                    <select id="consultation" name="consultation" class="form-control">
                        <?php foreach($bookings as $cons): ?>
                        <option value="<?php echo$cons["consultation_id"]; ?>"><?php echo$cons["consultation_name"]; ?> @ R<?php echo$cons["consultation_price"]; ?>.00</option>
                        
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="doctor">Preferred Doctor</label>
                    <select id="doctor" name="doctor" class="form-control">
                        <?php foreach($doctors as $cons): ?>
                        <option value="<?php echo$cons["hcp_id"]; ?>"><?php echo$cons["hcp_name"]; ?></option>
                        
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="time">Preferred Time</label>
                    <select id="time" name="time" class="form-control">
                        <option value="08:00 AM">08:00 AM</option>
                        <option value="10:00 AM">10:00 AM</option>
                        <option value="12:00 PM">12:00 PM</option>
                        <option value="14:00 PM">14:00 PM</option>
                        <option value="16:00 PM">16:00 PM</option>
                    </select>
                </div>
                
                <button type="submit" formaction="?" class="btn btn-primary btn-lg">Make Appointment </button>
                    
                
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>