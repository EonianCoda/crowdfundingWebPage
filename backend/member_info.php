<?php
  if (!function_exists('authentication')) require_once("account.php");


/*
Returns:
    0: Success
    1: old password error
    2: unknow error
*/
  function edit_password($old_password, $new_password)
  {
    session_start();
    if(!isset($_SESSION['online_key'])) return NULL;
    $user_id = authentication($_SESSION['online_key']);
    $conn = get_conn();
    
    $sql = "SELECT password FROM members WHERE id = $user_id";
    $r = mysqli_query($conn, $sql);
    //Unknow error
    if(mysqli_num_rows($r) == 0) return 2;

    $r = mysqli_fetch_row($r);
    if(!password_verify($old_password, $r[0])) return 1;

    $new_password = password_hash($new_password ,PASSWORD_DEFAULT);
    $sql = sprintf("UPDATE members SET password = '%s' WHERE id = %s",$new_password, $user_id);
    $r = mysqli_query($conn, $sql);
    //Unknow error
    if(!$r) return 2;

    //edit success
    return 0;
  }


  /*Returns:
      0: edit success
      1: username has already defined
      2: the length of photo is too long
      3: unknow error
  */
  function edit_profile($POST, $FILES)
  {
      session_start();
      if(!isset($_SESSION['online_key'])) return NULL;
      $user_id = authentication($_SESSION['online_key']);
      $conn = get_conn();
      
      $sql = sprintf("SELECT id FROM members WHERE username = '%s' and id != '%d'", $POST['username'], $user_id);
      $r = mysqli_query($conn, $sql);
      if(mysqli_num_rows($r) != 0) return 1;
      

      $sql = "SELECT photo FROM members WHERE id = $user_id";
      $r = mysqli_query($conn, $sql);
      $origin_img = mysqli_fetch_row($r)[0];

      $POST['photo'] = $FILES['photo']['name'];
      
      //default photo
      if($POST['photo'] == "") $POST['photo'] = $origin_img;
      if(strlen($POST['photo']) >= 35) return 2;
      $sql = sprintf("UPDATE members SET username = '%s', realname = '%s', useremail = '%s',phone_number = '%s',photo = '%s' WHERE id = $user_id",
              $POST['username'],
              $POST['realname'],
              $POST['useremail'],
              $POST['phone_number'],
              $POST['photo']
              );
      $r = mysqli_query($conn, $sql);
      //unknow error
      if(!$r) return 3;

      //move picture
      if($FILES['photo']['name'] != "")
      {
        $file_get = $FILES['photo']['name'];
        $temp = $FILES['photo']['tmp_name'];
        $file_path = sprintf('../images/members/%s/', $POST['username']);
        if (!file_exists($file_path)) mkdir($file_path);
        if($origin_img != "None") unlink($file_path . $origin_img);
        $file_to_saved = $file_path . $file_get;
        //echo $file_to_saved;
        move_uploaded_file($temp, $file_to_saved);
      }
      return 0;
  }
  function get_personal_info()
  {
      session_start();
      if(!isset($_SESSION['online_key'])) return NULL;
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

  function get_user_project_list()
  {
    session_start();
    $user_id = authentication($_SESSION['online_key']);
    $conn = get_conn();
    $sql = "SELECT project FROM members WHERE id = $user_id";
    $r = mysqli_query($conn,$sql);
    $r = mysqli_fetch_row($r)[0];

    $id_list = json_decode($r, true);
    return $id_list;
  }

?>