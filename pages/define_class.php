
<?php
ob_start();
session_start();
$_SESSION['page_id']="define_class.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js"></script>
    <title>کلاس بندی ها</title>

</head>

<body dir="rtl">
<a href="userspanel.php" class="page-link bazgasht">بازگشت به صفحه کاربری</a>
<div class="alert alert-dark" id="alarm"><b></b></div>
<ul id="rightalign">
    <li><a class="tag" href="#a">افزودن پایـه تحصیـلی</a></li>
    <li><a class="tag" href="#b">افزودن رشـته تحصیـلی</a></li>
    <li><a class="tag" href="#c">افزودن کلاس درس</a></li>
</ul>
<!-- ===========================================base form ============================== -->
<hr id="a">
    <div class="container-fluid">
        <h3 class="h_3" >افزودن پایـه تحصیلی</h3>
        <form action="" method="post" id="frm" class="form-group">
            <label>پایه تحصـیلی</label>:<input type="text" id="dokme" class="form-control" name="basename">
            <input type="submit" value="افزودن" name="sub_base" id="sub" class="btn btn-secondary form-control">
        </form>
    </div>

        <table class="table table-dark">
            <tr>
                <td>ردیف</td>
                <td>پایه تحصیلی</td>
                <td>ویرایش</td>
                <td>حذف</td>
            </tr>
            <?php
            include '../funcs/connection.php';
            $sql_sel = "SELECT * FROM `tblbase`";
            $sql_sel_pre = $db->prepare($sql_sel);
            $sql_sel_pre->execute();
            $i = 1;
            while ($row = $sql_sel_pre->fetch(PDO::FETCH_ASSOC)) {
                echo '
        <tr>
        <td>' . $i . '</td>
        <td>' . $row['base_name'] . '</td>
        <td><a href="edit.php?id='.$row['base_id'].'&change=base" ><img src="../img/icons/pencil.png"></a></td>
        <td><a href="del.php?id='.$row['base_id'].'&change=base" ><img src="../img/icons/garbage.png"></a></td>
        </tr>';
                $i++;
            }
            ?>

        </table>


<hr  id="b">
<!-- ======================================== course form ====================== -->
    <div class="container-fluid" id="div_bala">
        <h3 class="h_3">افزودن رشتـه تحصیلی</h3>
        <form action="" method="post" id="frm" class="form-group">
            <label>رشته تحصیلی</label>:<input type="text" id="dokme" class="form-control" name="coursename">
            <input type="submit" value="افزودن" name="sub_course" id="sub" class="btn btn-success form-control">
        </form>
    </div>

        <table class="table table-dark">
            <tr>
                <td>ردیف</td>
                <td>رشته تحصیلی</td>
                <td>ویرایش</td>
                <td>حذف</td>
            </tr>
            <?php
            include '../funcs/connection.php';
            $sql_co = "SELECT * FROM `tblcourse`";
            $sql_co_pre = $db->prepare($sql_co);
            $sql_co_pre->execute();
            $j = 1;
            while ($rowc = $sql_co_pre->fetch(PDO::FETCH_ASSOC)) {
                echo '
        <tr>
        <td>' . $j . '</td>
        <td>' . $rowc['course_name'] . '</td>
        <td><a href="edit.php?id='.$rowc['course_id'].'&change=course" ><img src="../img/icons/pencil.png"></a></td>
        <td><a href="del.php?id='.$rowc['course_id'].'&change=course" ><img src="../img/icons/garbage.png"></a></td>
        </tr>';
                $j++;
            }
            ?>

        </table>

<hr id="c">
<!-- ================================class form ================================ -->
    <div class="container-fluid" id="div_bala">
        <h3 class="h_3" >افـزودن کلاس درس</h3>
        <form action="" method="post" id="frm" class="form-group">
            <label>پایه تحصیلی</label>
            :<select id="dokme" class="form-control custom-select" name="base">
                <?php

                include '../funcs/connection.php';
                $sql_s = "SELECT * FROM tblbase ";
                $sql_spre = $db->prepare($sql_s);
                $sql_spre->execute();

                while ($roww = $sql_spre->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value=' . $roww['base_id'] . '>' . $roww['base_name'] . '</option>';
                }
                ?>
            </select>
            <label>رشته تحصیلی</label>
            :<select id="dokme" class="form-control custom-select" name="course">
                <?php

                include '../funcs/connection.php';
                $sql_c = "SELECT * FROM tblcourse ";
                $sql_cpre = $db->prepare($sql_c);
                $sql_cpre->execute();

                while ($ro = $sql_cpre->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value=' . $ro['course_id'] . ' >' . $ro['course_name'] . '</option>';
                }
                ?>
            </select>
            <label>نام کلاس</label>:<input type="number" id="dokme" class="form-control" name="classname">
            <input type="submit" value="افزودن" name="sub_class" id="sub" class="btn btn-info form-control">
        </form>
    </div>
 <!-- tableeeeeeeeeeeeeeeeeeeeeeee -->

        <table class="table table-dark">
            <tr>
                <td>ردیف</td>
                <td>نام کلاس</td>
                <td>پایه تحصیلی</td>
                <td>رشته تحصیلی</td>
                <td>ویرایش</td>
                <td>حذف</td>
            </tr>
            <?php
            include '../funcs/connection.php';
            $sql_cl = "SELECT * FROM `tblclass`";
            $sql_cl_pre = $db->prepare($sql_cl);
            $sql_cl_pre->execute();
            $w = 1;
            while ($rowcl = $sql_cl_pre->fetch(PDO::FETCH_ASSOC)) {
                echo '
        <tr>
        <td>' . $w . '</td>
        <td>' . $rowcl['class_id'] . '</td>
        ';
                $sql_clb = "SELECT * FROM `tblbase` where `base_id`=".$rowcl['base_id'];
                $sql_clb_pre = $db->prepare($sql_clb);
                $sql_clb_pre->execute();
                $rowclb=$sql_clb_pre->fetch(PDO::FETCH_ASSOC);
                echo'
        <td>' . $rowclb['base_name'] . '</td>';
                $sql_clc = "SELECT * FROM `tblcourse` where `course_id`=".$rowcl['course_id'];
                $sql_clc_pre = $db->prepare($sql_clc);
                $sql_clc_pre->execute();
                $rowclc=$sql_clc_pre->fetch(PDO::FETCH_ASSOC);
                echo'
        <td>' . $rowclc['course_name'] . '</td>
        <td><a href="edit.php?id='.$rowcl['class_id'].'&change=classes" ><img src="../img/icons/pencil.png"></a></td>
        <td><a href="del.php?id='.$rowcl['class_id'].'&change=classes" ><img src="../img/icons/garbage.png"></a></td>
        </tr>';
                $w++;
            }
            ?>

        </table>


<!-- ================================base php ================================ -->
<?php
include '../funcs/connection.php';
if (isset($_POST['sub_base'])) {
    $base_name = htmlspecialchars($_POST['basename']);

    $sql_sel = "SELECT * FROM `tblbase` WHERE base_name=trim('$base_name')";
    $sql_sel_pre = $db->prepare($sql_sel);
    $sql_sel_pre->execute();
    $row = $sql_sel_pre->fetch(PDO::FETCH_ASSOC);
    if ($row == 0) {
        if (strlen($base_name) != 0) {
            $sql_in = "INSERT INTO `tblbase` (`base_id`, `base_name`) VALUES (NULL, '$base_name') ";
            $sql_in_pre = $db->prepare($sql_in);
            $sql_in_pre->execute();
            echo '
           <script>
                var message="پایه مورد نظر ثبت شد";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
           </script>
        ';
        }//if in inner
        else {
            echo '
           <script>
                var message="فیلد خالی را پر کنید";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
           </script>
        ';
        }//else in inner
    } else {
        echo '
           <script>
                var message="این پایه از قبل موجود بود";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
           </script>
        ';
    }//else inner
}//if subset
//<!-- ================================course php ================================ -->
if (isset($_POST['sub_course'])) {
    $course_name = htmlspecialchars($_POST['coursename']);

    $sql_sel = "SELECT * FROM `tblcourse` WHERE course_name=trim('$course_name')";
    $sql_sel_pre = $db->prepare($sql_sel);
    $sql_sel_pre->execute();
    $rows = $sql_sel_pre->fetch(PDO::FETCH_ASSOC);
    if ($rows == 0) {
        if (strlen($course_name) != 0) {
            $sql_in = "INSERT INTO `tblcourse` (`course_id`, `course_name`) VALUES (NULL, '$course_name') ";
            $sql_in_pre = $db->prepare($sql_in);
            $sql_in_pre->execute();
            echo '
           <script>
                var message="رشته مورد نظر ثبت  شد";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
           </script>
        ';
        }//if in inner
        else {
            echo '
           <script>
                var message="فیلد خالی را پر کنید";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
           </script>
        ';
        }//else in inner
    } else {
        echo '
           <script>
                var message="رشته مورد  نظر از قبل موجود بود";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
           </script>
        ';
    }//else inner
}//if subset
//--======================================== class php =============================== 
if (isset($_POST['sub_class'])) {
    $class_name = $_POST['classname'];
    $base_id = $_POST['base'];
    $course_id = $_POST['course'];

    $sql_sele = "SELECT * FROM `tblclass` WHERE class_id=trim('$class_name')";
    $sql_sele_pre = $db->prepare($sql_sele);
    $sql_sele_pre->execute();

    if ($r = $sql_sele_pre->fetch(PDO::FETCH_ASSOC) == 0) {
        if (strlen($class_name) != 0) {
            $sql_ins = "INSERT INTO `tblclass` (`class_id`,`course_id`, `base_id`) VALUES ('$class_name','$course_id', '$base_id') ";
            $sql_ins_pre = $db->prepare($sql_ins);
            $sql_ins_pre->execute();
            echo '

         <script>
              var message="کلاس با موفقیت ثبت شد";
              $.post(
                "../funcs/alarm.php",{msg:mas},function(data){
                    $("alarm").html(data);
                }
              );
         </script>

         ';
        }// end if in inner
    } else {
        echo '
            <script src="../js/bootstrap.js"></script>
            <script src="../js/jquery.js"></script>
         <script>
         
              var message="این کلاس از قبل موجود بود";
              $.post(
                "../funcs/alarm.php",{msg:mas},function(data){
                    $("alarm").html(data);
                }
              );
         </script> ';
    }// end else inner
}
?>

</body>
</html>>