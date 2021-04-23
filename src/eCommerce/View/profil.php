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

    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image"> </div>
                                    <h6 class="f-w-600"><?php
                                                        if ($data['security']) {
                                                            echo $data['security']['user']->getFirstName();
                                                        }
                                                        ?></h6>
                                </div>
                            </div>
                            <?php

                            if (isset($_GET['success'])) {
                                echo "Success";
                            }
                            ?>
                            <div class="col-sm-8">
                                <form action="/profil" method="post">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="firstName" class="form-label">First name</label>
                                                <input type="text" class="form-control" id="firstName" name="eCommerce[User][firstName]" value=<?php
                                                                                                                                                if ($data['security']) {
                                                                                                                                                    echo $data['security']['user']->getFirstName();
                                                                                                                                                }
                                                                                                                                                ?>>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="lastName" class="form-label">Last name</label>
                                                <input type="text" class="form-control" id="lastName" name="eCommerce[User][lastName]" value=<?php
                                                                                                                                                if ($data['security']) {
                                                                                                                                                    echo $data['security']['user']->getLastName();
                                                                                                                                                }
                                                                                                                                                ?>>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="email" name="eCommerce[User][email]" value=<?php
                                                                                                                                        if ($data['security']) {
                                                                                                                                            echo $data['security']['user']->getEmail();
                                                                                                                                        }
                                                                                                                                        ?>>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600"><b> Number of Products</b></p>
                                                <h6 class="text-muted f-w-400">5</h6>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-sm-4">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </div>
                                </form>
                                <form action="/delete_profile" method="post">
                                    <div class="col-sm-4">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </div>
                                </form>
                                <div class="col-sm-4">
                                    <a href="/home" class="btn btn-success"> Cancel </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>