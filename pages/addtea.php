<?php
ob_start();
session_start();
$_SESSION['page_id']="addtea.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js"></script>
    <title>افزودن همکاران معلم</title>
</head>
<!-- ======================================= form =====================================-->
<body dir="rtl">
<a href="userspanel.php" class="page-link bazgasht" >بازگشت به صفحه کاربری</a>
<div class="alert alert-dark" id="alarm"><b></b></div>
<hr>
<div class="row">
    <div class="container-fluid" id="div_bala">
        <form action="" method="post" id="frm" class="form-group">
            <label>نام همکار</label>:<input type="text" id="dokme" class="form-control" name="tea_name">
            <label>نام خانوادگی</label>:<input type="text" id="dokme" class="form-control" name="tea_family">
            <label>شماره موبایل همکار</label>:<input type="text" name="tea_mobile" id="dokme" class="form-control">
            <input type="submit" value="افزودن" name="sub_tea" id="sub" class="btn btn-secondary form-control">
        </form>
    </div> <!-- container -->
</div><!-- row div -->

<!-- =============================================== php =============================== -->
<?php
if (isset ($_POST['sub_tea'])) {
    $tea_name = htmlspecialchars($_POST['tea_name']);
    $tea_family = htmlspecialchars($_POST['tea_family']);
    $tea_mobile = htmlspecialchars($_POST['tea_mobile']);
    include '../funcs/connection.php';
    if (strlen(trim($tea_name))!=0 && strlen(trim($tea_family))!=0
        && strlen(trim($tea_mobile))!=0){
        $sql_insert="INSERT INTO `tblteacher` (`teacher_id`,`tname`,`tfamily`,`tmobile`)
                      VALUES (NULL,'$tea_name','$tea_family','$tea_mobile')";
        $sql_insert_pre=$db->prepare($sql_insert);
        $sql_insert_pre->execute();
        $sql_add_user="INSERT INTO `tbluser` (`user_id`, `fname`, `lname`, `username`, `password`, 
            `type`, `mobile`) VALUES (NULL, '$tea_name', '$tea_family', 'teacher', '$tea_mobile', '2','$tea_mobile')";
        $sql_add_user_pre=$db->prepare($sql_add_user);
        $sql_add_user_pre->execute();
        $sql_find_last_teacher="SELECT * FROM `tbluser` ORDER BY DESC";
        $sql_find_last_teacher_pre=$db->prepare($sql_find_last_teacher);
        $sql_find_last_teacher_pre->execute();
        $row_find=$sql_find_last_teacher_pre->fetch(PDO::FETCH_ASSOC);
        $uid=$row_find['user_id'];
        $sql_insert_panel="INSERT INTO `tblpanel` (`pan_id`,`user_id`,`op_id`,`show_id`)
                            VALUES (NULL,'$uid','9','1'),(NULL ,'$uid','10','1')";
        $sql_insert_panel_pre=$db->prepare($sql_insert_panel);
        $sql_insert_panel_pre->execute();
    }//end if strlen
    else{
        echo '
          <script>
              var message="فیلدهای خالی را تکمیل کنید";
              $.post(
                  "../funcs/alarm.php",{msg:message},function(data){
                      $("#alarm").html(data);
                  }
              );
          
          </script>
        
        ';
    }//end else strlen
}
?>
<!-- =====================================table edit ========================== -->
<table dir="rtl" class="table table-dark">
    <thead>
    <tr>
        <th>ردیف</th>
        <th>نام</th>
        <th>نام خانوادگی</th>
        <th>شماره تلفن</th>
        <th>ویرایش</th>
        <th>حذف</th>
    </tr>
    </thead>
    <?php
    include '../funcs/connection.php';
    $sql_select = "select * from tblteacher";
    $sql_select_pre = $db->prepare($sql_select);
    $sql_select_pre->execute();

    $i = 1;
    while ($row = $sql_select_pre->fetch(PDO::FETCH_ASSOC)) {

        echo ' <tr>
       <td>'.$i.'</td>
        <td>'.$row['tname'].'</td>
        <td>'.$row['tfamily'].'</td>
        <td>'.$row['tmobile'].'</td>
        <td><a class="tag" href="edit.php?id='.$row['teacher_id'].'"><img src="../img/icons/pencil.png"></a></td>
        <td><a class="tag" href="del.php?id='.$row['teacher_id'].'"><img src="../img/icons/garbage.png"></a></td>
          </tr>';
        $i++;}
    ?>
</table>

</body>
</html>