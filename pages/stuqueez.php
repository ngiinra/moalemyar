
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مشاهده نمرات</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
</head>
<body dir="rtl">
<a href="userspanel.php" class="page-link bazgasht" > بازگشت به صفحه کاربری </a>
<div class="container">
<?php
   include '../funcs/connection.php';

   echo " <table class='table table-secondary'>
           <thead>
           <tr>
               <td>ردیف</td>
               <td>درس</td>
               <td>دانلود فایل</td>
           </tr>
           </thead>
";
           $i = 1;
           $file_select="SELECT * FROM `tblfile` ";
           $file_select_pre= $db ->prepare($file_select);
           $file_select_pre->execute();
           while($row =$file_select_pre->fetch(PDO::FETCH_ASSOC)){
               echo '
         <tr>
         <td>'.$i.'</td>
         ';
               $select_lesson="SELECT * FROM `tbllesson` WHERE lesson_id=".$row['lesson_id'];
               $select_lesson_pre=$db ->prepare($select_lesson);
               $select_lesson_pre->execute();
               $fetch_lesson=$select_lesson_pre->fetch(PDO::FETCH_ASSOC);
               echo '
         <td>'.$fetch_lesson['lname'].'</td>
         <td><a href="../files/' . $row['file_address'] . ' ">' . $row['file_address'] . ' </a></td>
         </tr>
           ';
               $i++;
           }
?>
</table>
</div>
</body>
</html>
