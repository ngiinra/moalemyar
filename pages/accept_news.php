<?php
ob_start();
session_start();
$_SESSION['page_id']="accept_news.php";
?>

    <!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link href="../css/custom.css" rel="stylesheet">
        <title>تایید و عدم تایید اخبار ارسال شده</title>

    </head>
    <body dir="rtl">
    <a href="userspanel.php" class="page-link bazgasht" >بازگشت به صفحه کاربری</a>
    <div class="container">
    <table class="table table-dark">
        <thead>
        <tr>
            <th></th>
            <th>نویسنده</th>
            <th>نمایش و عدم نمایش*</th>
            <th>تاریخ</th>
            <th>عنوان</th>
            <th>متن</th>
            <th>موضوع</th>
            <th>عکس</th>
            <th>ویرایش</th>
            <th>حذف</th>
        </tr>
        </thead>
        <?php
        include '../funcs/connection.php';
        $sql = "SELECT * FROM `tblnews`";
        $sql_pre = $db->prepare($sql);
        $sql_pre->execute();

        $i = 1;
        while ($row = $sql_pre->fetch(PDO::FETCH_ASSOC)) {
            $user = $row['user_id'];
            $category = $row['cat_id'];
            $sqli = "SELECT * FROM `tbluser` WHERE `user_id`='$user'";
            $sqli_pre = $db->prepare($sqli);
            $sqli_pre->execute();
            $rowi = $sqli_pre->fetch(PDO::FETCH_ASSOC);
            $sqlcat = "SELECT * FROM `tblcategory` WHERE `cat_id`='$category'";
            $sqlcat_pre = $db->prepare($sqlcat);
            $sqlcat_pre->execute();
            $rowcat = $sqlcat_pre->fetch(PDO::FETCH_ASSOC);
            echo ' <tr>
       <td>' . $i . '</td>
        <td>' . $rowi['fname'] . ' ' . $rowi['lname'] . '</td>';
            if ($row['accept'] == 0) {
                echo '
        <td><a class="tag" href="accept_news.php?accept=0 &id_news=' . $row['id_news'] . '">نمایش</a></td>';
            } else {
                echo '
        <td><a class="tag" href="accept_news.php?accept=1 &id_news=' . $row['id_news'] . '">عدم نمایش</a></td>';
            }
            echo '
        <td>' . $row['datee'] . '</td>
        <td>' . $row['title'] . '</td>
        <td>' . $row['descript'] . '</td>
        <td>' . $rowcat['title'] . '</td>
        <td>';
            if ($row['pic']!="")
            {echo '<img src="../img/'.$row['pic'].'" id="im">';}
            else{
                echo '-';
            }
        echo'</td>
        <td><a href="edit.php?id='.$row['id_news'].'"><img src="../img/icons/pencil.png"></a></td>
        <td><a href="del.php?id='.$row['id_news'].'"><img src="../img/icons/garbage.png"></a></td>
          </tr>';
            $i++;
        }//end while fetch row
        ?>
    </table>
    <hr>
    <p><b>*</b>: نمایش : خبر مورد نظر هنوز برای نمایش داده شدن تایید نشده <br> عدم نمایش : خبر مورد نظر اکنون بر روی
        سایت قرار دارد</p>
    </div>
    </body>
    </html>
<?php
include '../funcs/connection.php';
if (isset($_GET['accept'])) {
    if (isset ($_GET['id_news'])) {
        switch ($_GET['accept']) {
            case 0:
                $accept_jadid = 1;
                break;
            case 1:
                $accept_jadid = 0;
                break;
        }
        $sql_update = "UPDATE `tblnews` SET `accept`='$accept_jadid' WHERE `id_news`=" . $_GET['id_news'];
        $sql_update_pre = $db->prepare($sql_update);
        $sql_update_pre->execute();
    }
}