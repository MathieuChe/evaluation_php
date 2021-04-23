<?php

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
                                    if ($data['security']) {
                                        echo $data['security']['user']->getFirstName();
                                    }
                                    ?> !</h4>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="/home">Home</a></li>
                    <br>
                    <li class="active"><a href="/myProducts">My Products</a></li>
                    <br><br><br><br>
                    <li><a href="/logout" style="font-weight: bold">Deconnexion</a></li>
                </ul><br>
            </div>
            <div class="col-sm-9">
                <div class="card" style="width: 400px">
                    <div class="card-header">
                        <div class="row">
                            <div>
                                <form action="/myProducts" method="post">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="name" name="eCommerce[Product][name]" placeholder="Tomato">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Product Price</label>
                                        <input type="text" class="form-control" id="price" name="eCommerce[Product][price]" placeholder="2,50">
                                    </div>
                                    <br><br>
                                    <button type="submit" class="btn btn-success">Add a new product</button>
                                    <br><br>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <br><br>
                <h4><small>RECENT PRODUCT</small></h4>
                <hr>
                <?php foreach ($data['products'] as $product) : ?> <div class="card" style="width: 18rem; margin: 10px">
                        <div class="card-body">
                            <form action="/update_product?id=<?= $product['id'] ?>" method="post">
                                <h2 class="card-title"><input type="text" class="form-control" id="name" name="eCommerce[Product][name]" value=<?= $product['name'] ?>></h2>
                                <h3 class="card-text"><input type="text" class="form-control" id="price" name="eCommerce[Product][price]" value=<?= $product['price'] . " €" ?>></h3>
                                <h5><span class="label label-danger">Food</span></h5><br>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form action="/delete_product?id=<?= $product['id'] ?>" method="post">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
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