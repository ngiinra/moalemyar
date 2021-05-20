<?php
ob_start();
session_start();
$_SESSION['page_id']="set.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js"></script>
    <title>افزودن دسته</title>

</head>

<body dir="rtl">
<a href="userspanel.php" class="page-link bazgasht" >بازگشت به صفحه کاربری</a>
<div class="alert alert-dark" id="alarm"><b></b></div>
<ul id="rightalign">
    <li><a class="tag" href="#a">افزودن دستـه</a></li>
    <li><a class="tag" href="#b">افزودن زیردستـه</a></li>
</ul>
<!-- =========================set form ====================== -->
<hr id="a">
    <div class="container-fluid">
        <h3 class="h_3">دستـــه</h3>
        <form action="" method="post" id="frm" class="form-group">
            <label>افزودن دسته</label>:<input type="text" id="dokme" class="form-control" name="set_name"><br>
            <input type="submit" value="افزودن" name="sub_set" id="sub" class="btn btn-info form-control">
        </form>
    </div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <table class="table table-dark">
            <tr>
                <td>ردیف</td>
                <td>نام دسته</td>
                <td>ویرایش</td>
                <td>حذف</td>
            </tr>
            <?php
            include '../funcs/connection.php';
            $sql_sel = "SELECT * FROM `tblcategory` where parent='0'";
            $sql_sel_pre = $db->prepare($sql_sel);
            $sql_sel_pre->execute();
            $i = 1;
            while ($row = $sql_sel_pre->fetch(PDO::FETCH_ASSOC)) {
                echo '
        <tr>
        <td>' . $i . '</td>
        <td>' . $row['title'] . '</td>
        <td><a href="edit.php?id='.$row['cat_id'].'&what=set" ><img src="../img/icons/pencil.png"></a></td>
        <td><a href="del.php?id='.$row['cat_id'].'" ><img src="../img/icons/garbage.png"></a></td>
        </tr>';
                $i++;
            }
            ?>

        </table>
    </div>
    <div class="col-md-2"></div>
</div>

<!-- =========================set php ====================== -->
<?php
if (isset($_POST['sub_set'])) {
    $set_name = htmlspecialchars(trim($_POST['set_name']));
    include '../funcs/connection.php';
    $sql_select = "SELECT * FROM `tblcategory` WHERE title=trim('$set_name')";
    $sql_select_pre = $db->prepare($sql_select);
    $sql_select_pre->execute();
    $row = $sql_select_pre->fetch(PDO::FETCH_ASSOC);
    if ($row == 0) {
        if (strlen($set_name)!=0){
        $sql_insert = "INSERT INTO `tblcategory` (`cat_id`,`title`,`parent`) VALUES ('NULL','$set_name','0')";

        $sql_insert_pre = $db->prepare($sql_insert);
        $sql_insert_pre->execute();
        echo '
           <script>
                var message="این دسته با موفقیت ثبت شد";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
           </script>
        ';}
    } else {
        echo '
           <script>
                var message="این دسته از قبل موجود بود";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
           </script>
        ';
    }
}
?>
<br>
<hr id="b">
 <!-- =====================================subset php ================== -->
 <?php
 if (isset ($_POST['sub_subset'])){
   $cat_id = $_POST['get_sub'];
   $subset_name= htmlspecialchars(trim($_POST['subset_name']));
   include '../funcs/connection.php';
   $sql_sel = "SELECT * FROM `tblcategory`";
   $sql_sel_pre = $db->prepare($sql_sel);
   $sql_sel_pre->execute();
   $rowss=$sql_sel_pre->fetch(PDO::FETCH_ASSOC);
   if ($rowss['title']!=$subset_name){
       if (strlen($cat_id)) {
           $sql_insert_set = "INSERT INTO `tblcategory` (`cat_id`,`title`,`parent`) VALUES ('NULL','$subset_name','$cat_id')";
           $sql_insert_set_pre = $db->prepare($sql_insert_set);
           $sql_insert_set_pre->execute();
       }
   }else{
        echo '
           <script>
                var message="این زیر دسته از قبل موجود بود";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
           </script>
        ';
        }//else inner
}
?>
<!-- ========================sub set form ====================== -->

    <div class="container-fluid">
        <h3 class="h_3">زیـردستــــه</h3>
        <form action="" method="post" id="frm" class="form-group">
            <input type="hidden" id="get_sub" name="get_sub">
            <label>دسته</label>
            :<select name="setname"  id="dokme" class="form-control custom-select">


                <!-- ========================sub set php ====================== -->
                <?php
                include '../funcs/connection.php';
                $sql_parent = "SELECT * FROM `tblcategory` WHERE `parent`='0' ";
                $sql_parent_pre = $db->prepare($sql_parent);
                $sql_parent_pre->execute();
                while ($rows = $sql_parent_pre->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                          <option class="selectsub_parent"  id="'.$rows['cat_id'].'" >
                            '.$rows['title'].'
                          </option>
                        ';
                  }

                ?>
                <!-- ===================subset form================= -->
            </select><br>
            <label>نام زیر دسته</label>
            :<input type="text" id="dokme" class="form-control" name="subset_name"><br>
            <input type="submit" value="افزودن" name="sub_subset" id="sub" class="btn btn-secondary form-control">
        </form>
    </div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <table class="table table-dark">
            <tr>
                <td>ردیف</td>
                <td>نام زیر دسته</td>
                <td>ویرایش</td>
                <td>حذف</td>
            </tr>
            <?php
            include '../funcs/connection.php';
            $sqls_sel = "SELECT * FROM `tblcategory` where parent!='0'";
            $sqls_sel_pre = $db->prepare($sqls_sel);
            $sqls_sel_pre->execute();
            $i = 1;
            while ($rowsel = $sqls_sel_pre->fetch(PDO::FETCH_ASSOC)) {
                echo '
        <tr>
        <td>' . $i . '</td>
        <td>' . $rowsel['title'] . '</td>
        <td><a href="edit.php?id='.$rowsel['cat_id'].'&what=sub" ><img src="../img/icons/pencil.png"></a></td>
        <td><a href="del.php?id='.$rowsel['cat_id'].'" ><img src="../img/icons/garbage.png"></a></td>
        </tr>';
                $i++;
            }
            ?>

        </table>
    </div>
    <div class="col-md-2"></div>
</div>

<!-- ====================== sebset jQuery ================ -->
<script src="../js/jquery.js"></script>
<script>
    $("document").ready(function(){
        $(".selectsub_parent").click(function(){
            var id=$(this).attr('id');
            document.getElementById("get_sub").value=id;
        });
    });
</script>
</body>
</html>

