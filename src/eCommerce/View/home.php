<?php

use eCommerce\Repository\ProductManager;
use Simplex\Service\Hydrator;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {
            height: auto;
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav">
                <h4> Welcome back <?php
                                    if (isset($data['security']) && isset($data['security']['user'])) {
                                        echo $data['security']['user']->getFirstName();
                                    }
                                    ?> !</h4>
                <a href="/profil" class="btn btn-success"> Update my profil </a>
                <br><br>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="/home">Home</a></li>
                    <br>
                    <li><a href="/myProducts/list">My Products</a></li>
                    <br><br><br><br>
                    <li><a href="/logout" style="font-weight: bold">Deconnexion</a></li>
                </ul><br>
            </div>
            <div class="col-sm-9">
                <h4><small>RECENT PRODUCT</small></h4>
                <hr>
                <h2>
                    <?php foreach ($data['products'] as $product) : ?> <div class="card" style="width: 18rem; margin: 10px">
                            <div class="card-body">
                                <h2 class="card-title"><?= $product['name'] ?></h2>
                                <h3 class="card-text"><?= $product['price'] . " €" ?></h3>
                                <a href="#" class="btn btn-primary">Voir la fiche</a>
                                <a href="#" class="btn btn-primary">Buy me</a>
                                <h5><span class="label label-danger">Food</span></h5><br>
                                <?php if (isset($_SESSION['security']) && $_SESSION['security']['isLoggedIn']) : ?> <?php if ($_SESSION['security']['user']->getId() === $product["user_id"]) : ?> <a href="/product/edit/<?= $product['id'] ?>" class="btn btn-info"><span class="bi-pencil"></span></a>
                                    <?php endif ?> <?php endif ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <br><br>
            </div>
        </div>
</body>

</html>