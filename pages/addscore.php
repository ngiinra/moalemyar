<?php
session_start();
ob_start();
?>
<html>
<head>
    <title>صفحه ثبت کاربران</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <title>صفحه اعمال نمرات دانش آموزی</title>
</head>
<body dir="rtl">

<a href="userspanel.php" class="page-link bazgasht">بازگشت به صفحه کاربری</a>
<div class="container">
    <form action="" method="post" class="form-group" id="frm">
        <input type="hidden" id="get_stu" name="stu">
        <label>نام درس</label>:
        <select name="lesson_select" class="form-control custom-select">
            <?php
            include  '../funcs/connection.php';
            $sql_lesson="select * from tbllesson";
            $sql_lesson_pre=$db->prepare($sql_lesson);
            $sql_lesson_pre->execute();
            while ($row_lesson=$sql_lesson_pre->fetch(PDO::FETCH_ASSOC)){
                echo '
                         <option value="'.$row_lesson['lesson_id'].'" class="under_op">'.$row_lesson['lname'].'</option>
                     ';
            }
            ?>
        </select>

        <label>نام کلاس</label>:
        <select name="class_select" class="form-control custom-select">
            <?php
            include  '../funcs/connection.php';
            $sql_class="select * from tblclass";
            $sql_class_pre=$db->prepare($sql_class);
            $sql_class_pre->execute();
            while ($row_class=$sql_class_pre->fetch(PDO::FETCH_ASSOC)){
                echo '
                         <option value="'.$row_class['class_id'].'" class="under_op">'.$row_class['class_id'].'</option>
                     ';
            }
            ?>
        </select>
        <label>تاریخ امتحان</label>:
        <input type="date" class="form-control" name="date">
        <input type="submit" class="btn btn-primary form-control" value="ارسال" name="sub_score"><br><br>
    </form>
</div>


        <?php
        include '../funcs/connection.php';
        if(isset($_POST['sub_score'])){
            echo ' <div class="container">
                   <form method="post" class="form-group" id="frm">
                   <label id="navbar-brand">ثبت نمـرات</label><br>';

            $class_id=$_POST['class_select'];
            $date=htmlspecialchars($_POST['date']);
            $lesson_select=$_POST['lesson_select'];
            $student=$_POST['stu'];

            $sql="select * from tblstudent where class_id='$class_id'";
            $sql_pre=$db->prepare($sql);
            $sql_pre->execute();
            while($row=$sql_pre->fetch(PDO::FETCH_ASSOC)){
                echo '<div class="row">
                        <div class="col-md-6">
                        <label>نام و نام خانوادگی</label>:<label id="'.$row['student_id'].'" class="student">'.$row['sname'].' '.$row['sfamily'].'</label>
                        </div>
                        <div class="col-md-6">
                        <label>نمره</label>:<input type="text" class="form-group" id="dokme" name="score">
                        </div><br>
                       </div>
                        
                      ';
            }
            echo '<input type="submit" class="btn btn-outline-success form-control" value="افزودن" name="sub_end">
                  </form></div>
                  ';
            if (isset($_POST['sub_end'])){
                $score=htmlspecialchars($_POST['score']);

                $sql_lessons="select * from tbllesson where `lname='$lesson_select`";
                $sql_lessons_pre=$db->prepare($sql_lessons);
                $sql_lessons_pre->execute();
                $row_lessons=$sql_lessons_pre->fetch(PDO::FETCH_ASSOC);
                $lesson=$row_lessons['lname'];
                $sql_end="insert into tblscore (`score_id`,`lesson_id`,`student_id`,`student_score`,`date_id`)
                           values (null,'$lesson','$student','$score','$date')";
                $sql_end_pre=$db->prepare($sql_end);
                $sql_end_pre->execute();
            }
        }

        ?>
<script src="../js/jquery.js"></script>
<script>
    $("document").ready(function(){
        $(".student").click(function(){
            var id=$(this).attr('id');
            alert(id);
            document.getElementById("get_stu").value=id;
        });
    });
</script>

