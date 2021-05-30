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
    
    reset_DB();
    set_tables();
?>