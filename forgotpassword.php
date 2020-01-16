<?php
include_once 'header.php';


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="res/saurabh.css">
    <title>QRS | QdataEDCLite</title>
</head>

<body>
    <div class="container-fluid">
        <div class="login-wrap">

            <form class="login-form" action="login.php" method="POST">
                <div class="mx-auto" style="width: 200px;">
                    <img class="mb-4" src="res/img/QdataEDCLite.png" alt="" height="72">
                </div>

                <h1 class="pb-4 font-weight-normal">Forgot Password</h1>
                <h4 class="pb-4 font-weight-normal">Please enter registered email address</h4>
                <div class="wrap-input">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" id="inputEmail" name="email" class="ss-input" placeholder="Email address" required autofocus>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Send reset link</button>
                <p class="fixed-bottom-right mx-3 text-muted">&copy; QAscent Research Solutions</p>
            </form>

            <div class="side-photo" style="background-image: url('res/img/bg-3.png')">
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
