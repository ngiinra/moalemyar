<?php
session_start();
ob_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../js/jquery.js" rel="stylesheet">
    <link href="../css/bootstrap4rtl.css" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0 auto;
            direction:rtl
        }

        .dashboard {
            width: 100%;
            height: 80px;
            background-color: lightseagreen;
            text-align: center;
        }
        body{line_height:40px; margin: 0 auto}
        .dashboard span{display:inline-block; font-size: large;  padding:20px}
        a{text-decoration :none ; display:block ; padding:30px ;margin: 0 auto; text-align:center; background: -webkit-linear-gradient(top ,lightgray, white); color:black}
        a:hover {text-decoration: none ; background: -webkit-linear-gradient(top , white ,lightgray); color:seagreen}
    </style>

</head>
<body >
<div class="dashboard">
<span>
    <?php echo $_SESSION['fullname']." به پنل مدیریتی خود خوش آمدید."; ?>
</span>
</div>
<div class="underdash">
    <?php
    include '../funcs/connection.php';
    $userid=$_SESSION['user_id'];
    $sql ="select * from tbluser
               join tblpanel on (tblpanel.user_id=tbluser.user_id and tblpanel.user_id='$userid'
               and tblpanel.show_id='1' )
               join tbloptions on (tblpanel.op_id=tbloptions.op_id )";
    $sql_pre=$db->prepare($sql);
    $sql_pre->execute();
     while($row =$sql_pre->fetch(PDO::FETCH_ASSOC)){
             echo 
                 '<a href=" '.$row['pages'].' ">
                   '.$row['title'].'
                  </a>';
      }
    ?>
</div>
</body>
</html>