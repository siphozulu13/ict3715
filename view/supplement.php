<?php include 'header.php'; ?>
<!-- Page Content -->
<div class="container">

    <h3 class="my-4">Category: <span style="color:red;"><?php echo $cat; ?></span></h3>
    
    <div id="supplement_cart_msg"></div>

    <div class="row">
        <?php foreach ($sups as $sp): ?>
        <div class="col-lg-4 mb-4">
            <div class="card card-outline-primary h-100">
                <h3 class="card-header bg-primary text-white"><?php echo $sp["supplement_name"]; ?></h3>
                <div class="card-body">
                    <img src="../images/<?php echo $sp["supplement_img"]; ?>" alt="" title="" height="200" width="200"/>
                    <div class="display-4">R<?php echo $sp["supplement_price"]; ?></div> &nbsp; <div class="text-muted">In Stock: <span style="color:red"><?php echo $sp["qty"]; ?></span></div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="#" class="btn btn-primary supplement" product_id="<?php echo $sp["supplement_id"]; ?>" style="float:left;">Add to Cart</a> <a href="?action=supplement-details&id=<?php echo $sp["supplement_id"]; ?>" class="btn btn-warning" style="float:right;">View Details</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <?php endforeach; ?>
        
    </div>

</div>
<!-- /.container -->
<?php include 'footer.php'; ?>