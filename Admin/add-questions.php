<?php

require_once("../app/bootstrap.php");

$credentials = isLoggedIn();
if(($credentials == null && $credentials[0] == null) || $credentials[0] != '' && $credentials[1] == '' || $credentials[2] != "student"){
  redirect($credentials[0],$credentials[1],$credentials[2]);
}
$user_id = $credentials["userId"];

$current_user= $db->GetRow("SELECT * FROM users WHERE users.id = ?",["$user_id"]);
$questions = $db->GetRow("SELECT * FROM questions");
$total= $db->Getsum("SELECT COUNT(question_number) FROM questions");
$next = $total+1;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Question</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="../assets/vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="../assets/css/app.css" rel="stylesheet">
    <link type="text/css" href="../assets/css/app.rtl.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="../assets/css/vendor-material-icons.css" rel="stylesheet">
    <link type="text/css" href="../assets/css/vendor-material-icons.rtl.css" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="../assets/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="../assets/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">

    <!-- ion Range Slider -->
    <link type="text/css" href="../assets/css/vendor-ion-rangeslider.css" rel="stylesheet">
    <link type="text/css" href="../assets/css/vendor-ion-rangeslider.rtl.css" rel="stylesheet">


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115115077-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-115115077-3');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            '../connect.facebook.net/en_US/fbevents.js');
        fbq('init', '257843818545228');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=257843818545228&amp;ev=PageView&amp;noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body class="layout-default">


<!-- Header Layout -->
<div class="mdk-header-layout js-mdk-header-layout">

<!-- Header -->

<?php include("header.php"); 

?>
<!-- // END Header -->

<!-- Header Layout Content -->
<div class="mdk-header-layout__content">

<div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
    <div class="mdk-drawer-layout__content page">



        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                <h4 class="m-lg-0">Add Question</h4>
              
                
        </div>
    </div>



<div class="container-fluid page__container">
    <div class="row">
        <div class="col-md-8">
 
            <div class="mb-3">
            <form action="../submissions.php" method="post">
            
            <label for="exampleFormControlTextarea1" class="form-label btn btn-primary">Add Question</label> <input type="number" name="question_number" class="btn btn-success mb-2 ml-2" value="<?php echo $next ?>">
   
            <textarea class="form-control" id="exampleFormControlTextarea1" name="question_text" rows="3" placeholder = "Enter question" required></textarea>
            </div>
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Choice 1</label>
            <input type="text" class="form-control" id="exampleFormControlInput1"name="choice1"  placeholder="Enter Choice 1" required>
            </div>

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Choice 2</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="choice2" placeholder="Enter Choice 2" required>
            </div>

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Choice 3</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="choice3" placeholder="Enter Choice 3" required>
            </div>

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Choice 4</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="choice4" placeholder="Enter Choice 4" required>
            </div>
    
       </div>
        <div class="col-md-4">
        <div class="mb-3">
            
            <label for="exampleFormControlInput1" class="form-label">Correct Answer</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="correct_choice" placeholder="Enter Correct number" required>
            </div>
            
            </div>
     </div>
     <form>
     <button class="btn btn-primary" type="submit" name="save" >Save</button>
  </div>
</div>
    <!-- // END drawer-layout__content -->

    <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
        <div class="mdk-drawer__content">
            <div class="sidebar sidebar-light sidebar-left bg-white" data-perfect-scrollbar>


                
            <div class="sidebar-block p-0">
                    
            <?php include("sidebar.php"); 

            ?>


                

            </div>
        </div>
    </div>
</div>
<!-- // END drawer-layout -->

</div>
<!-- // END header-layout__content -->

</div>
<!-- // END header-layout -->





    <!-- jQuery -->
    <script src="../assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="../assets/vendor/popper.min.js"></script>
    <script src="../assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="../assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="../assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="../assets/vendor/material-design-kit.js"></script>

    <!-- Range Slider -->
    <script src="../assets/vendor/ion.rangeSlider.min.js"></script>
    <script src="../assets/js/ion-rangeslider.js"></script>

    <!-- App -->
    <script src="../assets/js/toggle-check-all.js"></script>
    <script src="../assets/js/check-selected-row.js"></script>
    <script src="../assets/js/dropdown.js"></script>
    <script src="../assets/js/sidebar-mini.js"></script>
    <script src="../assets/js/app.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="../assets/js/app-settings.js"></script>
</body>



</html>