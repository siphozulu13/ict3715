<?php include 'header.php'; ?>
<!-- Page Content -->
<div class="container">

    <h3 class="my-4">Consultation Prices</h3>
    <div class="row">
        <h2 class="lead">NB: Our prices are subjected to change without prior notice.</h2>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-outline-primary h-100">
                <h3 class="card-header bg-primary text-white">Prices</h3>
                <div class="card-body">
                    <div class="mb-4" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php foreach ($prices as $cons): ?>
                        <div class="card">
                            <div class="card-header" role="tab" id="<?php echo $cons["consultation_name"]; ?>">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $cons["consultation_id"]; ?>" aria-expanded="true" aria-controls="<?php echo $cons["consultation_id"]; ?>"><?php echo $cons["consultation_name"]; ?></a>
                                </h5>
                            </div>

                            <div id="<?php echo $cons["consultation_id"]; ?>" class="collapse show" role="tabpanel" aria-labelledby="<?php echo $cons["consultation_name"]; ?>">
                                <div class="card-body">
                                    <strong>R<?php echo $cons["consultation_price"]; ?>.00</strong>
                                </div>
                            </div>
                        </div>
                     <?php endforeach; ?>
                    </div>   
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container -->
<?php include 'footer.php'; ?>