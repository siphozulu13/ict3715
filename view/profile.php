<?php include 'header.php'; ?>
<!-- Page Content -->
<div>
    <div class="row">
       
        <div class="col-md-8 offset-md-2 py-4">
            
            <p class="text-muted">Hi, <?php echo $_SESSION["name"]; ?>. 
                We know remembering your details can be a 
        hassle sometimes. You can update your clinic details here.</p>
            
            <div class="row">
                <div class="col-sm-12">
                    <?php //if(isset($upd_message)){echo $upd_message; }else{ echo ""; } ?>
                </div>
            </div>
            
            <form action="index.php?action=update_user" method="post">
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>ID/Passport Number:</label>
                        <input type="text" class="form-control" name="idnumber" value="<?php echo $user["user_id"]; ?>" readonly="">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>First Name(s):</label>
                        <input type="text" class="form-control" name="name" value="<?php echo ""; ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Last Name:</label>
                        <input type="text" class="form-control" name="surname" value="<?php echo ""; ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Age:</label>
                        <input type="text" class="form-control" name="age" value="<?php echo ""; ?>" readonly="readonly">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Gender:</label>
                        <input type="text" class="form-control" name="gender" value="<?php echo ""; ?>" readonly="readonly">
                    </div>
                </div>
                
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Phone Number:</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo ""; ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Address:</label>
                        <input type="text" class="form-control" name="address" value="<?php echo ""; ?>">
                    </div>
                </div>
                
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email Address:</label>
                        <input type="text" class="form-control" name="email" value="<?php echo ""; ?>">

                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" value="<?php echo ""; ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" name="con_password">
                    </div>
                </div>
                
                <button type="submit" formaction="?" class="btn btn-primary">Update Patient Profile</button>
                
            </form>
            
            
        </div>
    </div>

</div>
<!-- /.container -->
<?php include 'footer.php'; ?>