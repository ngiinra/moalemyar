<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <title>مشاهده آیین نامه انضباطی</title>
</head>
<body dir="rtl">
   <a href="userspanel.php" class="page-link bazgasht">بازگشت به صفحه کاربری</a>
   <div class="container" >
       <p>
           بسم الله الرحمن الرحیم <br>
           دانش آموزان عزیز در جدول زیر قوانین و مقررات و همچنین نمرات اضافه نوشته شده است. حتما به این جدول توجه کنید .
       </p><br>
       <table class="table table-secondary">
           <thead>
           <tr>
               <td>ردیف</td>
               <td>عنوان امتیاز</td>
               <td>نمره</td>
           </tr>
           </thead>
           <?php
           include '../funcs/connection.php';
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
    </tr>
';
               $i++;
           }
           ?>
       </table>
   </div>
</body>
</html>
