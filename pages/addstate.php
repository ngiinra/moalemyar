<?php
ob_start();
session_start();
$_SESSION['page_id']="addstate.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap4rtl.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js"></script>
    <title>تعریـف امتیـارات دانش آمـوزی</title>
</head>
<body dir="rtl">
<a href="userspanel.php" class="page-link bazgasht">بازگشت به صفحه کاربری</a>
<div class="alert alert-dark" id="alarm"><b></b></div>
<hr>
<!-- ============================ FORM DESIGN ======================= -->
<div class="container-fluid">
    <h3 class="h_3">تعریـف امتیـازات دانـش آموزی</h3>
    <h5 id="rightalign"><span class="h_5_sabz">قانون را به همراه امتیاز مثبت یا منفی بنویسید</span></h5>
    <form class="form-group" id="frm" method="post">

        <label>عنوان امتیــاز</label>
        :<input type="text" class="form-control" name="descript">
        <label>مقـدار نمـره </label>
        :<input type="text" class="form-control" name="state" placeholder="همراه با علامت + یا -">
        <input type="submit" class="btn btn-success form-control" name="sub_addstate" value="افــزودن">
    </form>
</div>

<!-- =============================== FORM PHP ========================= -->
<?php
include '../funcs/connection.php';
if (isset ($_POST['sub_addstate'])) {
    $descript = htmlspecialchars($_POST['descript']);
    $state = htmlspecialchars($_POST['state']);
    $sql_s = "SELECT * FROM tblstate WHERE `state_description`=trim('$descript')";
    $sql_spre = $db->prepare($sql_s);
    $sql_spre->execute();

    if ($row = $sql_spre->fetch(PDO::FETCH_ASSOC) == 0) {
        if (strlen(trim($descript)) != 0 && strlen(trim($state)) != 0) {
            $sql_insert = "INSERT INTO `tblstate` (`state_id`,`state_description`,`state_grade`)
                      VALUES (NULL,'$descript','$state')";
            $sql_insert_pre = $db->prepare($sql_insert);
            $sql_insert_pre->execute();
            echo '
          
          <script>
              var message="امتیاز مورد نظر با موفقیت ثبت شد";
              $.post(
                  "../funcs/alarm.php",{msg:message},function(data){
                      $("#alarm").html(data);
                  }
              );
          
          </script>
        
        ';
        }//end if strlen
        else {
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
    } else {
        echo '
          
          <script>
              var message="این امتیـاز از قبـل موجـود بود";
              $.post(
                  "../funcs/alarm.php",{msg:message},function(data){
                      $("#alarm").html(data);
                  }
              );
          
          </script>
        
        ';
    }
}

// ========================================= TABLE ========================== ====
echo '<table class="table table-dark" >
    <thead>
    <tr>
        <td>ردیف</td>
        <td>عنوان امتیاز</td>
        <td>نمره</td>
        <td>ویرایش</td>
        <td>حذف</td>
    </tr>
    </thead>
    <tbody>
    ';
$i = 1;
$sql_s = "SELECT * FROM tblstate";
$sql_spre = $db->prepare($sql_s);
$sql_spre->execute();
while ($row = $sql_spre->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <tr>
         <td>'.$i.'</td>
         <td>' . $row['state_description'] . '</td>
         <td>' . $row['state_grade'] . '</td>
         <td><a href="edit.php?id='.$row['state_id'].'" ><img src="../img/icons/pencil.png"></a></td>
         <td><a href="del.php?id='.$row['state_id'].'" ><img src="../img/icons/garbage.png"></a></td>
    </tr>
';
    $i++;
}
?>
</tbody>


</table>
</body>
</html>


