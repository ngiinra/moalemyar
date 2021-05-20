<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link href="../css/custom.css" rel="stylesheet">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js"></script>
    <title>افزودن عکس اسلایدر</title>
</head>
<body dir="rtl">
<a href="userspanel.php" class="page-link bazgasht">بازگشت به صفحه کاربری</a>
<div class="alert alert-dark" id="alarm"><b></b></div>
<hr>
<form method="post" action="" id="frm" class="form-group" enctype="multipart/form-data">
    <label>انتخاب تصویر</label>
    :<input type="file" name="myfile" id="dokme" class="form-control-file" multiple>
    <label>متن زیر تصویر</label>
    :<textarea name="mytext" id="dokme" class="form-control" rows="5">

    </textarea>
    <input type="submit" value="افزودن" name="sub_slider" id="sub" class="btn btn-outline-info form-control">
</form>
<!-- ================================= show slider ==================== -->

    <div class="bd-example" >
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

            <?php
            include '../funcs/connection.php';
            $sql_select = "select * from  tblslider ";
            $sql_select_pre = $db->prepare($sql_select);
            $sql_select_pre->execute();
            $i = 0;
            while ($row_select = $sql_select_pre->fetch(PDO::FETCH_ASSOC)) {
                echo '
                   <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="' . $i . '" ></li>
                   </ol>
                   ';
                $i++;
            }
            while ($row_select = $sql_select_pre->fetch(PDO::FETCH_ASSOC)) {
                echo '
                   <div class="carousel-inner">
                        <div class="carousel-item ">
                           <img src="../img/slider/' . $row_select['slider_name'] . '" class="d-block w-100"  id="ax">
                           <div class="carousel-caption d-none d-md-block">
                               ' . $row_select['slider_text'] . '
                           </div>
                        </div>
                   </div>
            ';
            }
            echo '
              <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                   <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                   <span class="sr-only">Next</span>
              </a> ';
              ?>

            </div>
      </div>

 <?php
            // ================================== php ============================
            include '../funcs/connection.php';
            if (isset($_POST['sub_slider'])) {
                if ($_FILES['myfile']) {
                    $name = $_FILES['myfile']['name'];
                    $tmp = $_FILES['myfile']['tmp_name'];
                    $text = htmlspecialchars($_POST['mytext']);
                    if (move_uploaded_file($tmp, "../img/slider/$name")) {
                        if (strlen(trim($text)) != 0) {
                            $sql = "insert into  tblslider (`slider_id`,`slider_name`,`slider_text`)
                                values (null ,'$name','$text')";
                            $sql_pre = $db->prepare($sql);
                            $sql_pre->execute();
                        } else {
                            $sql = "insert into  tblslider (`slider_id`,`slider_name`,`slider_text`)
                                values (null ,'$name',null )";
                            $sql_pre = $db->prepare($sql);
                            $sql_pre->execute();
                        }

                        echo '
                   file uploaded
                  <script src="../js/jquery.js"></script>
                     <script>
                      var message=\"عکس شما روی اسلایدر معلم یار قرار گذفت\";
               $.post(
                   \"../funcs/alarm.php\",{msg:message},function(data){
                       $(\"#alarm\").html(data);
                   }
               );
               </script>';

                    }// end if move upload
                    else {
                        echo '
                      file does not uploaded
                     <script src="../js/jquery.js"></script>
                     <script>
                      var message=\"دوباره تلاش کنید\";
               $.post(
                   \"../funcs/alarm.php\",{msg:message},function(data){
                       $(\"#alarm\").html(data);
                   }
               );
               </script>';
                    }// end if move uploaded
                }
            }
            ?>

</body>
</html>