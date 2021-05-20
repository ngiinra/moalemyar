<?php
ob_start();
session_start();
include '../funcs/connection.php';
if (isset($_GET['id'])){
    switch ($_SESSION['page_id']){
        case "insertuser.php":// delete user
            $select="SELECT * FROM tbluser WHERE user_id=".$_GET['id'];
            $select_pre=$db->prepare($select);
            $select_pre->execute();
            $select_fetch=$select_pre->fetch(PDO::FETCH_ASSOC);
            if($select_fetch['type']==2){
                $sql_del="delete from tblteacher where tmobile=".$select_fetch['mobile'];
                $sql_del_pre=$db->prepare($sql_del);
                $sql_del_pre->execute();
            }
            $sql="delete from tbluser where `user_id`=".$_GET['id'];
            break;
        case "addtea.php":// delete teacher
            $selecttea="SELECT * FROM tblteacher WHERE teacher_id=".$_GET['id'];
            $selecttea_pre=$db->prepare($selecttea);
            $selecttea_pre->execute();
            $selecttea_fetch=$selecttea_pre->fetch(PDO::FETCH_ASSOC);
            $tname=$selecttea_fetch['tname'];
            $tfamily=$selecttea_fetch['tfamily'];
            $tmobile=$selecttea_fetch['tmobile'];
            $sql="DELETE FROM `tbluser` WHERE `fname`='$tname',`lname`='$tfamily',`mobile`='$tmobile',`type`='2'";
            $sqlpre=$db->prepare($sql);
            $sqlpre->execute();
            $sql="DELETE FROM `tblteacher` WHERE `teacher_id`=".$_GET['id'];
            break;
        case "addstu.php": //delete student
            $sql="DELETE FROM `tblstudent` WHERE `student_id`=".$_GET['id'];
            break;
        case "set.php":
            $sql="DELETE FROM `tblcategory` WHERE `cat_id`=".$_GET['id'];
            break;
        case "accept_news.php":
            $sql="DELETE FROM `tblnews` WHERE `id_news`=".$_GET['id'];
            break;
        case "addlesson.php":
            $sql="DELETE FROM `tbllesson` WHERE `lesson_id`=".$_GET['id'];
            break;
        case "define_class.php":{
            $change=$_GET['change'];
            switch($change) {
                case "base":
                {
                    $sql = "DELETE FROM `tblbase` WHERE `base_id`=" . $_GET['id'];
                    break;
                }
                case "course":
                {
                    $sql = "DELETE FROM `tblcourse` WHERE `course_id`=" . $_GET['id'];
                    break;
                }
                case "classes":
                    {
                        $sql = "DELETE FROM `tblclass` WHERE `class_id`=" . $_GET['id'];
                        break;
                    }
                    break;
            }
            }//end switch change in define class
        case "user_ables.php":{
            $sql="DELETE FROM `tblpanel` WHERE `op_id`=".$_GET['id'];
            $sqlpre=$db->prepare($sql);
            $sqlpre->execute();
            $sql="DELETE FROM `tbloptions` WHERE `op_id`=".$_GET['id'];
        }//end case USER ABLES
    }//end switch
    $sql_pre=$db->prepare($sql);
    $sql_pre->execute();
    echo '<a href="'.$_SESSION['page_id'].'" class="page-link bazgasht">بازگشت به صفحه کاربری</a>';
}
?>
<head>
    <meta charset="UTF-8">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <title>حذفا</title>

</head>

