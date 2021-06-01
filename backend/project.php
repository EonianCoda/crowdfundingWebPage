<?php
    if (!function_exists('authentication')) require_once("account.php");
    $max_imgname_len = 35;



    function gen_money_str($money)
    {
        $money = intval($money);
        $money_str = "";
        $money_str = $money_str . ($money % 1000);
        $money = intval($money / 1000);
        while($money > 0)
        {
            $money_str = ($money % 1000) . ',' . $money_str;
            $money = intval($money / 1000);
            break;
        }
        $money_str = "NT$ " . $money_str;
        return $money_str;
    }

    function cal_remain_day($end_date)
    {
        date_default_timezone_set('Asia/Taipei');
        //calculate the remaining day
        $now_time = date("Y-m-d H:i:s");
        $now_time = new DateTime($now_time, new DateTimeZone('Asia/Taipei'));
        $end_date = new DateTime($end_date, new DateTimeZone('Asia/Taipei'));
        $diff = date_diff($end_date, $now_time);
        $diff = $diff->format('%a');
        if(intval($diff) == 0) $diff = 1;
        return $diff;
    }
    function change_img_name($old_name, $new_name)
    {
        $pos = strpos($old_name, ".");
        $ext = substr($old_name, $pos, strlen($old_name) - intval($pos));
        return $new_name . $ext;
    }
    function move_img($name, $file_path)
    {
        $file_get = $_FILES[$name]['name'];
        if($file_get == '') return;
        $temp = $_FILES[$name]['tmp_name'];
        $file_to_saved = $file_path . $file_get;
        move_uploaded_file($temp, $file_to_saved);
    }
    /*Returns:
        0: add success
        1: not select category
        2: end_date cannot be earlier than now
        4: the goal money is 0
        5: not login
        6: the project name already defined
        7: the img has the same name        
        8: unknown error
    */

    function new_proposal()
    {
        global $max_imgname_len;
        $intro_img_num = 5;
        session_start();
        if(!isset($_SESSION['online_key'])) return 5;
        $user_id = authentication($_SESSION['online_key']);

        //set timezone
        date_default_timezone_set('Asia/Taipei');

        //not select category
        if($_POST['category'] == "0") return 1;

        //end date is earlier than now date
        $now_time = date("Y-m-d H:i:s");
        if ($now_time > $_POST['end_date']) return 2;

        $_FILES['main_img']['name'] = change_img_name($_FILES['main_img']['name'], 'main_img');
        for($i = 1; $i <= $intro_img_num; $i++)
        {
            $img_name = "intro_img" . $i;  
            if($_FILES[$img_name]['name'] != '') 
                $_FILES[$img_name]['name'] = change_img_name($_FILES[$img_name]['name'], $img_name);
        }
        
        //the goal money is 0
        if(intval($_POST['goal_money']) == 0) return 4;
        

        $conn = get_conn();

        //the project name already defined
        $sql = sprintf("SELECT id from project WHERE name = '%s'",$_POST['name']);
        $r = mysqli_query($conn, $sql);
        if(mysqli_num_rows($r) != 0) return 6;


        $info = sprintf('{"intro":"%s","content":"%s","contact":"%s","intro_img":{"1":"%s","2":"%s","3":"%s","4":"%s","5":"%s"}}',
                        $_POST['intro"'],
                        $_POST['content'],
                        $_POST['contact'],
                        $_FILES['intro_img1']['name'],
                        $_FILES['intro_img2']['name'],
                        $_FILES['intro_img3']['name'],
                        $_FILES['intro_img4']['name'],
                        $_FILES['intro_img5']['name']
                        );


        $sql = sprintf("INSERT INTO project(name,category,goal_money,begin_date,end_date,main_img,organizer,info) VALUES('%s','%s','%d','%s','%s','%s','%d','%s')",
                $_POST['name'],
                $_POST['category'],
                intval($_POST['goal_money']),
                $now_time,
                $_POST['end_date'],
                $_FILES['main_img']['name'],
                $user_id,
                $info
                );

        $r = mysqli_query($conn, $sql);
        if(!$r) return 6;
        
        
        $sql = sprintf("SELECT id from project WHERE name = '%s'",$_POST['name']);
        $r = mysqli_query($conn, $sql);
        $project_id = mysqli_fetch_row($r)[0];
        mysqli_close($conn);


        $file_path = sprintf('../images/project/%d/', $project_id);
        if (!file_exists($file_path)) mkdir($file_path);

        
        move_img('main_img', $file_path);
       
        for($i = 1; $i <= $intro_img_num; $i++)
        {
            move_img('intro_img' . $i, $file_path);
        }
        return 0;
    }

    /*
    only get the main picture, name, 
    */
    function get_proj_sim_info($id)
    {
        $conn = get_conn();

        mysqli_close($conn);
    }

    /*Returns:
        NULL: no this id
    */
    function get_info($id)
    {
        $conn = get_conn();
        $sql = sprintf("SELECT id,name,main_img,goal_money,now_money,begin_date, end_date,info,organizer,sponsor_num,tracking_num FROM project WHERE id = %s", $id);
        $r = mysqli_query($conn, $sql);

        $result = array(
            "name" => "",
            "main_img" => "",
            "now_money"   => "",
            "ratio"   => -"",
            "remain_day"  => "",
            "begin_date" => "",
            "end_date" => "",
            "sponsor_num" => "",
            "tracking_num" => "",
            "organizer" => ""
        );
        
        if(!$r) return NULL;
        $row = mysqli_fetch_row($r);
        
        $result['name'] = $row[1];
        $result['main_img'] = sprintf("../images/project/%d/%s", $row[0], $row[2]);
        //calculate the money
        $result['now_money'] = gen_money_str($row[4]);
        $result['ratio'] = intval((floatval($row[4]) / floatval($row[3])) * 100) . '%';
        //calculate the remaining day
        $result['remain_day'] = cal_remain_day($row[6]);
        $result['begin_date'] = $row[5];
        $result['end_date'] = $row[6];
        $result['sponsor_num'] = $row[9];
        $result['tracking_num'] = $row[10];


        $result['info'] = json_decode($row[7], true);
        for($i = 1; $i < 5; $i++)
        {
            $img_name = $result['info']["intro_img"][strval($i)];
            if($img_name != "")
            {
                $result['info']["intro_img"][strval($i)] = sprintf("../images/project/%d/%s", $row[0], $img_name);
            }
        }

        $sql = sprintf("SELECT username from members WHERE id = %s",$row[8]);
        $r = mysqli_query($conn, $sql);
        if(!$r) return NULL;
        $organ_name = mysqli_fetch_row($r)[0];
        $result['organizer'] = $organ_name;
        
        
        mysqli_close($conn);
        return $result;
    }


    function get_proj($cond)
    {
        $conn = get_conn();
        $sql = sprintf("SELECT id,name,main_img,goal_money,now_money,end_date FROM project %s", $cond);
        $r = mysqli_query($conn, $sql);
        date_default_timezone_set('Asia/Taipei');

        $result = array();
        $template = array(
            "id" => "",
            "name" => "",
            "main_img" => "",
            "now_money"   => "",
            "ratio"   => -"",
            "remain_day"  => "",
        );

        $i = 0;
        while ($row = mysqli_fetch_row($r)) 
        {
            $template['id'] = $row[0];
            $template['name'] = $row[1];
            $template['main_img'] = sprintf("../images/project/%d/%s", $row[0], $row[2]);
            

            //calculate the money
            $template['now_money'] = gen_money_str($row[4]);
            $template['ratio'] = intval((floatval($row[4]) / floatval($row[3])) * 100) . '%';

            //calculate the remaining day
            $template['remain_day'] = cal_remain_day($row[5]);

            //add to result
            $result[$i] = $template;
            $i++;
        }

        mysqli_close($conn);
        return $result;
    }

    function search_proj($category = 1)
    {   
        $cond = sprintf("WHERE category = %s", $category);
        $result = get_proj($cond);
        return $result;
    }

    function get_hot()
    {
        $cond = "ORDER BY sponsor_num, tracking_num LIMIT 6";
        $result = get_proj($cond);
        return $result;
    }
?>