<?php

require_once("../app/bootstrap.php");
require_once('../submissions.php');

$credentials = isLoggedIn();
if(($credentials == null && $credentials[0] == null) || $credentials[0] != '' && $credentials[1] == '' || $credentials[2] != "student"){
  redirect($credentials[0],$credentials[1],$credentials[2]);
}
$user_id = $credentials["userId"];
$current_user= $db->GetRow("SELECT * FROM users WHERE users.id = ?",["$user_id"]);
$number = $_GET['n'];

$question =$db->GetRow("SELECT * FROM questions WHERE question_number = ?",["$number"]);

$choice =$db->GetRows("SELECT * FROM options WHERE question_number = ?",["$number"]);

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
    <title>Isuzumabumenyi</title>

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
    <link type="text/css" href="../ssets/css/vendor-ion-rangeslider.rtl.css" rel="stylesheet">


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

   <?php include('header.php'); ?>

        <!-- // END Header -->

       <!-- Header Layout Content -->
<div class="mdk-header-layout__content">

<div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
<div class="mdk-drawer-layout__content page">

    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div>
                <h4 class="m-lg-0">Isuzuma</h4>
                <div class="d-inline-flex align-items-center">
                    <i class="material-icons icon-16pt mr-1 text-muted">school</i> <a href="#" class="text-muted">Soma ikibazo uhitemo igisubizo nyakuri</a>
                </div>
            </div>  
        </div>
    </div>
    <div class="container-fluid page__container">
        <div class="row">

            <div class="col-md-8">
            <div class="alert alert-soft-blue d-flex align-items-center card-margin p-2" role="alert">
            <i class="material-icons mr-3 mt-0">alarm</i>
            <div class="text-body">Usigaranye Iminota <strong class="text-primary"><span id="time">02:00</span></strong> </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="media align-items-center">
                    <div class="media-left">
                        <h4 class="m-1 text-primary mr-2"><strong>#<?php echo $number ?></strong></h4>
                    </div>
                    <div class="media-body">
                        <h4 class="card-title m-0">
                        <?php echo $question['question_text']; ?>
                        </h4>
                    </div>
                </div>
    </div>           
            <div class="card-body">
            <form method="POST" action="../submissions.php">
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
            
					<ul  class="list-group">
                    <?php
             $flag = 0;
                foreach($choice as $choice){
                    $flag++;
                    ?>
            <li class="list-group-item"><input type="radio" class="m-2" name="choice" value="<?php echo $choice['id']; ?>" required><?php echo $choice['coption']; ?></li><br>
						<?php } ?>				
					</ul>

                    <input type="hidden" name="number" value="<?php echo $number; ?>">
					
                    </div>
                </div>             
            </div>          
            <div class="card-footer">
                <!-- <a href="#" class="btn btn-light">Back</a> -->

                    <?php echo $_SESSION['count']+1?> of <span class="text-muted">20</span> 
                
                <button class="btn btn-success float-right" name="next">Ibikurikira <i class="material-icons btn__icon--right">arrow_forward</i></a>
               
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 ">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                <span class="media align-items-center">
                    
                    <span class="media-body">
                    <i class="material-icons mr-3">info</i> Amabwiriza
                    </span>
                </span>
            </a>
            <a href="#" class="list-group-item">
                <span class="media align-items-center">
                    <span class="media-left mr-2">
                        <span class="btn btn-light btn-sm">+</span>
                    </span>
                    <span class="media-body">
                        Isuzuma rimara iminota 20
                    </span>
                </span>
            </a>
            <a href="#" class="list-group-item">
                <span class="media align-items-center">
                    <span class="media-left mr-2">
                        <span class="btn btn-light btn-sm">+</span>
                    </span>
                    <span class="media-body">
                        Isuzuma rifite ibibazo 20
                    </span>
                </span>
            </a>


            <a href="#" class="list-group-item">
                <span class="media align-items-center">
                    <span class="media-left mr-2">
                        <span class="btn btn-light btn-sm">+</span>
                    </span>
                    <span class="media-body">
                        Gutsinda ni amanota 12/20 kuzamura
                    </span>
                </span>
            </a>

        </div>
    </div>
</div>


    </div>


</div>

<script>function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * 0.2,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
    
};
</script>
<!-- // END drawer-layout__content -->

<div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left bg-white" data-perfect-scrollbar>            
            <div class="sidebar-block p-0">

<?php include('sidebar.php');

?>
</div>

</div>
</div>
</div>

    <!-- App Settings FAB -->
   
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