<?php $consultations = show_all_consultations(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="ForLife MediHealth Clinic">
        <title>Alt Health</title>
        <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/alt.css" rel="stylesheet">
        <script src="vendor/bootstrap/js/jquery-3.1.1.js" type="text/javascript"></script>
        <script src="vendor/bootstrap/js/website.js" type="text/javascript"></script>
        <script src="vendor/jquery/jquery.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.js"></script>
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand text-white" href="?action=home">
                    <img src="images/al.png" height="30" width="50" alt="Alt Health Image">lt Health
                </a>

                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="?action=about">
                                About
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="?action=contact">
                                Contact
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Consultations
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                                
                                <?php 
                                foreach ($consultations as $cons): ?>
                                <a href="?action=consultation&id=<?php echo $cons["consultation_id"]; ?>" class="dropdown-item"><?php echo $cons["consultation_name"] ?></a>
                                <?php endforeach; ?>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?action=prices">
                                Prices
                            </a>
                        </li>
                        
                        <?php if (!isset($_SESSION["authenticated"])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?action=login">Sign In</a>
                        </li>
                        <?php } ?>
                        
                        <?php if (isset($_SESSION["authenticated"])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Welcome <?php echo $_SESSION["name"]; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                                
                                <a class="dropdown-item" href="?action=profile">Patient Profile</a>
                                <a class="dropdown-item" href="?action=booking">Patient Booking</a>
                                <a class="dropdown-item" href="?action=update">Update Details</a>
                                <a class="dropdown-item" href="?action=logout">Logout</a>
                            </div>
                        </li>
                        
                        <?php } ?>
                        
                        
                        &nbsp; &nbsp;
                        
                        <li class="nav-item">
                            <a href="tel:+2701495050" class="btn btn-primary btn-lg"> Call Now!</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
