<?php
?>
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
     <form class="form-group" id="frm" method="post" action="">
         <label>نام درس</label>:<select name="lesson_name" id="dokme" class="form-control custom-select">
             <?php
             include '../funcs/connection.php';
             $select_lesson="SELECT * FROM tbllesson ";
             $select_lesson_pre=$db->prepare($select_lesson);
             $select_lesson_pre->execute();
             while($fetch_lesson=$select_lesson_pre->fetch(PDO::FETCH_ASSOC)){
                 echo'<option value="'.$fetch_lesson['lesson_id'].'">'.$fetch_lesson['lname'].'</option>';
             }
             ?>
         </select>
         <input type="submit" value="مشاهده نمرات" class="btn btn-danger form-control" name="lesson_submit">
     </form>
 </div>
</body>
</html>
