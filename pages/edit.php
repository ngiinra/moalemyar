<?php
session_start();
ob_start();

?>
    <html>
    <head>
        <title>صفحه ویرایش</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/custom.css" rel="stylesheet">

    </head>
    <body dir="rtl">



    <!-- ----------------------------     دریافت id  ------------------------------------- -->
<?php
include '../funcs/connection.php';
if (isset($_GET['id'])) {
    switch ($_SESSION['page_id']) {

        case "insertuser.php":
        {
            echo'
            <a href='.$_SESSION['page_id'].' class="page-link bazgasht">بازگشت</a>
            <div class="alert alert-heading" id="alarm"><b></b></div>
             ';
            $sql_select = "select * from tbluser where `user_id`=" . $_GET['id'];
            $sql_select_pre = $db->prepare($sql_select);
            $sql_select_pre->execute();
            $row = $sql_select_pre->fetch(PDO::FETCH_ASSOC);

            // نمایش فرم======================
            echo '
<div class="container">
<form action="" method="post" id="frm" class="form-group">
    <label>نام</label>
    : <input type="text" name="fname" id="dokme" value="' . $row['fname'] . ' " class="form-control"><br/>
    <label>نام خانوادگی</label>
    : <input type="text" name="lname" id="dokme" value="' . $row['lname'] . '" class="form-control"><br>
    <label>نام کاربری</label>
    : <input type="text" name="username" id="dokme" value="' . $row['username'] . ' " class="form-control"><br>
    <label>رمز عبور</label>
    : <input type="text" name="password" id="dokme" value="' . $row['password'] . ' " class="form-control"><br>
    <label>نوع کاربری</label>
    : <select name="noe_karbari" id="dokme" class="form-control custom-select">
    ';

            if ($row['type'] == 1) {
                echo '
        <option value="1" selected>مدیر</option>
        <option value="2">معاون</option>
        <option value="3">دانش آموز</option> ';
            } else if ($row['type'] == 2) {
                echo '
        <option value="1" >مدیر</option>
        <option value="2" selected>معاون</option>
        <option value="3">دانش آموز</option> ';
            } else {
                echo '
        <option value="1" >مدیر</option>
        <option value="2">معاون</option>
        <option value="3" selected>دانش آموز</option> ';
            }

            echo '
    </select><br>
    <label>تلفن همراه</label>
    : <input type="text" name="mobile" id="dokme"
            value="' . $row['mobile'] . ' " class="form-control"><br>
    <input type="submit" name="submit_user" value="اعمال تغییــرات" class="btn btn-outline-success form-control" id="sub">
</form>

</div>';


//======================================== submit =================================================================

            if (isset($_POST['submit_user'])) {
                $firstname = htmlspecialchars($_POST['fname']);
                $lastname = htmlspecialchars($_POST['lname']);
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $noekarbari = htmlspecialchars($_POST['noe_karbari']);
                $mobile = htmlspecialchars($_POST['mobile']);

                $sql_update = "update tbluser set `fname`='$firstname' , `lname`='$lastname' , `username`='$username' , 
                          `password`='$password' , `type`='$noekarbari' , `mobile`='$mobile' where `user_id`=" . $_GET['id'];
                $sql_update_pre = $db->prepare($sql_update);
                $sql_update_pre->execute();
                echo '
                                   <script src="../js/jquery.js"></script>
                                   <script>
                                   var message="با موفقیت تغییر یافت";
                                   $.post(
                                       "../funcs/alarm.php",{msg:message},function(data){
                                           $("#alarm").html(data);
                                       }
                                   );
                                   </script>
                            
                                 ';
            }
            break;// end CASE INSERT USER
        }//end CASe1 insert user
//===============================================================================================================
//==============================================================================================================
        case "set.php":
        {
            echo'
            <a href='.$_SESSION['page_id'].' class="page-link bazgasht">بازگشت</a>
            <div class="alert alert-success" id="alarm"><b></b></div>
             ';
            if (isset($_GET['what'])) {
                $what=$_GET['what'];

                if ($what == "set") {
                    $sql_sub_select = "SELECT * FROM `tblcategory` WHERE cat_id=".$_GET['id'];
                    $sql_sub_select_pre = $db->prepare($sql_sub_select);
                    $sql_sub_select_pre->execute();
                    $row_sub = $sql_sub_select_pre->fetch(PDO::FETCH_ASSOC);
                    echo '
                        <div class="container-fluid">
                        <h3 class="h_3">دستـــه</h3>
                        <form action="" method="post" id="frm" class="form-group">
                            <label>تصحیح نام دسته</label>:<input type="text" id="dokme" class="form-control" name="set_name"
                             value='.$row_sub['title'].'><br>
                            <input type="submit" value="اعمال تغییر" name="set_submit" id="sub" class="btn btn-success form-control">
                        </form>
                        </div> ';
                    //=============================php==============================================
                    if (isset($_POST['set_submit'])) {
                        $set_name = htmlspecialchars(trim($_POST['set_name']));
                            $sql_set_update = "update tblcategory set `title`='$set_name' , `parent`='0' where `cat_id`=" . $_GET['id'];
                            $sql_set_update_pre = $db->prepare($sql_set_update);
                            $sql_set_update_pre->execute();
                            echo '
                                   <script src="../js/jquery.js"></script>
                                   <script>
                                   var message="با موفقیت تغییر یافت";
                                   $.post(
                                       "../funcs/alarm.php",{msg:message},function(data){
                                           $("#alarm").html(data);
                                       }
                                   );
                                   </script>
                            
                                 ';


                    }//end if isset submit
                }// end if what SET

                else{

                    $sql_sub_select = "SELECT * FROM `tblcategory` WHERE cat_id=".$_GET['id'];
                    $sql_sub_select_pre = $db->prepare($sql_sub_select);
                    $sql_sub_select_pre->execute();
                    $row_sub = $sql_sub_select_pre->fetch(PDO::FETCH_ASSOC);
                    echo'
                        <div class="container-fluid">
                            <h3 class="h_3">زیـردستــــه</h3>
                            <form action="" method="post" id="frm" class="form-group">
                                <label>دسته</label>
                                :<select name="set_code"  id="dokme" class="form-control custom-select">';
                                    $sql_parent = "SELECT * FROM `tblcategory` WHERE `parent`='0' ";
                                    $sql_parent_pre = $db->prepare($sql_parent);
                                    $sql_parent_pre->execute();
                                    while ($row_parent = $sql_parent_pre->fetch(PDO::FETCH_ASSOC)) {
                                        if ($row_sub['parent']==$row_parent['cat_id']){
                                            echo '
                                          <option value="'.$row_parent['cat_id'].'" selected>
                                            '.$row_parent['title'].'
                                          </option>
                                        ';
                                        }else{
                                            echo '
                                          <option value="'.$row_parent['cat_id'].'" >
                                            '.$row_parent['title'].'
                                          </option>
                                        ';
                                        }

                                    }
                                echo'
                                </select>
                                <label>نام زیردسته</label>:<input type="text" class="form-control" id="dokme" value='.$row_sub['title'].'
                                 name="subset_name">
                                <input type="submit" value="تغییر اعمال شود" class="btn btn-warning form-control" name="subset_submit">
                               ';
                 //php code===========================================================================
                    if (isset($_POST['subset_submit'])) {
                        $subset_name = htmlspecialchars(trim($_POST['subset_name']));
                        $set_code = $_POST['set_code'];
                        $sql_set_update = "update tblcategory set `title`='$subset_name' , `parent`='$set_code' where 
                        `cat_id`=" . $_GET['id'];
                        $sql_set_update_pre = $db->prepare($sql_set_update);
                        $sql_set_update_pre->execute();
                        echo '
                                   <script src="../js/jquery.js"></script>
                                   <script>
                                   var message="با موفقیت تغییر یافت";
                                   $.post(
                                       "../funcs/alarm.php",{msg:message},function(data){
                                           $("#alarm").html(data);
                                       }
                                   );
                                   </script>
                            
                                 ';
                    }//end if isset subset

                }//end if what SUBSET
            }// end if isset what to EDIT -SET or SUBSET
            break;
        }// end case 2 set.php
//=========================================================================================================
//=========================================================================================================
        case "addstu.php":{
            $select_student="SELECT * from tblstudent where student_id=".$_GET['id'];
            $select_student_pre=$db->prepare($select_student);
            $select_student_pre->execute();
            $fetch_stu=$select_student_pre->fetch(PDO::FETCH_ASSOC);
            //===========================STYLE==================================
            echo '
             <a href="addstu.php" class="page-link bazgasht" >بازگشت</a>
                <div class="alert alert-heading" id="alarm"><b></b></div>
                <hr>
                <div class="row">
                    <div class="container-fluid" >
                        <form action="" method="post" id="frm" class="form-group">
                            
                            <label>نام هنرجو</label>:<input type="text" id="dokme" class="form-control" name="stu_name" 
                            value='.$fetch_stu['sname'].'>
                            <label>نام خانوادگی هنرجو</label>:<input type="text" id="dokme" class="form-control" name="stu_family" 
                            value='.$fetch_stu['sfamily'].'>
                            <label>نام کلاس</label>
                            :<select name="stu_class" id="dokme" class="form-control custom-select">';
                               //====================== select php ==============================
                                $sql_select_witch_class = "SELECT * FROM `tblclass`";
                                $sql_select_witch_class_pre = $db->prepare($sql_select_witch_class);
                                $sql_select_witch_class_pre->execute();
                                while ($fetch_witch_class = $sql_select_witch_class_pre->fetch(PDO::FETCH_ASSOC)) {
                                    if ($fetch_witch_class['class_id']==$fetch_stu['class_id']){
                                        echo '<option value="' . $fetch_witch_class['class_id'] . ' selected">
                                         ' . $fetch_witch_class['class_id'] .'
                                         <option>';
                                    }else{
                                        echo '<option value="' . $fetch_witch_class['class_id'] . ' ">
                                         ' . $fetch_witch_class['class_id'] .'
                                         <option>';
                                    }

                                }//end while & select
                               echo'
                                <!-- ======================end select php ============================== -->
                            </select>
                            <label>امتیازات کسب شده</label>:<input type="text" name="stu_state" id="dokme" class="form-control"
                             value='.$fetch_stu['state_id'].'>
                            <label>موبایل والدین</label>:<input type="number" name="stu_mobile" id="dokme" class="form-control"
                             value='.$fetch_stu['mobile'].'>
                            <input type="submit" value="اعمال تغییرات" name="student_submit" id="sub" class="btn btn-primary form-control">
                        </form>
                    </div> <!-- container -->
                </div><!-- row div -->
            
            ';
         //================================PHP=======================================================================
            if (isset($_POST['student_submit'])) {
                $stu_name = htmlspecialchars(trim($_POST['stu_name']));
                $stu_family = htmlspecialchars(trim($_POST['stu_family']));
                $stu_class=$_POST['stu_class'];
                $stu_state=htmlspecialchars($_POST['stu_state']);
                $stu_mobile=$_POST['stu_mobile'];
                $sql_edit_student="UPDATE tblstudent SET `sname`='$stu_name',`sfamily`='$stu_family',`class_id`='$stu_class'
                ,`state_id`='$stu_state' where `student_id`=".$_GET['id'];
                $sql_edit_student_pre=$db->prepare($sql_edit_student);
                $sql_edit_student_pre->execute();
                echo '
                                   <script src="../js/jquery.js"></script>
                                   <script>
                                   var message="با موفقیت انجام شد";
                                   $.post(
                                       "../funcs/alarm.php",{msg:message},function(data){
                                           $("#alarm").html(data);
                                       }
                                   );
                                   </script>
                            
                                 ';
            }//end if subset

            break;
        }//end case ADD STUDENT CASE 3
//=============================================================================================================
//=============================================================================================================
        case "define_class.php":{
            if(isset($_GET['change'])){
                $change=$_GET['change'];
                echo'<a href="define_class.php" class="page-link bazgasht" >بازگشت</a>
                     <div class="alert alert-heading" id="alarm"><b></b></div>';
                switch ($change){
                    case "base":
                    {
                        $select_bases="SELECT * FROM `tblbase` where `base_id`=".$_GET['id'];
                        $select_bases_pre=$db->prepare($select_bases);
                        $select_bases_pre->execute();
                        $fetch_of_base=$select_bases_pre->fetch(PDO::FETCH_ASSOC);
                        echo'
                             
                             <div class="row ">
                                <div class="container-fluid">
                                    <form action="" method="post" id="frm" class="form-group">
                                        <label>پایه تحصـیلی</label>:<input type="text" id="dokme" class="form-control" 
                                        name="basename_of_base" value='.$fetch_of_base['base_name'].'>
                                        <input type="submit" value="تصحیح" name="base_submit" class="btn btn-info form-control">
                                    </form>
                                </div>
                             </div>
                            
                            ';
                        //PHP CODE=========================================================================================
                        if(isset($_POST['base_submit'])){
                            $basename_of_base=htmlspecialchars(trim($_POST['basename_of_base']));
                            $edit_bases="update `tblbase` set `base_name`='$basename_of_base' where `base_id`=".$_GET['id'];
                            $edit_bases_pre=$db->prepare($edit_bases);
                            $edit_bases_pre->execute();
                            echo '
                                   <script src="../js/jquery.js"></script>
                                   <script>
                                   var message="با موفقیت انجام شد";
                                   $.post(
                                       "../funcs/alarm.php",{msg:message},function(data){
                                           $("#alarm").html(data);
                                       }
                                   );
                                   </script>
                            
                                 ';
                        }// end  submit isset
                        break;
                    }// end case base change=base
                    case "course":
                        {

                            $select_courses="SELECT * FROM `tblcourse` where `course_id`=".$_GET['id'];
                            $select_courses_pre=$db->prepare($select_courses);
                            $select_courses_pre->execute();
                            $fetch_of_course=$select_courses_pre->fetch(PDO::FETCH_ASSOC);
                            echo '
    
                                 <div class="row ">
                                    <div class="container-fluid" >
                                        <form action="" method="post" id="frm" class="form-group">
                                            <label>رشته تحصیلی</label>:<input type="text" id="dokme" class="form-control" 
                                            name="coursename" value='.$fetch_of_course['course_name'].'>
                                            <input type="submit" value="تصحیح" name="submit_course"  class="btn btn-danger form-control">
                                        </form>
                                    </div>
                                </div>
                                 
                                 ';
                            //php code===============================================================================
                            if(isset($_POST['submit_course'])){
                                 $course=htmlspecialchars($_POST['coursename']);
                                 $edit_courses="UPDATE tblcourse SET course_name='$course' WHERE course_id=".$_GET['id'];
                                 $edit_courses_pre=$db->prepare($edit_courses);
                                 $edit_courses_pre->execute();
                                 echo'
                                     <script src="../js/jquery.js"></script>
                                       <script>
                                       var message="با موفقیت انجام شد";
                                       $.post(
                                           "../funcs/alarm.php",{msg:message},function(data){
                                               $("#alarm").html(data);
                                           }
                                       );
                                       </script>
                                     ';
                            }//end if isset submit
                            break;
                    }// end case change=course

                    case "classes":{
                        $sql_select_class="SELECT * FROM tblclass WHERE class_id=".$_GET['id'];
                        $sql_select_class_pre=$db->prepare($sql_select_class);
                        $sql_select_class_pre->execute();
                        $fetch_class=$sql_select_class_pre->fetch(PDO::FETCH_ASSOC);
                        echo '
                               <div class="row ">
                                <div class="container-fluid" >
                                    <form action="" method="post" id="frm" class="form-group">
                                        <label>پایه تحصیلی</label>
                                        :<select id="dokme" class="form-control custom-select" name="base_class">';
                                            $select_class_base = "SELECT * FROM tblbase ";
                                            $select_class_base_pre = $db->prepare($select_class_base);
                                            $select_class_base_pre->execute();
                                            while ($fetch_base_of_class = $select_class_base_pre->fetch(PDO::FETCH_ASSOC)) {
                                                if ($fetch_base_of_class['base_id']==$fetch_class['base_id'])
                                                {
                                                    echo' <option value='.$fetch_base_of_class['base_id'].' selected>
                                                       '.$fetch_base_of_class['base_name'].'</option>
                                                 ';
                                                }else{
                                                    echo' <option value='.$fetch_base_of_class['base_id'].' >
                                                       '.$fetch_base_of_class['base_name'].'</option>
                                                 ';
                                                }
                                            }//end while
                                            echo'
                                        </select>
                                        <label>رشته تحصیلی</label>
                                        :<select id="dokme" class="form-control custom-select" name="course_class">
                                            ';
                                            $select_class_course = "SELECT * FROM tblcourse ";
                                            $select_class_course_pre = $db->prepare($select_class_course);
                                            $select_class_course_pre->execute();
                                            while ($fetch_course_of_class = $select_class_course_pre->fetch(PDO::FETCH_ASSOC)) {
                                                if($fetch_course_of_class['course_id']==$fetch_class['course_id']){
                                                    echo '<option value='.$fetch_course_of_class['course_id'].' selected>
                                                '.$fetch_course_of_class['course_name'].' </option> ';
                                                }else{
                                                    echo '<option value='.$fetch_course_of_class['course_id'].' >
                                                '.$fetch_course_of_class['course_name'].' </option> ';
                                                }

                                            }//end while
                                            echo'
                                        </select>
                                        <label>نام کلاس</label>:<input type="number" id="dokme" class="form-control" 
                                        name="class_name_of_class" value='.$fetch_class['class_id'].'>
                                        <input type="submit" value="تصحیح اطلاعات" name="submit_class" id="sub" class="btn btn-warning form-control">
                                    </form>
                                </div>
                            </div>

                             ';
                            //php=================================================================
                            if(isset($_POST['submit_class'])) {
                               $base_of_class=$_POST['base_class'];
                               $course_of_class=$_POST['course_class'];
                               $class_name_of_class=$_POST['class_name_of_class'];
                               $edit_classes="UPDATE tblclass SET `base_id`='$base_of_class',`course_id`='$course_of_class',
                               `class_id`='$class_name_of_class' WHERE `class_id`=".$_GET['id'];
                               $edit_classes_pre=$db->prepare($edit_classes);
                               $edit_classes_pre->execute();
                               echo'
                                   <script src="../js/jquery.js"></script>
                                       <script>
                                       var message="با موفقیت انجام شد";
                                       $.post(
                                           "../funcs/alarm.php",{msg:message},function(data){
                                               $("#alarm").html(data);
                                           }
                                       );
                                       </script>
                                     
                                   ';
                            }//end if submit
                        break;
                    }//end case change class
                }//end switch isset CHANGE WHAT? class or course or base
            }//end if(isset($_GET['change'])){
            break;
        }//end case 4 define class
//=================================================================================================================
//=================================================================================================================
        case "addtea.php":{
            $select_teacher="SELECT * FROM tblteacher WHERE teacher_id=".$_GET['id'];
            $select_teacher_pre=$db->prepare($select_teacher);
            $select_teacher_pre->execute();
            $fetch_teacher=$select_teacher_pre->fetch(PDO::FETCH_ASSOC);
            echo'
                 <a href='.$_SESSION['page_id'].' class="page-link bazgasht">بازگشت</a>
                 <div class="alert alert-heading" id="alarm"><b></b></div>
                    <div class="row">
                        <div class="container-fluid" id="div_bala">
                            <form action="" method="post" id="frm" class="form-group">
                                <label>نام همکار</label>:
                                <input type="text" id="dokme" class="form-control" name="tea_name" value='.$fetch_teacher['tname'].'>
                                <label>نام خانوادگی</label>:
                                <input type="text" id="dokme" class="form-control" name="tea_family" value='.$fetch_teacher['tfamily'].'>
                                <label>شماره موبایل همکار</label>:
                                <input type="text" name="tea_mobile" id="dokme" class="form-control" value='.$fetch_teacher['tmobile'].'>
                                <input type="submit" value="اعمال تغییرات" name="teacher_submit" id="sub" class="btn btn-success form-control">
                            </form>
                        </div> <!-- container -->
                    </div>
                ';
            //------------PHP CODES----------------------------------------------------------------------
            if (isset($_POST['teacher_submit'])){
                $teacher_name=htmlspecialchars(trim($_POST['tea_name']));
                $teacher_family=htmlspecialchars($_POST['tea_family']);
                $teacher_mobile=htmlspecialchars($_POST['tea_mobile']);

                $edit_teacher="UPDATE tblteacher SET `tname`='$teacher_name',`tfamily`='$teacher_family',
                `tmobile`='$teacher_mobile' WHERE `teacher_id`=".$_GET['id'];
                $edit_teacher_pre=$db->prepare($edit_teacher);
                $edit_teacher_pre->execute();
                echo '
                       <script src="../js/jquery.js"></script>
                                   <script>
                                   var message="با موفقیت انجام شد";
                                   $.post(
                                       "../funcs/alarm.php",{msg:message},function(data){
                                           $("#alarm").html(data);
                                       }
                                   );
                                   </script>
                     ';
            }//end if submit

            break;
        }//end case 5 update teachers
//================================================================================================================
//================================================================================================================
        case "addlesson.php":{
            $select_lesson="SELECT * FROM tbllesson WHERE lesson_id=".$_GET['id'];
            $select_lesson_pre=$db->prepare($select_lesson);
            $select_lesson_pre->execute();
            $fetch_lesson=$select_lesson_pre->fetch(PDO::FETCH_ASSOC);
            echo'
                 <a href="addlesson.php" class="page-link bazgasht">بازگشت</a>
                 <div class="alert alert-heading" id="alarm"><b></b></div>
                 <div class="row ">
                        <div class="container-fluid">
                            <form action="" method="post" id="frm" class="form-group">
                                <label>نام درس</label>:
                                <input type="text" id="dokme" class="form-control" name="lesson_name" value='.$fetch_lesson['lname'].'>
                                <label>نوع درس</label>:
                                <select class="form-control custom-select" name="lesson_type">';
                                   if ($fetch_lesson['type']==0){
                                       echo'<option value="0" selected>عمومی</option>
                                       <option value="1">مهارتی</option>';
                                   }//end if
                                     else{
                                         echo'<option value="0">عمومی</option>
                                              <option value="1" selected>مهارتی</option>';
                                     }
                                    echo'
                                </select>
                                <label>پایه تحصیلی</label>:
                                <select name="lesson_base" class="form-control custom-select">';
                                    $sql_lesson_base = "select * from tblbase";
                                    $sql_lesson_base_pre = $db->prepare($sql_lesson_base);
                                    $sql_lesson_base_pre->execute();
                                    while ($fetch_lesson_base = $sql_lesson_base_pre->fetch(PDO::FETCH_ASSOC)) {
                                        if($fetch_lesson['base_id']==$fetch_lesson_base['base_id']){
                                            echo '<option value="'.$fetch_lesson_base['base_id'].'" selected>
                                         '.$fetch_lesson_base['base_name'].' </option>';
                                        }else{
                                            echo '<option value="'.$fetch_lesson_base['base_id'].'">
                                         '.$fetch_lesson_base['base_name'].' </option>';
                                        }
                                    }//end while
                                echo'
                                </select>
                                <label>رشته تحصیلی</label>:
                                <select name="lesson_course" class="form-control custom-select">';
                                    $sql_lesson_course = "select * from tblcourse";
                                    $sql_lesson_course_pre = $db->prepare($sql_lesson_course);
                                    $sql_lesson_course_pre->execute();
                                    while ($fetch_lesson_course = $sql_lesson_course_pre->fetch(PDO::FETCH_ASSOC)) {
                                        if ($fetch_lesson['course_id']==$fetch_lesson_course['course_id'])
                                        {
                                        echo '<option value="'.$fetch_lesson_course['course_id'].' selected"> 
                                        '.$fetch_lesson_course['course_name'].'</option>';
                                        }else{
                                            echo '<option value="'.$fetch_lesson_course['course_id'].' "> 
                                        '.$fetch_lesson_course['course_name'].'</option>';
                                        }
                                    }//end while
                                 echo'
                                </select>
                                <label>نام معلم</label>
                                :<select class="form-control custom-select" name="lesson_teacher">';
                                    $sql_lesson_teacher = "select * from tblteacher";
                                    $sql_lesson_teacher_pre = $db->prepare($sql_lesson_teacher);
                                    $sql_lesson_teacher_pre->execute();
                                    while ($row_tea = $sql_lesson_teacher_pre->fetch(PDO::FETCH_ASSOC)) {
                                        if($fetch_lesson['teacher_id']==$row_tea['teacher_id']){
                                        echo '<option value='.$row_tea['teacher_id'].' selected>
                                        '.$row_tea['tname'].' '.$row_tea['tfamily'].'</option>';
                                        }else{
                                            echo '<option value='.$row_tea['teacher_id'].'>
                                        '.$row_tea['tname'].' '.$row_tea['tfamily'].'</option>';
                                        }
                                    }//end while
                                    echo'
                                </select>
                                <input type="submit" value="ثبت اطلاعات جدید" name="lesson_submit" id="sub" 
                                class="btn btn-success form-control">
                            </form>
                        </div>
                    </div> 
                 ';
//=====================================================================================================================
            if (isset($_POST['lesson_submit'])){
                $lesson_name=htmlspecialchars($_POST['lesson_name']);
                $lesson_type=$_POST['lesson_type'];
                $lesson_base=$_POST['lesson_base'];
                $lesson_course=$_POST['lesson_course'];
                $lesson_teacher=$_POST['lesson_teacher'];

                $edit_lesson="UPDATE tbllesson SET `lname`='$lesson_name',`type`='$lesson_type',
                `course_id`='$lesson_course',`base_id`='$lesson_base', `teacher_id`='$lesson_teacher'
                 WHERE `lesson_id`=".$_GET['id'];
                $edit_lesson_pre=$db->prepare($edit_lesson);
                $edit_lesson_pre->execute();
                 echo '
                       <script src="../js/jquery.js"></script>
                                   <script>
                                   var message="با موفقیت انجام شد";
                                   $.post(
                                       "../funcs/alarm.php",{msg:message},function(data){
                                           $("#alarm").html(data);
                                       }
                                   );
                                   </script>
                      ';
            }//end submit
            break;
        }//end case 6 addlesson.php
//================================================================================================================
//================================================================================================================
        case "addstate.php":{
            $select_state="SELECT * FROM tblstate WHERE state_id=".$_GET['id'];
            $select_state_pre=$db->prepare($select_state);
            $select_state_pre->execute();
            $fetch_state=$select_state_pre->fetch(PDO::FETCH_ASSOC);
            echo'
                <a href="addstate.php" class="page-link bazgasht">بازگشت</a>
                <div class="alert alert-heading" id="alarm"><b></b></div>
                <div class="container-fluid">
                    <h5 class="h_5">قانون را به همراه امتیاز مثبت یا منفی بنویسید</h5>
                    <form class="form-group" id="frm" method="post">
                        <label>عنوان امتیــاز</label>
                        :<input type="text" class="form-control" name="state_descript" value='.$fetch_state['state_description'].'>
                        <label>مقـدار نمـره </label>
                        :<input type="text" class="form-control" name="state_grade" value='.$fetch_state['state_grade'].'>
                        <input type="submit" class="btn btn-warning form-control" name="state_submit" value="تصحیح اطلاعات">
                    </form>
                </div>
                ';
            //============================php codes===============
            if (isset($_POST['state_submit'])){
                $state_descript=htmlspecialchars($_POST['state_descript']);
                $state_grade=htmlspecialchars($_POST['state_grade']);
                $edit_state="UPDATE tblstate SET `state_description`='$state_descript',`state_grade`='$state_grade'
                WHERE `state_id`=".$_GET['id'];
                $edit_state_pre=$db->prepare($edit_state);
                $edit_state_pre->execute();
                echo'
                     <script src="../js/jquery.js"></script>
                                   <script>
                                   var message="با موفقیت انجام شد";
                                   $.post(
                                       "../funcs/alarm.php",{msg:message},function(data){
                                           $("#alarm").html(data);
                                       }
                                   );
                                   </script>
                    ';
            }//end if submit
            break;
        }//end case 7 ADD STATE
//====================================================================================================================
//====================================================================================================================
        case "user_ables.php":{
            //============options
            $select_option="SELECT * FROM tbloptions WHERE op_id=".$_GET['id'];
            $select_option_pre=$db->prepare($select_option);
            $select_option_pre->execute();
            $fetch_option=$select_option_pre->fetch(PDO::FETCH_ASSOC);
             echo'
                  <a href="user_ables.php" class="page-link bazgasht">بازگشت</a>
                  <div class="alert alert-heading" id="alarm"><b></b></div> 
                  <div class="container-fluid">
                      <form id="frm" class="form-group" action="" method="post">
                          <label>عنوان توانایی</label>:<input type="text" class="form-control" name="option_name" 
                          value='.$fetch_option['title'].'>
                          <input type="submit" class="btn btn-warning form-control" name="option_submit" value="تصحیح اطلاعات">
                        </form>                  
                     </div>
                 ';
             //php code  --------------------------------------------------
            if (isset($_POST['option_submit'])){
                $option_name=htmlspecialchars($_POST['option_name']);
                $edit_option="UPDATE tbloptions SET title='$option_name' WHERE op_id=".$_GET['id'];
                $edit_option_pre=$db->prepare($edit_option);
                $edit_option_pre->execute();
                echo'
                     <script src="../js/jquery.js"></script>
                                   <script>
                                   var message="با موفقیت انجام شد";
                                   $.post(
                                       "../funcs/alarm.php",{msg:message},function(data){
                                           $("#alarm").html(data);
                                       }
                                   );
                                   </script>
                    ';
            }//end if submit
            break;
        }//end case 8 USERS ABLE
//====================================================================================================================
//====================================================================================================================
        case "accept_news.php":{
            $select_news="SELECT * FROM tblnews WHERE id_news=".$_GET['id'];
            $select_news_pre=$db->prepare($select_news);
            $select_news_pre->execute();
            $fetch_news=$select_news_pre->fetch(PDO::FETCH_ASSOC);
            echo '
                   <a href="accept_news.php" class="page-link bazgasht">بازگشت</a>
                   <div class="alert alert-heading" id="alarm"><b></b></div>
                  <div class="row">
                            <div class="container-fluid">
                                <form action="" method="post" id="frm" class="form-group" enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-md-5 col-sm-12">
                                    <label>عنوان خبر</label>:<input type="text" id="dokme" class="form-control" name="news_title"
                                    value='.$fetch_news['title'].'>
                                    </div>
                                    <div class="col-md-7 col-sm-12">
                                    <label>دسته خبر</label>
                                    :<select class="custom-select form-control" id="dokme" name="news_catid">';
                                        $sql_select_cat = "SELECT * FROM `tblcategory` WHERE parent='0'";
                                        $sql_select_cat_pre = $db->prepare($sql_select_cat);
                                        $sql_select_cat_pre->execute();
                                        while ($row_cat_parent = $sql_select_cat_pre->fetch(PDO::FETCH_ASSOC)) {
                                            if ($fetch_news['cat_id']==$row_cat_parent['cat_id']){
                                            echo '
                                            <option class="top_op" value="'.$row_cat_parent['cat_id'].'" selected>
                                            '.$row_cat_parent['title'].': </option>';
                                            }else{
                                                echo '
                                            <option class="top_op" value="'.$row_cat_parent['cat_id'].'">
                                            '.$row_cat_parent['title'].': </option>';
                                            }

                                            $parent_cat = $row_cat_parent['cat_id'];
                                            $sql_select_cat_kid = "SELECT * FROM `tblcategory` WHERE parent='$parent_cat'";
                                            $sql_select_cat_kid_pre = $db->prepare($sql_select_cat_kid);
                                            $sql_select_cat_kid_pre->execute();
                                            while ($row_cat_kid = $sql_select_cat_kid_pre->fetch(PDO::FETCH_ASSOC)) {
                                                if ($fetch_news['cat_id']==$row_cat_kid['cat_id']){
                                                    echo '<option  value="'.$row_cat_kid['cat_id'].'"  selected>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row_cat_kid['title'].'</option>';
                                                }else{
                                                    echo '<option value="'.$row_cat_kid['cat_id'].'" >
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row_cat_kid['title'].'</option>';
                                                }

                                            }
                                        }//end whole while  select
                                        echo'
                                    </select><br>
                                    </div><!-- end div col 7 -->
                                    </div><!-- end div row khate aval -->
                                    
                                    <div class="row">
                                    <div class="col-md-5 col-sm-12">
                                    <label> تصویر انتخابی</label>';
                                    if (strlen($fetch_news['pic'])!=0){
                                    echo '
                                    :<img src="../img/'.$fetch_news['pic'].'" id="ax_small" class="form-control"><br>
                                    ';}
                                    else{ echo 'تصویری انتخاب نشده است'; }
                                    echo'
                                    </div>
                                    <div class="col-md-7 col-sm-12">
                                    <label>متن خبر</label>:<textarea rows="10" id="dokme" class="form-control" name="news_descript">
                                    '.$fetch_news['descript'].'
                                    </textarea>
                                    </div>
                                    </div><!-- end div row -->
                                    <input type="submit" value="تصحیح خبر" name="sub_news" id="sub" class="btn btn-secondary form-control">
                                </form>
                            </div><!-- end div container koli -->
                  ';
            //PHP CODE===================================================================
            if(isset($_POST['sub_news'])){
                $news_title=htmlspecialchars($_POST['news_title']);
                $news_catid=$_POST['news_catid'];
                $news_descript=htmlspecialchars($_POST['news_descript']);
                $edit_news="UPDATE tblnews SET title='$news_title',descript='$news_descript',cat_id='$news_catid'
                WHERE id_news=".$_GET['id'];
                $edit_news_pre=$db->prepare($edit_news);
                $edit_news_pre->execute();
                echo '
                                   <script src="../js/jquery.js"></script>
                                   <script>
                                   var message="با موفقیت تغییر یافت";
                                   $.post(
                                       "../funcs/alarm.php",{msg:message},function(data){
                                           $("#alarm").html(data);
                                       }
                                   );
                                   </script>
                            
                                 ';
            }//end if submit
            break;
        }// end case 9 ACCEPT NEWS
    } //end SWITCH
}//end if ISSET
else{//اگر id نیامده بود
    echo'<script>alert("مشخص نشده مدام کاربر حذف شود")</script>';
}
?>