<?php
if (isset($_POST['send'])){
      if($_FILES['myfile']){
          $name=$_FILES['myfile']['name'];
          $tmp=$_FILES['myfile']['tmp_name'];
          if(move_uploaded_file($tmp,"../img/$name")){
              echo "file uploaded";
          }else{

              echo "file doas not uploaded";
          }
      }}else {
          ?>
          <html>
          <head>

          </head>
          <body>
          <form method="post" action="" enctype="multipart/form-data">
              <input type="file" name="myfile">
              <input type="submit" value="send" name="send">
          </form>
          </body>
          </html>
          <?php
      }