<?php
        session_start();ob_start();
        $_SESSION['page_id']="addlesson.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js"></script>
    <title>تعریف دروس</title>

</head>
<!-- ===========================FORM ======================-->
<body dir="rtl">
<a href="userspanel.php" class="page-link bazgasht">بازگشت به صفحه کاربری</a>
<div class="alert alert-dark" id="alarm"><b></b></div>
<hr>
<div class="row">

    <div class="container-fluid">
        <form action="" method="post" id="frm" class="form-group">
            <label>نام درس</label>:<input type="text" id="dokme" class="form-control" name="lname">
            <label>نوع درس</label>:
            <select class="form-control custom-select" name="type">
                <option value="0">عمومی</option>
                <option value="1">مهارتی</option>
            </select>
            <label>پایه تحصیلی</label>:
            <select name="base" class="form-control custom-select">
                <?php
                include '../funcs/connection.php';
                $sql_base = "select * from tblbase";
                $sql_base_pre = $db->prepare($sql_base);
                $sql_base_pre->execute();
                while ($row_base = $sql_base_pre->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row_base['base_id'] . '">' . $row_base['base_name'] . '</option>';
                }
                ?>
            </select>
            <label>رشته تحصیلی</label>:
            <select name="course" class="form-control custom-select">
                <?php
                include '../funcs/connection.php';
                $sql_course = "select * from tblcourse";
                $sql_course_pre = $db->prepare($sql_course);
                $sql_course_pre->execute();
                while ($row_course = $sql_course_pre->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row_course['course_id'] . '">' . $row_course['course_name'] . '</option>';
                }
                ?>
            </select>
            <label>نام معلم</label>
            :<select class="form-control custom-select" name="teacher">
                <?php
                include '../funcs/connection.php';
                $sql_tea = "select * from tblteacher";
                $sql_tea_pre = $db->prepare($sql_tea);
                $sql_tea_pre->execute();
                while ($row_tea = $sql_tea_pre->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row_tea['teacher_id'] . '">' . $row_tea['tname'] . ' ' . $row_tea['tfamily'] . '</option>';
                }
                ?>
            </select>
            <input type="submit" value="افزودن" name="lesson_sub" id="sub" class="btn btn-success form-control">
        </form>
    </div>
</div>
<!-- ========================= php ======================== -->
<?php

if (isset($_POST['lesson_sub'])) {

    $lname = htmlspecialchars($_POST['lname']);
    $base_id = $_POST['base'];
    $type = $_POST['type'];
    $course = $_POST['course'];
    $tea = $_POST['teacher'];

    include '../funcs/connection.php';
    if (strlen(trim($lname)) != 0) {
        $sql_lesson = "INSERT INTO `tbllesson` (`lesson_id`, `lname`, `type`, `course_id`, `base_id`, `teacher_id`) VALUES (NULL, '$lname', '$type', '$course', '$base_id', '$tea');";
        $sql_lesson_pre = $db->prepare($sql_lesson);
        $sql_lesson_pre->execute();
        echo '
      <script>
          var m="با موفقیت ثبت شد";
          $.post(
              "../funcs/alarm.php",{msg:m},function(data) {
                $("#alarm").html(data);
              }
          );
      </script>
    ';
    }//end if strlen
    else {
        echo '
      <script>
          var m="فیلد خالی را پر کنید";
          $.post(
              "../funcs/alarm.php",{msg:m},function(data) {
                $("#alarm").html(data);
              }
          );
      </script>
    ';
    }// end else strlen
}

?>
<!-- ========================================table============================== -->

<table class="table table-dark">
    <thead>
    <tr>
        <td>ردیف</td>
        <td>نام درس</td>
        <td>نوع درس</td>
        <td>رشته تحصیلی</td>
        <td>پایه تحصیلی</td>
        <td>نام معلم</td>
        <td>ویرایش</td>
        <td>حذف</td>
    </tr>
    </thead>
    <?php
    include '../funcs/connection.php';
    $sql_l = "SELECT * FROM `tbllesson`";
    $sql_l_pre = $db->prepare($sql_l);
    $sql_l_pre->execute();
    $w = 1;
    while ($rowl = $sql_l_pre->fetch(PDO::FETCH_ASSOC)) {
        echo '
        <tr>
        <td>' . $w . '</td>
        <td>' . $rowl['lname'] . '</td>';
        if ($rowl['type'] == 0) {
            echo '
                               <td>عمومی</td>
                                ';
        } else {
            echo '
                               <td>مهارتی</td>
                                 ';
        }
        $sql_select_course = "SELECT * FROM tblcourse where course_id=" . $rowl['course_id'];
        $sql_select_course_pre = $db->prepare($sql_select_course);
        $sql_select_course_pre->execute();
        $rowlc = $sql_select_course_pre->fetch(PDO::FETCH_ASSOC);
        echo '
                 <td>' . $rowlc['course_name'] . '</td>
                ';
        $sql_select_base = "SELECT * FROM tblbase where base_id=" . $rowl['base_id'];
        $sql_select_base_pre = $db->prepare($sql_select_base);
        $sql_select_base_pre->execute();
        $rowlb = $sql_select_base_pre->fetch(PDO::FETCH_ASSOC);
        echo '
                  <td>' . $rowlb['base_name'] . '</td>
                ';
        $sql_select_tea = "SELECT * FROM tblteacher where teacher_id=" . $rowl['teacher_id'];
        $sql_select_tea_pre = $db->prepare($sql_select_tea);
        $sql_select_tea_pre->execute();
        $rowlt = $sql_select_tea_pre->fetch(PDO::FETCH_ASSOC);
        echo '
                 <td>' . $rowlt['tname'] . ' ' . $rowlt['tfamily'] . '</td>
                ';
        echo '
        <td><a href="edit.php?id='.$rowl['lesson_id'].'" ><img src="../img/icons/pencil.png"></a></td>
        <td><a href="del.php?id='.$rowl['lesson_id'].'" ><img src="../img/icons/garbage.png"></a></td>
        </tr>';
        $w++;
    }
    ?>

</table>
</div>
</body>
</html>
