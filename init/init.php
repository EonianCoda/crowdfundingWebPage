<?php
    require_once("../backend/sql_info.php");

    function reset_DB()
    {
        global $mysql_servername, $mysql_username, $mysql_password, $mysql_DB_name;
        // Create connection
        $conn = mysqli_connect($mysql_servername, $mysql_username, $mysql_password);
        $sql = sprintf("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '%s'", $mysql_DB_name);
        $r = mysqli_query($conn, $sql);
        //Drop the same name DataBase 
        if(mysqli_num_rows($r) != 0)
        {
            $sql = sprintf("DROP DATABASE %s", $mysql_DB_name);
            mysqli_query($conn, $sql);
        }

        $sql = sprintf("CREATE DATABASE %s", $mysql_DB_name);
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        echo "重置資料庫成功" . '<br>';
    }
    function set_tables()
    {
        $SQL_path = 'init_SQL';

        global $mysql_servername, $mysql_username, $mysql_password, $mysql_DB_name;
        $SQL_files = scandir($SQL_path);
        if(!$SQL_files)
        {
            echo $SQL_path . "資料夾尚未建立";
            return;
        }


        $mysql_info = sprintf("mysql:host=%s;dbname=%s", $mysql_servername, $mysql_DB_name);

        $db = new PDO($mysql_info, $mysql_username, $mysql_password);


        for($i = 2; $i < count($SQL_files); $i+=1)
        {
            $file = sprintf("./%s/%s", $SQL_path, $SQL_files[$i]);
            echo "執行SQL檔案" . $file . '<br>';
            $sql = file_get_contents($file); 

            $r = $db->exec($sql);
            if($r == 1)
            {
                echo "SQL:" . $SQL_files[$i] . " 發生問題!";
                return;
            }
        }
        echo "初始化成功" . "<br>";
    }
    function addProject()
{
    $conn = get_conn();
    if (($handle = fopen("project.tsv", "r")) !== FALSE)
    {
        //ignore first three row
        $data = fgetcsv($handle, 1000, "\t");
        $data = fgetcsv($handle, 1000, "\t");
        $data = fgetcsv($handle, 1000, "\t");
        $i = 1;
        while (($row = fgetcsv($handle, 1000, "\t")) !== FALSE) 
        {
            $row[1] = substr($row[1],0, strlen($row[1]) - 1);
            $sql = sprintf("INSERT INTO `project` (`id`, `name`, `category`, `goal_money`, `now_money`, `begin_date`, `end_date`, `main_img`, `info`, `organizer`, `sponsor_num`, `tracking_num`) VALUES (%d, '%s', '%s', '%d', '%d', '%s', '%s', '%s', '%s', '%d', '%d', '%d')",
            $row[0],
            $row[1],
            $row[2],
            $row[3],
            $row[4],
            $row[5],
            $row[6],
            $row[7],
            $row[8],
            $row[9],
            $row[10],
            $row[11]
            ); 
            $r = mysqli_query($conn, $sql);
            if(!$r)
            {
                echo $sql . "<br>";
                echo "line" . $i. "失敗" . "<br>";
            }
            else
            {
                echo "加入project:" . $row[1] . "成功<br>";
            }
            $i++;
        }
        fclose($handle);
    }
    echo "加入project成功" . "<br>";
}

    function addmembers()
    {
        $conn = get_conn();
        if (($handle = fopen("members.csv", "r")) !== FALSE)
        {
            //ignore first three row
            $data = fgetcsv($handle, 1000);
            $data = fgetcsv($handle, 1000);
            $data = fgetcsv($handle, 1000);
            
            $i = 1;
            while (($row = fgetcsv($handle, 1000)) !== FALSE) 
            {
                $sql = sprintf("INSERT INTO `members` (`id`, `username`, `realname`, `password`, `birthday`, `phone_number`, `useremail`, `photo`, `project`) VALUES (%d, '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s')",
                $row[0],
                $row[1],
                $row[2],
                $row[3],
                $row[4],
                $row[5],
                $row[6],
                $row[7],
                $row[8],
                );

                $r = mysqli_query($conn, $sql);
                if(!$r)
                {
                    echo "line" . $i. "失敗" . "<br>";
                }
                
               
                else
                {
                    echo "加入member:" . $row[1] . "成功<br>";
                }
                $i++;
            }
            fclose($handle);
    }
    else
    {
        echo "找不到檔案". "<br>";
        return;
    }
    echo "加入members成功!" . "<br>";
    }
    reset_DB();

    set_tables();
    addProject();
    addmembers();
?>