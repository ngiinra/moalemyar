<?php
ob_start();
session_start();
$_SESSION['page_id']="user_ables.php";
?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link href="../css/custom.css" rel="stylesheet">
    <title>تنظیم سطح دسترسی کاربران</title>

</head>
<body dir="rtl">
<a href="userspanel.php" class="page-link bazgasht">بازگشت به صفحه کاربری</a>
<h5 id="rightalign"><span class="h_5_sabz">ادمین عزیز برای افزودن توانایی برای کاربران با طراح سایت تماس حاصل فرمایید.</span></h5>
<h3 class="h_3" id="rightalign">توانایی های موجود :</h3>
<!-- ============================== ساخت تیبل بالا ==========================================-->
<div class="container">
    <table class="table table-dark">
        <tr>
            <td>ردیف</td>
            <td>توانایی</td>
            <td>ویرایش</td>
            <td>حذف</td>

            <!--<td>کاربر</td>-->
        </tr>
        <?php
        $i = 1;
        include '../funcs/connection.php';
        $sql_option = "select * from tbloptions";
        $sql_option_pre = $db->prepare($sql_option);
        $sql_option_pre->execute();
        // ================================================ تیبل های پایین
        while ($row_option = $sql_option_pre->fetch(PDO::FETCH_ASSOC)) {

            echo '
                    <tr>
                        <td>' . $i . '</td>
                        <td><a class="tag" href="#a' . $i . '">' . $row_option['title'] . '</a></td>
                        <td><a href="edit.php?id='.$row_option['op_id'].'"><img src="../img/icons/pencil.png"> </a></td>
                        <td><a href="del.php?id='.$row_option['op_id'].'"><img src="../img/icons/garbage.png"> </a></td>
                    </tr>
                  ';
            $i++;
        } // end while $row_option
        echo '</table></div>'; // table balayi

        //====================================================================
        $sql_option = "select * from tbloptions";
        $sql_option_pre = $db->prepare($sql_option);
        $sql_option_pre->execute();
        $j = 1;
        while ($row_option = $sql_option_pre->fetch(PDO::FETCH_ASSOC)) {
            echo '<hr id="a' . $j . '">
                       <div class="container-fluid" >
                          <h3 class="h_3" >' . $j . '.' . $row_option['title'] . '</h3>
                          <div class="container">
                              <table class="table table-dark">
                                  <tr>
                                    <td>نام و نام خانوادگی</td>
                                    <td>دسترسی و عدم دسترسی</td>
                                  </tr>
                  ';

            $k = $row_option['op_id'];

            $sql = "select * from tbluser
               join tblpanel on (tblpanel.user_id=tbluser.user_id and tblpanel.op_id='$k')";
            $sql_pre = $db->prepare($sql);
            $sql_pre->execute();
            // ====================================ساخت هر کدام از تیبل های کوچکتر

            while($row_user = $sql_pre->fetch(PDO::FETCH_ASSOC)){
            echo '
                    <tr>
                        <td>' . $row_user['fname'] . ' ' . $row_user['lname'] . '</td>
                  ';
            if ($row_user['show_id']==0){
                echo'
                        <td><a class="tag" href="user_ables.php?show=0&pan_id=' . $row_user['pan_id'] . '">دسترسی</a></td>
                     ';
            }else {
                echo'
                        <td><a class="tag" href="user_ables.php?show=1&pan_id=' . $row_user['pan_id'] . '">عدم دسترسی</a></td>
                    ';
                  }
            echo'
                </tr>
                ';
            }// end while har kodam az table haye kuchak
            echo '
                    </table>
                  </div>
                </div>
                ';
            $j++;
        }
 //=======================================================================================
        include '../funcs/connection.php';
        if (isset($_GET['show'])) {
            if (isset ($_GET['pan_id'])) {
                switch ($_GET['show']) {
                    case 0:
                        $new_show = 1;
                        break;
                    case 1:
                        $new_show = 0;
                        break;
                }
                $panid= $_GET['pan_id'];
                $sql_update = "UPDATE `tblpanel` SET `show_id`='$new_show' WHERE `pan_id`='$panid'";
                $sql_update_pre = $db->prepare($sql_update);
                $sql_update_pre->execute();
            }
        }
        ?>

    </table>
</div>
</div>
</body>
</html>