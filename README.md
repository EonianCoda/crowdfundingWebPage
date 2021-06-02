# 群眾募資網頁


## 注意事項
每次檔案進行更新時，請務必進行資料庫的初始化，不然可能出現不明錯誤。

### 修改php.ini中關於檔案上傳大小限制的部分

1. 開啟windows的「開始列表」，找到AppServ資料夾
2. 選擇資料夾下的PHP Edit php.ini，進行php.ini的修改 
3. 使用Ctrl+F搜尋關鍵字「upload_max_filesize」，將`upload_max_filesize = 2M`修改為`upload_max_filesize = 10M`
4. 使用Ctrl+F搜尋關鍵字「post_max_size」，將`post_max_size = 10M`修改為`post_max_size = 100M`
5. 重啟Apache：點選AppServ資料夾下的「Apache Restart」
6. 重啟mysql: 先點選AppServ資料夾下的「MySQL Stop」，接著點選「MySQL Start」

### 初始化資料庫

1. 確定整份檔案放入AppServ的www資料夾中
2. 修改檔案./backend/sql_info.php，修改`$mysql_username`與`$mysql_password`的值為本地mysql的帳號,密碼
3. 開啟網址localhost/<該檔案資料夾名稱>/init/init.php，進行資料庫的初始化
4. 可正常使用登入與註冊功能

