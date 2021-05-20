<?php
ob_start();
session_start();
?>


    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/custom.css" rel="stylesheet">

        <title>افـزودن خبر</title>

    </head>
    <body dir="rtl">
    <!-- ============================================form ================================== -->
    <a href="userspanel.php" class="page-link bazgasht">بازگشت به صفحه کاربری</a>
    <div class="alert alert-dark" id="alarm"><b></b></div>
    <hr>
    <div class="row">
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-md-10 col-lg-10">
            <div class="container-fluid">
                <form action="" method="post" id="frm" class="form-group" enctype="multipart/form-data">
                    <input type="hidden" name="get_cat" id="get_cat">
                    <label>عنوان خبر</label>:<input type="text" id="dokme" class="form-control" name="title">
                    <label>متن خبر</label>:<textarea rows="20" id="dokme" class="form-control" name="descript">

               </textarea>
                    <label>دسته خبر</label>
                    :<select class="form-control custom-select" id="dokme">

                        <?php
                        include '../funcs/connection.php';
                        $sql_select = "SELECT * FROM `tblcategory` WHERE parent='0'";
                        $sql_select_pre = $db->prepare($sql_select);
                        $sql_select_pre->execute();
                        while ($row = $sql_select_pre->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option class="cats top_op" id="' . $row['cat_id'] . '" >' . $row['title'] . ':</option>';
                            $parent = $row['cat_id'];
                            $sql_se = "SELECT * FROM `tblcategory` WHERE parent='$parent'";
                            $sql_se_pre = $db->prepare($sql_se);
                            $sql_se_pre->execute();
                            while ($roo = $sql_se_pre->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option class="cats under_op" id="' . $roo['cat_id'] . '" >
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $roo['title'] . '</option>';
                            }
                        }
                        ?>
                    </select><br>
                    <label>انتخاب تصویر</label>
                    :<input type="file" name="myfile" id="dokme" class="custom-file">
                    <input type="submit" value="افزودن" name="sub_news" id="sub" class="btn btn-success form-control">

                </form>
            </div>
        </div>
        <div class="col-md-1 col-lg-1"></div>
    </div>
    <script src="../js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            $(".cats").click(function () {
                var id = $(this).attr('id');
                alert(id);
                document.getElementById("get_cat").value = id;
            });
        });
    </script>
    </body>
    </html>

    <!--========================================php =============================== -->
<?php
include '../funcs/connection.php';
if (isset($_POST['sub_news'])) {
    $title = htmlspecialchars($_POST['title']);
    $descript = htmlspecialchars($_POST['descript']);
    $cat_id = $_POST['get_cat'];
    $user_id = $_SESSION['user_id'];
    if ($_FILES['myfile']) {
        $name = $_FILES['myfile']['name'];
        $tmp = $_FILES['myfile']['tmp_name'];
        if (move_uploaded_file($tmp, "../img/$name")) {
            if (strlen($title) != 0 && strlen($descript) != 0) {
                echo "file uploaded";
                $sql_insert = "INSERT INTO `tblnews` (`id_news`, `user_id`, `accept`, `datee`, `title`, `descript`, `cat_id`, `pic`) 
                          VALUES (NULL, '$user_id', '0', 'current_timestamp()', '$title', '$descript', '$cat_id', '$name');";
                $sql_insert_pre = $db->prepare($sql_insert);
                $sql_insert_pre->execute();
            }// end strlen !=0
            else {
                echo '<script>
                      var message="فیلد های خالی را پر کنید";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
               </script>';
            }// end else strlen
        } //end if move uploaded files
        else {

            echo "file does not uploaded";
        }//end else move uploaded files
    }// end $_FILES['myfile']
}// end isset submit