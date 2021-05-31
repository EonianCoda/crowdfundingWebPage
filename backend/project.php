<?php
    if (!function_exists('authentication')) require_once("account.php");
    $max_imgname_len = 35;


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


        $file_path = sprintf('../images/projects/%d/', $project_id);
        if (!file_exists($file_path)) mkdir($file_path);

        
        move_img('main_img', $file_path);
        for($i = 1; $i <= $intro_img_num; $i++)
        {
            move_img('intro_img' . $i, $file_path);
        }
        return 0;
    }

?>