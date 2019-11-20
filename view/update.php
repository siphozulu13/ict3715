<?php include 'header.php'; ?>
<!-- Page Content -->
<br><br>
<div class="container">
    
    <div class="row mb-4" style="margin-top: 100px;">
        <div class="col-sm-8 offset-sm-2">
            <div class="row">
                <div class="col-sm-12">
                    <?php if(isset($message)){echo $message; }else{ echo ""; } ?>
                </div>
            </div>
            <h2 class="lead">You can update your patient details here</h2>
            <form action="index.php?action=update_user" method="post">
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>ID/Passport Number:</label>
                        <input type="text" class="form-control" name="user_id" value="<?php echo $user["user_id"]; ?>" readonly="readonly">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>First Name(s):</label>
                        <input type="text" class="form-control" name="user_first_name" value="<?php echo $user["user_first_name"]; ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Last Name:</label>
                        <input type="text" class="form-control" name="user_surname" value="<?php echo $user["user_surname"]; ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Telephone (Home):</label>
                        <input type="text" class="form-control" name="user_tel_h" value="<?php echo $user["user_tel_h"]; ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Telephone (Work):</label>
                        <input type="text" class="form-control" name="user_tel_w" value="<?php echo $user["user_tel_w"]; ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Telephone (Cell):</label>
                        <input type="text" class="form-control" name="user_tel_c" value="<?php echo $user["user_tel_c"]; ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email Address:</label>
                        <input type="text" class="form-control" name="user_email" value="<?php echo $user["user_email"]; ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="user_password" value="">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" name="user_password_confirm" value="">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Reference:</label>
                        <input type="text" class="form-control" name="user_reference" value="<?php echo $user["user_reference"]; ?>" readonly="readonly">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <label>Date of Birth:</label>
                    <input type="date" class="form-control" name="user_dob" value="<?php echo $user["user_dob"]; ?>" readonly="readonly">
                </div>
                
                <div class="control-group form-group">
                    <label>Address:</label>
                    <textarea rows="5" cols="10" name="user_address" class="form-control"><?php echo $user["user_address"]; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Gender:</label>
                    <input type="text" class="form-control" name="user_gender" value="<?php echo $user["user_gender"]; ?>" readonly="readonly">
                </div>
                <center>
                    <button type="submit" class="btn btn-primary">Update Patient Details</button>
                </center>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>