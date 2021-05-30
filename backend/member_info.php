<?php
  if (!function_exists('authentication')) require_once("account.php");
  function get_personal_info()
  {
      session_start();

      if(!isset($_SESSION['online_key']))
      {
        
        return NULL;
      }
      
      $user_id = authentication($_SESSION['online_key']);

      $conn = get_conn();
      
      
      $sql = "SELECT username, realname, useremail, phone_number, photo FROM members WHERE id = $user_id";
      $r = mysqli_query($conn, $sql);
      //Unknow error
      if(mysqli_num_rows($r) == 0) return NULL;
      else
      {
          $r = mysqli_fetch_row($r);
          $user_data = array(
            "username" => $r[0],
            "realname" => $r[1],
            "useremail"   => $r[2],
            "phone_number"  => $r[3],
            "photo" => $r[4]
          );
          return $user_data;
      }
  }
  function get_personal_img($user_data)
  {
    if($user_data['photo'] == "None")
    {
        $img_path = "../images/members/default.jpg";
    }
    else
    {
        $img_path = sprintf("../images/members/%s/%s",$user_data['username'], $user_data['photo']);
    }
    echo $img_path;
  }
?>