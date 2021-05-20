<?php
session_start();
ob_start();
if (isset($_POST['submit'])) {
    include '../funcs/connection.php';
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $sql_select = "SELECT * FROM `tbluser` WHERE username='$username' and password='$password'";
    $sql_select_pre = $db->prepare($sql_select);
    $sql_select_pre->execute();

    if ($sql_select_pre->rowCount() > 0) {
        header("location:userspanel.php");
        $row = $sql_select_pre->fetch(PDO::FETCH_ASSOC);
        $_SESSION['fullname'] = $row['fname'] . " " . $row['lname'];
        $_SESSION['user_id'] = $row['user_id'];
    } else {

        echo '<script> alert("چنین کاربری وجود ندارد"); </script>';
    }
}
?>
<!-- ======================== ENTER FORM DESIGN ====================== -->
<html>
<head>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap4rtl.css">
    <link href="../css/custom.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <title>ورود به معلم یار</title>
    <style>
        body{padding-top: 20px}
    </style>

</head>
<body dir="rtl">
<!-- =================== picture ============= -->
<div class="container-fluid" >
    <div class="row">
        <div class="col-xl-1 col-md-1 col-xs-12"></div>
        <div class="col-xl-9 col-md-9 col-xs-12" >
            <h1 class="h_3">ورود به معلـم یار</h1>
<!-- ======================== FORM ========================= -->

            <form action="" method="post" id="frm" class="form-group">

                <input type="text" name="username" placeholder="نام کاربری" id="dokme" class="form-control" ><br>
                <input type="password" name="password" placeholder="رمز عبور" id="dokme" class="form-control"><br>

                <input type="submit" name="submit" value="ورود" class="btn btn-secondary form-control" id="sub">
            </form>
        </div>
        <div class="col-xl-1 col-md-1 col-xs-12"></div>
    </div>
</div>
</div>
<div id="foot">طراحی شده توسط نگین رحیمی نژاد
</div>
</body>
</html>


