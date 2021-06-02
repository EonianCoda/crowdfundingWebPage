<?php

  if (!function_exists('get_conn')) require_once("sql_info.php");

  //set time zone
  function gen_key()
  {
      return substr(str_shuffle(MD5(microtime())), 0, 10);
  }

  function register($POST)
  {
    /*Returns:
        0: register success
        1: duplicate account name
        2: unknow error on Insert new memeber
    */  
    
    $empty_project = '{"watch_list":[],"my_proposal":[],"follow":[]}';

    $conn = get_conn();
    $hash = password_hash($POST['password'] ,PASSWORD_DEFAULT);

    $sql = sprintf("SELECT id FROM members WHERE username = '%s'", $POST['username']);
    $r = mysqli_query($conn, $sql);

    //account name is defined
    if(mysqli_num_rows($r) != 0)
    {
      mysqli_close($conn);
      return 1;
    }

    $sql = sprintf("INSERT INTO members (username, password, realname, birthday, phone_number,
                  useremail, project, photo) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', 'None')", 
                  $POST['username'], $hash, $POST['realname'], $POST['birthday'], $POST['phone_number'], 
                  $POST['useremail'], $empty_project);

    //$sql = "INSERT INTO members (username, password) VALUES('$username', '$hash')";
    $r = mysqli_query($conn, $sql);
    mysqli_close($conn);
    //unknow error
    if(!$r) return 2;
    else return 0;
  }

  /* 
  Returns: status code
    0: login Success
    1: not found account
    2: password error
    3: unknown error on delete old session
    4: unknown error on insert new session
  */
  function login($POST)
  {
    $username = $POST['username'];
    $password = $POST['password'];

    $conn = get_conn();
    $sql = sprintf("SELECT id,password FROM members WHERE username = '%s'",$username);
    $r = mysqli_query($conn, $sql);
    //login fail
    if(mysqli_num_rows($r) == 0)
    {
      mysqli_close($conn);
      return 1;
    }
    //check password
    $r = mysqli_fetch_row($r);
    $user_id = $r[0]; 
    $hash = $r[1];

    
    if(!password_verify($password, $hash))
    {
      //password error
      mysqli_close($conn);
      return 2;
    }

    // set now_time
    $now_time = new DateTime();
    $now_time->setTimezone(new DateTimeZone('Asia/Taipei'));
    $now_time->add(new DateInterval('PT1H')); // 1 hours
    $now_time = $now_time->format('Y-m-d H:i:s');
    
    $key = gen_key();

    //delete existing login session
    $sql = sprintf("SELECT id FROM auth WHERE user_id = %d", $user_id);

    $r = mysqli_query($conn, $sql);

    if(mysqli_num_rows($r) != 0)
    {
      $r = mysqli_fetch_row($r);
      $sql = sprintf("DELETE FROM auth WHERE id = '%d'", $r[0]);
      $r = mysqli_query($conn, $sql);
      //unknown error
      if(!$r)
      {
        mysqli_close($conn);
        return 3;
      }
    }
  
    $sql = sprintf("INSERT INTO auth (auth_key,end,user_id) VALUES ('%s','%s',%d)", $key, $now_time, $user_id);
    $r =  mysqli_query($conn, $sql);
    //unknow error
    if(!$r)
    {
      mysqli_close($conn);
      return 4;
    }
    else 
    {
      session_start();
      $_SESSION['online_key'] = $key;
      mysqli_close($conn);
      return 0;
    }
  }

  function logout()
  {
    session_start();
    if(isset($_SESSION['online_key']))
    {
      $conn = get_conn();
      $sql = sprintf("SELECT id FROM auth WHERE auth_key = '%s'", $_SESSION['online_key']);
      $r = mysqli_query($conn, $sql);

      if(mysqli_num_rows($r) == 0)
      {
        mysqli_close($conn);
        unset($_SESSION['online_key']);
        return True;
      }
      //Delete the session in DB
      $r = mysqli_fetch_row($r);
      $sql = sprintf("DELETE FROM auth WHERE id = '%d'", $r[0]);
      $r = mysqli_query($conn, $sql);
      mysqli_close($conn);
    }
  }

  function authentication($key)
  {
    //Return: success =>user_id, fail=>0
    $now_time = date('Y-m-d H:i:s');
    $conn = get_conn();
    $sql = sprintf("SELECT id,user_id,end  FROM auth WHERE auth_key = '%s'", $key);
    $r =  mysqli_query($conn, $sql);
    if(!$r) return 0;
    else
    {
      $row = mysqli_fetch_row($r);
      $now_time = new DateTime();
      $now_time->setTimezone(new DateTimeZone('Asia/Taipei'));
      $now_time = $now_time->format('Y-m-d H:i:s');
      $auth_id = $row[0];
      $user_id = $row[1];
      $end_time = $row[2];
      if($now_time <= $end_time) return $user_id;
      else
      {
        //delete the outdated login session
        $sql = "DELETE FROM `auth` WHERE `auth`.`id` = $auth_id";
        mysqli_query($conn, $sql);
        return 0;
      }
    }
  }

  function only_for_members()
  {
    
    session_start();
    if(isset($_SESSION['online_key']))
    {
      if (authentication($_SESSION['online_key']) != 0)
      { 
        return;
      }
    }
    echo "<script type='text/javascript'>";
    echo sprintf("alert('%s');", "僅限會員使用，請先登入或註冊!");
    echo "window.location.href= '../main/login.php'";
    echo "</script>";
  }

  


  //$status_code = login("TEST", "123");


  // switch($status_code)
  // {
  //   case 0:
  //     echo "登入成功" . "<br>";
  //     break;
  //   case 1:
  //     echo "找不到帳號" . '<br>';
  //     break;
  //   case 2:
  //     echo "密碼錯誤" . '<br>';
  //     break;
  //   default:
  //     echo "不明錯誤" . '<br>';
  //     break;
  // }
?>