# crowdfundingWebPage
It is a web page for crowdfuningWebPage.

# 注意事項
每次檔案進行更新時，請務必進行資料庫的初始化，不然可能出現不明錯誤。

## 修改php.init中關於檔案上傳大小限制的部分

### 第一步
開啟開始，找到AppServ資料夾，

### 第二步
選擇PHP Edit php.ini

### 第三步
Ctrl+F 
尋找 upload_max_filesize:
將upload_max_filesize = 2M，改為upload_max_filesize = 10M

尋找 post_max_size:
將post_max_size = 8M，改為post_max_size = 100M

### 第四步
重啟Apache: Apache Restart
重啟mysql: MySQL Stop -> MySQL Start

## 初始化資料庫

### 第一步
將整份檔案放入local host中
### 第二步
修改檔案backend/sql_info.php，修改$mysql_username與$mysql_password為本地mysql的帳號密碼
### 第三步
開啟網址/init/init.php，進行資料庫的初始化
### 第四步
可正常使用登入與註冊功能
