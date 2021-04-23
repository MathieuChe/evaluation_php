<?php


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body class="">

    <div class="container">
        <div class="d-flex justify-content-center h-100">

            <div class="card" style="width: 400px">
                <div class="card-header">
                    <h3>
                        <center> Register </center>
                    </h3>
                    <div class="row">
                        <div>
                            <form action="/register" method="post">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="firstName" name="eCommerce[User][firstName]" placeholder="John">
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastName" name="eCommerce[User][lastName]" placeholder="Doe">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="eCommerce[User][email]" placeholder="john@doe.con">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="eCommerce[User][password]" placeholder="Paris">
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">
                                Already have an account? <a href="/login"> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>