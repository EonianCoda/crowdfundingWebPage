<?php
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $DB_name = "data";

    function reset_DB()
    {
        global $servername, $username, $password, $DB_name;
        // Create connection
        $conn = mysqli_connect($servername, $username, $password);
        $sql = sprintf("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '%s'", $DB_name);
        $r = mysqli_query($conn, $sql);
        //Drop the same name DataBase 
        if(mysqli_num_rows($r) != 0)
        {
            $sql = sprintf("DROP DATABASE %s", $DB_name);
            mysqli_query($conn, $sql);
        }

        $sql = sprintf("CREATE DATABASE %s", $DB_name);
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        echo "重置資料庫成功" . '<br>';
    }
    function set_tables()
    {
        $SQL_path = 'init_SQL';

        global $servername, $username, $password, $DB_name;
        $SQL_files = scandir($SQL_path);
        if(!$SQL_files)
        {
            echo $SQL_path . "資料夾尚未建立";
            return;
        }


        $mysql_info = sprintf("mysql:host=%s;dbname=%s", $servername, $DB_name);

        $db = new PDO($mysql_info, $username, $password);


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