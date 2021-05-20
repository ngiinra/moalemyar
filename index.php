<?php
ob_start();
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>معلم یار</title>
    <link rel="shortcut icon" href="img/favicon(1).ico" title="Favicon"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap4rtl.css">

    <link rel="stylesheet" href="css/custom.css">

</head>
<body dir="rtl">
<nav class="navbar navbar-expand-lg navbar-dark sarlist ">
    <a class="navbar-brand" href="" style="color: indianred">معلم یار</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link">صفحه اصلی <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/enteruser.php">ورود</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">درباره ما</a>
            </li>
        </ul>
    </div>
</nav>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <ul class="list-group " id="myalign">
                <li class="list-group-item"><a href="pages/enteruser.php" class="tag">کارنامه</a></li>
            </ul>
            <ul class="list-group " id="myalign" style="margin-top: 10px">
                <li class="list-group-item sarlist" >لینک های مفید :</li>
                <li class="list-group-item"><a href="https://www.faradars.org/" class="tag" target="_blank">فرادرس</a></li>
                <li class="list-group-item"><a href="http://old.roshd.ir/" class="tag" target="_blank">سایت آموزشی رشد</a></li>
                <li class="list-group-item"><a href="http://www.kanoon.ir/" class="tag" target="_blank">کانون فرهنگی آموزش</a></li>
            </ul>
        </div> <!-- end div col md 3 -->
        <div class="col-md-9 col-xs-12">
            <div class="bd-example">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/slider/1.jpg" class="d-block w-100" alt="..." id="ax">
                            <div class="carousel-caption d-none d-md-block">

                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/slider/2.jpg" class="d-block w-100" alt="..." id="ax">
                            <div class="carousel-caption d-none d-md-block"></div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/slider/3.jpg" class="d-block w-100" alt="..." id="ax">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>خبر سوم</h5>
                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>

<?php
include 'funcs/connection.php';
$sql = "SELECT * FROM `tblnews` WHERE `accept`='1'";
$sql_pre = $db->prepare($sql);
$sql_pre->execute();

while ($row = $sql_pre->fetch(PDO::FETCH_ASSOC)) {
    $user = $row['user_id'];
    $sql2 = "SELECT * FROM `tbluser` WHERE `user_id`='$user'";
    $sql2_pre = $db->prepare($sql2);
    $sql2_pre->execute();
    $row2 = $sql2_pre->fetch(PDO::FETCH_ASSOC);
    echo '
    <div class="row">
       <div class="col-md-3"></div>
       <div class="col-sm-12 col-md-9">
       <div class="panel panel-default" id="rightalign">
             <div class="panel-heading"  >
        <h3 class="panel-title" id="navbar-brand"> ' . $row['title'] . ' </h3>
        </div>
         <div class="panel-body">
         <div class="media">
    ';
    if ($row['pic'] != "") {
        echo '
                       <div style="float: left">
                        <img class="media-object icard" src="img/' . $row['pic'] . '"  >
                       </div>
                      ';
    }
    echo '
              <div class="media-body">
                    <h4 class="media-heading" >'.$row['descript'].'</h4>
                    <h6 class="text-muted">

                        نویسنده خبر : ' . $row2['fname'] . ' ' . $row2['lname'] . ' <br>
                        تاریخ ثبت خبر :' . $row['datee'] . '     
                    </h6>
                </div>
            </div>

        </div><!-- panel-body -->
    </div><!-- panel default -->
</div>
</div> <!-- div row -->           
       <br/>';
}
?>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<div id="foot">طراحی شده توسط نگین رحیمی نژاد
</div>
</body>
</html>