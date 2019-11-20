<?php include 'header.php'; ?>
<!-- Page Content -->
<div class="container">

    <h3 class="my-4">Consultation Details</h3>

    <div class="row">
        <?php foreach ($consultation as $con): ?>
        <div class="col-lg-12 mb-4">
            <div class="card card-outline-primary h-100">
                <h3 class="card-header bg-primary text-white"><?php echo $con["consultation_name"]; ?></h3>
                <div class="card-body">
                    <!--<img src="#" alt="" title="" height="200" width="200"/>-->
                    <div class="display-4">R<?php echo $con["consultation_price"]; ?>.00</div> &nbsp; 
                    <div>
                        <strong>Description:</strong><br><br>
                        <?php echo $con["consultation_desc"]; ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>
<!-- /.container -->
<?php include 'footer.php'; ?>