## 什麼是 Ajax？
- Asynchronous JavaScript and XML，中文直接翻譯是非同步 JavaScript 及 XML。簡單來說，是指 client 端送出請求後，不用等 server 端回傳 response，仍然可以繼續執行別的程式碼，等伺服器回傳 response 後，才會開始處理 response 的內容。

## 用 Ajax 與我們用表單送出資料的差別在哪？
- 如果是用表單傳送資料，會跳轉到另一個頁面，若是 AJAX 則不用更新頁面就可以傳送資料，也可以在同個頁面接收回傳的結果。

## JSONP 是什麼？
- JSON with Padding。主要是依據 `<script>` 標籤不會受到 CORS (同源政策) 限制的原理，來達成傳送資料的目的。在使用時會在 `<script>` 中放資料，再透過設定好的 function 將資料回傳。

## 要如何存取跨網域的 API？
- 如果不是用瀏覽器對跨網域的 API 發送 request，就不會受到 CORS 的限制，因為 CORS 是瀏覽器給的限制。 CORS 是指如果 request 的來源跟 server 不同 origin，瀏覽器仍會送出 request、 server 也會送出相對應的 response，但瀏覽器會將 response 擋下來的情形。
- 如果要用瀏覽器對跨網域的 API 發送 request，則 server 端回傳的 response header 需要加上 `Access-Control-Allow-Origin`，如果允許所有網域存取，則可以將此參數設為 `*`。 

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
- 同前一題第一點所述，因為第四周不是使用瀏覽器存取跨網域的 API，因此不會受到來自瀏覽器的 CORS 限制。