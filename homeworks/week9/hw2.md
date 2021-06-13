## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
- 不同資料庫，甚至是版本，在這兩個欄位上的差別可能有所不同，如果以 MySQL 8.0 為例，可以參考：https://dev.mysql.com/doc/refman/8.0/en/blob.html
- 在 MySQL 8.0 中有兩個主要差別：
  1. 如果要為 TEXT 欄位建立 INDEX，則必須指定 prefix length，而對於 VARCHAR 來說，prefix length 是 optional。 Prefix length 是指要用該欄位多少個 characters 來建立 INDEX。不過，有看到一些文章說，以前版本的 MySQL 不能在 TEXT 欄位中加上 INDEX。
  2. 另一個差別是 VARCHAR 可以指定 DEFAULT 值，TEXT 則否。不過在 MySQL 8.0 中，可以用 expression 的方式設定 TEXT 欄位的 DEFAULT 值。同樣也是有看到一些文章說，以前版本的 MySQL 是完全不能設定 TEXT 欄位的預設值。

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？
- 一個網站中可能有多個網頁，若要讓伺服器知道，對不同頁面發出的 request 是同一個使用者發出，避免每跳轉一個頁面，server 就認不出使用者，因此出現了 SESSION 機制。
- Cookie 則是實現 SESSION 的一種方法。在瀏覽器第一次發 request 給 server後，server 回應的 respond 中就會帶有設定 Cookie 的資訊，瀏覽器會依此設定 Cookie，之後如果繼續處在同一個 SESSION 中發送 request，瀏覽器會在 request 的 header 中帶上 Cookie 的資訊。之後，server 端收到 Cookie 的資訊，即可判斷是哪一位使用者。

## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
1. 使用者名稱跟密碼沒有設定規則。
2. 使用 http 而非 https，封包未經加密。
3. 從 Dev Tool 中的 Network，可以看出 submit 出去的 form data。若封包被欄截，帳密就會被洩露。