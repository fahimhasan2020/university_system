<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--bootstrap css-->
        <link rel="stylesheet" href="../../resources/template/css/bootstrap.min.css">
        <!--font awesome -->
        <link rel="stylesheet" href="../../resources/template/css/font-awesome.min.css">
        <!-- main style -->
        <link rel="stylesheet" href="../../resources/template/css/main.css">

    </head>


    <body>

    <!--header section-->
    <section id="about_header">

        <?php include "navbar.php" ?>

    </section>

    <!-- admission -->

    <div class="admission-area page-content-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="admission-form-wrapper" id="form-print">
                        <div class="row">
                            <div class="col">
                                <div class="form-head clearfix">
                                    <div class="school-info pull-left w-50 col-md-10">
                                        <h2>University</h2>
                                        <p>4333 Factoria Blvd SE, Bellevue, WA 98006</p>
                                        <p>+1327252638</p>
                                        <h3 class="">Admission Form</h3>
                                    </div>
                                    <div class="student-img-wrapper text-center pull-left w-50 col-md-2">
                                        <div class="student-img">
                                            <p>Student Photo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-body">
                                    <div class="block-title text-center">
                                        <h4>Student Information</h4>
                                    </div>
                                    <div class="clearfix s-row"> <div class="input-title">Student Name :</div> <div class="form-field"></div> </div>
                                    <div class="clearfix s-row"> <div class="input-title">Home Address :</div> <div class="form-field"></div> </div>
                                    <div class="clearfix s-row">
                                        <div class="clearfix w-50 pull-left p-r-10">
                                            <div class="input-title">Gender :</div> <div class="form-field"></div>
                                        </div>
                                        <div class="clearfix w-50  pull-left">
                                            <div class="input-title">Birthday :</div> <div class="form-field"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix s-row">
                                        <div class="clearfix w-50 pull-left p-r-10">
                                            <div class="input-title">Father Name :</div> <div class="form-field"></div>
                                        </div>
                                        <div class="clearfix w-50  pull-left">
                                            <div class="input-title">Mobile Num :</div> <div class="form-field"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix s-row">
                                        <div class="clearfix w-50 pull-left p-r-10">
                                            <div class="input-title">Mother Name :</div> <div class="form-field"></div>
                                        </div>
                                        <div class="clearfix w-50  pull-left">
                                            <div class="input-title">Mobile Num :</div> <div class="form-field"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix s-row">
                                        <div class="clearfix w-50 pull-left p-r-10">
                                            <div class="input-title">Religion :</div> <div class="form-field"></div>
                                        </div>
                                        <div class="clearfix w-50  pull-left">
                                            <div class="input-title">Nationality :</div> <div class="form-field"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix s-row"> <div class="input-title">Educational Background :</div> <div class="form-field"></div> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="print-btn text-center">
                        <button type="button" class="btn btn-dark" onclick="printDiv('form-print')">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- footer -->
    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xl-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="footer_top_left">
                        <p>halyh 123/sdd <span><i class="fa fa-map-marker"></i></span> </p>
                        <p>halyh 123/sdd <span><i class="fa fa-phone"></i></span> </p>
                        <p>halyh 123/sdd <span><i class="fa fa-address-card"></i></span> </p>
                        <p>halyh 123/sdd <span><i class="fa fa-user"></i></span> </p>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="footer_top_left">
                        <p>halyh 123/sdd <span><i class="fa fa-map-marker"></i></span> </p>
                        <p>halyh 123/sdd <span><i class="fa fa-phone"></i></span> </p>
                        <p>halyh 123/sdd <span><i class="fa fa-address-card"></i></span> </p>
                        <p>halyh 123/sdd <span><i class="fa fa-user"></i></span> </p>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="footer_top_left">
                        <p>Privacy Policy</p>
                        <p>Terms And Condition</p>
                        <p>Contact Us</p>
                        <p>LogIn</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="footer_bottom">
        <div class="container-fluid">
            <div class="row footer_bottom">
                <div class="">
                    <p>All Rights Reserved</p>
                </div>
            </div>
        </div>
    </section>

    <?php include "member.php";?>

        <!-- jquery link -->
        <script src="../../resources/js/vendor/jquery-3.2.1.min.js"></script>
        <!--bootstrap js-->
        <script src="../../resources/js/bootstrap.min.js"></script>
        <!-- main js -->
        <script src="../../resources/js/main.js"></script>
    </body>
</html>
