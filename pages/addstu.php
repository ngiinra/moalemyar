<?php
  ob_start();
  session_start();
$_SESSION['page_id']="addstu.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js"></script>
    <title>افزودن دانش آموزان</title>
</head>
<!-- ======================================= form =====================================-->
<body dir="rtl">
<a href="userspanel.php" class="page-link bazgasht" >بازگشت به صفحه کاربری</a>
<div class="alert alert-dark" id="alarm"><b></b></div>
<hr>
<div class="row">
    <div class="container-fluid" >
        <form action="" method="post" id="frm" class="form-group">
            <input type="hidden" id="get_class" name="get_class">
            <label>نام هنرجو</label>:<input type="text" id="dokme" class="form-control" name="stu_name">
            <label>نام خانوادگی هنرجو</label>:<input type="text" id="dokme" class="form-control" name="stu_family">
            <label>نام کلاس</label>
            :<select name="classes" id="dokme" class="form-control custom-select">
                <!-- ====================== select php ============================== -->
                <?php
                include '../funcs/connection.php';
                $sql_s = "SELECT * FROM `tblclass`";
                $sql_spre = $db->prepare($sql_s);
                $sql_spre->execute();
                while ($row = $sql_spre->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option class="class_id"  id="' . $row['class_id'] . '">
                 ' . $row['class_id'] . '
                 </option>';
                }//end while
                ?>
                <!-- ======================end select php ============================== -->
            </select>
            <label>موبایل والدین</label>:<input type="number" name="stu_mobile" id="dokme" class="form-control">
            <input type="submit" value="افزودن" name="sub_stu" id="sub" class="btn btn-secondary form-control">
        </form>
    </div> <!-- container -->
</div><!-- row div -->
<!-- =================================================== table =========================== -->
<table class="table table-dark" dir="rtl">
    <thead>
    <tr>
        <td>ردیف</td>
        <td>نام</td>
        <td>نام خانوادگی</td>
        <td>نام کلاس</td>
        <td>امتیازات کسب شده</td>
        <td>موبایل والدین</td>
        <td>ویرایش</td>
        <td>حذف</td>
    </tr>
    </thead>
    <!-- ====================== table php ========================= -->
    <?php
    include '../funcs/connection.php';
    $sql_select = "select * from tblstudent";
    $sql_select_pre = $db->prepare($sql_select);
    $sql_select_pre->execute();

    $i = 1;
    while ($row = $sql_select_pre->fetch(PDO::FETCH_ASSOC)) {

        echo ' <tr>
       <td>'.$i.'</td>
        <td>'.$row['sname'].'</td>
        <td>'.$row['sfamily'].'</td>
        <td>'.$row['class_id'].'</td>
        <td>'.$row['state_id'].'</td>
        <td>'.$row['mobile'].'</td>
        <td><a href="edit.php?id='.$row['student_id'].'"><img src="../img/icons/pencil.png"></a></td>
        <td><a href="del.php?id='.$row['student_id'].'"><img src="../img/icons/garbage.png"></a></td>
          </tr>';
        $i++;}
    ?>
</table>
</body>
</html>
<!-- =============================================== php =============================== -->
<?php
if (isset ($_POST['sub_stu'])) {
    $stu_name = htmlspecialchars($_POST['stu_name']);
    $stu_family = htmlspecialchars($_POST['stu_family']);
    $stu_mobile = htmlspecialchars($_POST['stu_mobile']);
    $stu_class=$_POST['get_class'];
    include '../funcs/connection.php';
    if (strlen(trim($stu_name))!=0 && strlen(trim($stu_family))!=0
        && strlen(trim($stu_mobile))!=0 && strlen(trim($stu_class))!=0){
        $sql_insert="INSERT INTO `tblstudent` (`student_id`,`sname`,`sfamily`,`class_id`,`state_id`,`mobile`)
                      VALUES (NULL,'$stu_name','$stu_family','$stu_class','0','$stu_mobile')";
        $sql_insert_pre=$db->prepare($sql_insert);
        $sql_insert_pre->execute();


        $sql_insert_user="INSERT INTO `tbluser` (`user_id`, `fname`, `lname`, `username`, `password`, 
            `type`, `mobile`) VALUES (NULL, '$stu_name', '$stu_family', 'student', '$stu_mobile', '3','$stu_mobile')";
        $sql_insert_user_pre=$db->prepare($sql_insert_user);
        $sql_insert_user_pre->execute();

        $sql_select_user="select * from tbluser where mobile='$stu_mobile'";
        $sql_select_user_pre=$db->prepare($sql_select_user);
        $sql_select_user_pre->execute();
        $row_user=$sql_select_user_pre->fetch(PDO::FETCH_ASSOC);
        $user_id=$row_user['user_id'];


        $sql_able="INSERT INTO `tblpanel` (`pan_id`,`user_id`,`op_id`,`show_id`)
                      VALUES (NULL,'$user_id','14','1'),(NULL,'$user_id','15','1'),(NULL,'$user_id','16','1')";
        $sql_able_pre=$db->prepare($sql_able);
        $sql_able_pre->execute();




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
<!-- ==================================== jQuery +++++++++++++++++++++++++++++ -->
<script src="../js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $(".class_id").click(function () {
            var myclass=$(this).attr('id');
            document.getElementById("get_class").value=myclass;
        });
    });
</script>