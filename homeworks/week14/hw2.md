## hw2：部署
我是使用 AWS EC2 + LAMP + phpMyAdmin + Gandi 服務完成部署。
1. AWS 的部分，主要在於要知道要選哪一項服務、選哪一個 server、設定哪些 protocol 可以存取。
2. 之後進到 ubuntu 主機並更新完之後，就開始設定安裝 LAMP。安裝完 Apache 跟 MySQL 之後，開始安裝 phpMyAdmin。
3. 安裝完所有軟體之後，有先創建另一個 MySQL 使用者帳號，並只提供操作網站所需要的權限 (例如某張表的 SELECT, UPDATE, INSERT, DELETE 等)，之後連線檔 (conn.php) 中的帳號是用這個為準。另外有看到建議是要把 conn.php 放在別的資料夾 (意即不要放在 `/var/www/html` 或是其子資料夾底下)。不過這次還懶得改其他檔案中有 require conn.php 的部分，之後有時間再嘗試修改。
4. 用 Filezila 以 SFTP 將網頁檔案上傳到伺服器中，並確認伺服器上的網站可以正常運作。
5. 去 Gandi 申請網址，申請到之後，在 Gandi 網站中修改 DNS 設定，將 A 連至 伺服器的 IP address，並確認用網域及子目錄均可正常連線。
6. 新增 ubuntu 主機中 `/etc/apache2/sites-available/` 的 conf 檔案，以對應想要的子網域。 (這邊設定完都要記得啟動新設定檔並重新啟動 Apache，常常會忘記...) 
7. 回 Gandi 上新增 CNAME DNS 設定。這邊有時生效要比較久，需要耐心等候。

總結來說，步驟其實蠻繁瑣的，加上對於 CLI 的指令也只會最基本的，需要一直查找資料確認要用到哪個指令，而過程中如果少打一個指令或是指令打錯字，就也可能會要花時間找出問題出在哪。