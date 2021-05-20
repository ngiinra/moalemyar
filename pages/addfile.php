<?php
include '../funcs/connection.php';
if (isset($_POST['sub_files'])) {
    $lesson = $_POST['lessons'];
    if ($_FILES['myfile']) {
        $name = $_FILES['myfile']['name'];
        $tmp = $_FILES['myfile']['tmp_name'];
        if (move_uploaded_file($tmp, "../files/$name")) {
            $sql_insert = "INSERT INTO `tblfile` (`id`, `lesson_id`, `file_address`) VALUES (NULL, '$lesson', '$name')";
            $sql_insert_pre = $db->prepare($sql_insert);
            $sql_insert_pre->execute();
        } else {
            echo '<script>
                      var message="فیلد های خالی را پر کنید";
               $.post(
                   "../funcs/alarm.php",{msg:message},function(data){
                       $("#alarm").html(data);
                   }
               );
               </script>';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مشاهده نمرات</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
</head>
<body dir="rtl">
<a href="userspanel.php" class="page-link bazgasht"> بازگشت به صفحه کاربری </a>
<div class="alert alert-dark" id="alarm"><b></b></div>
<hr>
<div class="container">
    <form action="" method="post" class="form-group" id="frm" enctype="multipart/form-data">
        <h3 class="h_3">افزودن فایل نمونه سوال برای دانش آموزان</h3>
        <label>نام درس</label>
        <select name="lessons" class="form-control custom-select">
            <?php
            include '../funcs/connection.php';
            $sql_les = "select * from tbllesson";
            $sql_les_pre = $db->prepare($sql_les);
            $sql_les_pre->execute();
            while ($row_les = $sql_les_pre->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $row_les['lesson_id'] . '" >' . $row_les['lname'] . '</option>';
            }
            ?>
        </select>
        :<input type="file" name="myfile" id="dokme" class="custom-file">
        <input type="submit" value="افزودن" name="sub_files" id="sub" class="btn btn-success form-control">

    </form>
</div>
</body>
</html>
