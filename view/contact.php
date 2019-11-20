<?php include 'header.php'; ?>
<div class="container">

    <h3 class="my-4">Contact Information</h3>

    <div class="row">

        <div class="col-lg-8 mb-4">

            <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
            <h3>Contact Details</h3>
            <p>
                <strong>Health Center Address: </strong><br>
                12 Pendoring Road, 
                <br>Klippoortjie, Boksburg 1459
                <br>
            </p>
            <p>
                <strong>Phone Number: </strong><br>
                (01) 5859-7467
            </p>
            <p>
                <strong>Email Address: </strong><br>
                <a href="mailto:name@example.com">admin@althealth.co.za
                </a>
            </p>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-8 mb-4">
            <h3>Message the clinic</h3>
            <form>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Full Name:</label>
                        <input type="text" class="form-control" id="name">

                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Phone Number:</label>
                        <input type="tel" class="form-control" id="phone">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email Address:</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Message:</label>
                        <textarea rows="10" cols="100" class="form-control" id="message" maxlength="999" style="resize:none"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Send message</button>
            </form>
        </div>

    </div>

</div>
<?php include 'footer.php'; ?>