<?php
require('top.php')
?>

<head>
    <style>
        .thankyou-wrapper {
            width: 100%;
            height: auto;
            margin: auto;
            background: #ffffff;
            padding: 10px 0px 50px;
        }

        .thankyou-wrapper h1 {
            font: 100px Arial, Helvetica, sans-serif;
            text-align: center;
            color: #333333;
            padding: 0px 10px 10px;
        }

        .thankyou-wrapper p {
            font: 26px Arial, Helvetica, sans-serif;
            text-align: center;
            color: #333333;
            padding: 5px 10px 10px;
        }

        .thankyou-wrapper a {
            font: 26px Arial, Helvetica, sans-serif;
            text-align: center;
            color: #ffffff;
            display: block;
            text-decoration: none;
            width: 250px;
            background: #E47425;
            margin: 10px auto 0px;
            padding: 15px 20px 15px;
        }

        .thankyou-wrapper a:hover {
            font: 26px Arial, Helvetica, sans-serif;
            text-align: center;
            color: #ffffff;
            display: block;
            text-decoration: none;
            width: 250px;
            background: #F96700;
            margin: 10px auto 0px;
            padding: 15px 20px 15px;
        }
    </style>

</head>

<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Payment Failed</p>
        </div>
    </div>
</div>

<section class="login-main-wrapper">
    <div class="main-container">
        <div class="login-process">
            <div class="login-main-container">
                <div class="thankyou-wrapper">
                    <p>Payment Failed</p>
                    <a href="index.php">Back to home</a>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <div class="clr"></div>
    </div>
</section>

<?php
require('footer.php')
?>