<?php

if(!isset($_SESSION) )session_start();
include_once('../../../vendor/autoload.php');
use App\Message\Message;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <title>login | University Management System</title>


    <link rel="stylesheet" href="../../../resources/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="../../../resources/assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="../../../resources/assets/css/font-icons/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../resources/assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../../resources/assets/css/neon-core.css">
    <link rel="stylesheet" href="../../../resources/assets/css/neon-theme.css">
    <link rel="stylesheet" href="../../../resources/assets/css/neon-forms.css">
    <link rel="stylesheet" href="../../../resources/assets/css/custom.css">
    <link rel="stylesheet" href="../../../resources/css/main.css">

    <script src="../../../resources/assets/js/jquery-1.11.3.min.js"></script>

    <!--[if lt IE 9]><script src="../../../resources/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="../../../resources/img/favicon.ico">

</head>
<body class="page-body login-page login-form-fall">

<div class="text-center">

    <?php  if(isset($_SESSION['message']) )if($_SESSION['message']!=""){ ?>

        <div  id="message" class="success text-center msg"   style="font-size: 12px;  " >

            <?php if((array_key_exists('message',$_SESSION)&& (!empty($_SESSION['message'])))) {
                echo "&nbsp;".Message::message();
            }
            Message::message(NULL);
            ?>
        </div>
    <?php } ?>

</div>

<div class="container">
    <div class="row" >
        <div class="col-md-4 col-md-offset-4">

            <div class="panel login-form">
                <div class="col-md-12 center-block">
                    <i class="logo fa fa-university text-center"></i>
                    <h3 class="text-center" style="color: #fff; font-size: 30px;">University Management System</h3>
                </div>
                <div class="panel-title form-title  text-center col-md-12">
                    <div class="panel-title text-center">
                        <h4 style="color: #00b29e; padding: 15px 0; font-size: 15px; font-weight: bold;">Student Login Form</h4>
                    </div>
                </div>
                <div class="panel-body form-body">
                    <form action="./Authentication/login.php" method="post">
                        <div class="form-group log-form">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group log-form">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-blue btn-block">Login</button>
                    </form>
                </div>
                    <a class="link btn btn-primary pull-right" href="../index.php">Back To Home Page</a>

            </div>
        </div>
    </div>
</div>






<!-- Bottom Scripts -->
<script src="../../../resources/assets/js/gsap/jquery.gsap.min.js"></script>
<script src="../../../resources/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="../../../resources/assets/js/bootstrap.js"></script>
<script src="../../../resources/assets/js/joinable.js"></script>
<script src="../../../resources/assets/js/resizeable.js"></script>
<script src="../../../resources/assets/js/neon-api.js"></script>
<script src="../../../resources/assets/js/jquery.validate.min.js"></script>
<script src="../../../resources/assets/js/neon-login.js"></script>
<script src="../../../resources/assets/js/neon-custom.js"></script>
<script src="../../../resources/assets/js/neon-demo.js"></script>
<script>
    $('.msg').fadeIn(6000).delay(3000);
    $('.msg').fadeOut(2000);
</script>
</body>
</html>