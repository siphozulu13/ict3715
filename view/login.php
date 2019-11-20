<?php include 'header.php'; ?>
<br><br>
<div class="container">

    <div class="row">

        <div class="col-lg-6 py-4">
            <h3>Enter you registered credentials to login</h3>
            <p class="text-muted">If you have registered with us earlier. Please login with your username and password.</p>
            
            <div class="row">
                <div class="col-sm-12">
                    <?php if(isset($login_message)){echo $login_message; }else{ echo ""; } ?>
                </div>
            </div>
            
            <form action="?" method="post">
                
                <input type="hidden" name="action" value="login_patient" />
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email Address:</label>
                        <input type="text" class="form-control" name="login_email">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="login_password">
                    </div>
                </div>
                
                <button type="submit" formaction="?" class="btn btn-primary">Login</button>
            </form>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-6 py-4" style="border-left: 1px solid black;">
            <h3>Not yet registered?</h3>
            <p class="text-muted">Registering with us means the beginning to a journey of unlimited benefits in health care </p>
            
            <div class="row">
                <div class="col-sm-12">
                    <?php if(isset($message)){echo $message; }else{ echo ""; } ?>
                </div>
            </div>
            
            <form action="?" method="post">
                
                <input type="hidden" name="action" value="register_user" />
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>ID/Passport Number:</label>
                        <input type="text" class="form-control" name="user_id" value="<?php if(isset($user_id)){echo $user_id;}else{echo "";} ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>First Name(s):</label>
                        <input type="text" class="form-control" name="user_first_name" value="<?php if(isset($user_first_name)){echo $user_first_name;}else{echo "";} ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Last Name:</label>
                        <input type="text" class="form-control" name="user_surname" value="<?php if(isset($user_surname)){echo $user_surname;}else{echo "";} ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Telephone (Home):</label>
                        <input type="text" class="form-control" name="user_tel_h" value="<?php if(isset($user_tel_h)){echo $user_tel_h;}else{echo "";} ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Telephone (Work):</label>
                        <input type="text" class="form-control" name="user_tel_w" value="<?php if(isset($user_tel_w)){echo $user_tel_w;}else{echo "";} ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Telephone (Cell):</label>
                        <input type="text" class="form-control" name="user_tel_c" value="<?php if(isset($user_tel_c)){echo $user_tel_c;}else{echo "";} ?>">
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email Address:</label>
                        <input type="text" class="form-control" name="user_email" value="<?php if(isset($user_email)){echo $user_email;}else{echo "";} ?>">
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
                        <select name="user_reference" class="form-control">
                            <option value="Internet">Internet</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Friends">Friends</option>
                        </select>
                    </div>
                </div>
                
                <div class="control-group form-group">
                    <label>Date of Birth:</label>
                    <input type="date" class="form-control" name="user_dob" value="<?php if(isset($user_dob)){echo $user_dob;}else{echo "";} ?>">
                </div>
                
                <div class="control-group form-group">
                    <label>Address:</label>
                    <input type="text" class="form-control" name="user_address" value="<?php if(isset($user_address)){echo $user_address;}else{echo "";} ?>">
                </div>
                
                <div class="form-group">
                    <label>Gender:</label>
                    <input type="radio" name="user_gender" value="M"> Male 
                    <input type="radio" name="user_gender" value="F"> Female 
                </div>
                
                <button type="submit" formaction="?" class="btn btn-primary">Register Patient</button>
                
            </form>
            
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>