<?php
session_start();
ob_start();
$_SESSION['page_id']="insertuser.php";
//if ($_SESSION['x'] == 1) {
if (isset($_POST['submit_user'])) {
    $firstname = htmlspecialchars($_POST['fname']);
    $lastname = htmlspecialchars($_POST['lname']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $noekarbari = htmlspecialchars($_POST['noe_karbari']);
    $mobile = htmlspecialchars($_POST['mobile']);
    if (strlen($firstname) > 0 && strlen($lastname) > 0 && strlen($username) > 0
        && strlen($password) > 0 && strlen($noekarbari) > 0 && strlen($mobile) > 0) {
        include '../funcs/connection.php';
        $sql_insert = "INSERT INTO `tbluser` (`user_id`, `fname`, `lname`, `username`, `password`, 
            `type`, `mobile`) VALUES (NULL, '$firstname', '$lastname', '$username', '$password', '$noekarbari','$mobile');";
        $sql_insert_pre = $db->prepare($sql_insert);
        $sql_insert_pre->execute();

        $sql = "select * from tbluser";
        $sql_pre = $db->prepare($sql);
        $sql_pre->execute();
        $i=0;
        while($row=$sql_pre->fetch(PDO::FETCH_ASSOC)){
            $i=$row['user_id'];
        }
        $sql_panel = "INSERT INTO `tblpanel` (`pan_id`, `user_id`, `op_id`, `show_id`)
                     VALUES (NULL, '$i', '1', '0')";
        $sql_panel_pre = $db->prepare($sql_panel);
        $sql_panel_pre->execute();



    } else {
        echo '<script>alert("فیلد های خالی را پر کنید");</script>';
    }
}
/*} else {
   header("location:enteruser.php");
   $row= $sql_insert_pre ->fetch(PDO::FETCH_ASSOC);
   $_SESSION['fullname']=$row['fname'].$row['lname'];
}*/
?>
<html>
<head>
    <title>صفحه ثبت کاربران</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
</head>
<body dir="rtl">

<a href="userspanel.php" class="page-link bazgasht" > بازگشت به صفحه کاربری </a><hr>
<div class="container">
<form action="" method="post" id="frm">
    <label >نام</label>
    : <input type="text" name="fname" id="dokme" class="form-control" >
    <label >نام خانوادگی</label>
    : <input type="text" name="lname" id="dokme" class="form-control" >
    <label>نام کاربری</label>
    : <input type="text" name="username" id="dokme" class="form-control" placeholder="به حروف انگلیسی">
    <label>رمز عبور</label>
    : <input type="password" name="password" id="dokme" class="form-control" >
    <label>نوع کاربری</label>
    : <select name="noe_karbari" id="dokme" class="form-control custom-select">
        <option value="1">مدیر</option>
        <option value="2">معاون</option>
        <option value="3">دانش آموز</option>
    </select>
    <label>تلفن همراه</label>
    : <input type="number" name="mobile" class="form-control " id="dokme" placeholder="شماره موبایل پدر یا مادر وارد شود">
     <input type="submit" name="submit_user" value="ثبت کاربر" class="btn btn-secondary form-control" id="sub">
</form>
</div>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
<table dir="rtl" class="table table-dark">
    <tr>
        <th>ردیف</th>
        <th>نام</th>
        <th>نام خانوادگی</th>
        <th>نام کاربری</th>
        <th>رمز عبور</th>
        <th>نوع کاربری</th>
        <th>شماره تلفن</th>
        <th>ویرایش</th>
        <th>حذف</th>
    </tr>
<?php
include '../funcs/connection.php';
$sql_select = "select * from tbluser";
$sql_select_pre = $db->prepare($sql_select);
$sql_select_pre->execute();

$i = 1;
while ($row = $sql_select_pre->fetch(PDO::FETCH_ASSOC)) {

    echo ' <tr>
       <td>'.$i.'</td>
        <td>'.$row['fname'].'</td>
        <td>'.$row['lname'].'</td>
        <td>'.$row['username'].'</td>
        <td>'.$row['password'].'</td>
        <td>'.$row['type'].'</td>
        <td>'.$row['mobile'].'</td>
        <td><a  href="edit.php?id='.$row['user_id'].'"><img src="../img/icons/pencil.png"></a></td>
        <td><a  href="del.php?id='.$row['user_id'].'" ><img src="../img/icons/garbage.png"></a></td>
          </tr>';
    $i++;}
?>
</table>
    </div><!-- end row center -->
    <div class="col-md-1"></div>
</div> <!-- end row-->

</body>
</html>