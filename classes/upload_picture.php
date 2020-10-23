<?php

  class Upload
  {
      public function transfert($userid, $files)
      {
        $ret        = false;
        
        $img_blob   = '';
        $img_taille = 0;
        $img_type   = '';
        $query      ="";
        $img_nom    = '';
        $taille_max = 25000000; //20MB Limit
        $ret        = is_uploaded_file($files["file"]["tmp_name"]);

        if (!$ret) 
        {
          echo "transfert failed";
          return false;
        }else
        {
          $img_taille = $files['file']['size'];
          $img_taille = $files['file']['size'];
          $img_type = $files['file']['type'];
          $img_nom = $files['file']['name'];
          $img_blob = file_get_contents ($files['file']['tmp_name']);
          $query = "insert into pictures (userid) values ('$userid')";
          echo "cv shwiya";
          $DB = new Database(); 
          $DB->save($query);
          }
        }
      }
?>