<?php
session_start();
ob_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>پنــل کاربـــری</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../js/jquery.js" rel="stylesheet">
    <link href="../css/bootstrap4rtl.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">


</head>
<body dir="rtl">
<div class="container-fluid dashboard">
    <h3>
        <?php echo $_SESSION['fullname'] . " به پنل خود خوش آمدید."; ?>
    </h3>
</div>
<hr>
<div class="row ">
    <?php
    include '../funcs/connection.php';
    $userid = $_SESSION['user_id'];
    $sql = "select * from tbluser
               join tblpanel on (tblpanel.user_id=tbluser.user_id and tblpanel.user_id='$userid'
               and tblpanel.show_id='1' )
               join tbloptions on (tblpanel.op_id=tbloptions.op_id )";
    $sql_pre = $db->prepare($sql);
    $sql_pre->execute();


    while ($row = $sql_pre->fetch(PDO::FETCH_ASSOC)) {

        echo '<div class="col-md-6 col-xl-6 col-lg-6 col-xs-12" id="div_panel">
                 <a id="panel" class="tag" href=" ' . $row['pages'] . ' ">
                 <img src="../img/icons/' . $row['op_icon'] . '" >
                   ' . $row['title'] . '
                  </a></div>';
    }

    ?>
</div>
<br>
<div class="container-fluid">
    <a class="page-link bazgasht " href="../index.php">خــروج</a>
</div>
</body>
</html>