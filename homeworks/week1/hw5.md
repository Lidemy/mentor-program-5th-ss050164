## 請解釋後端與前端的差異。
- 前端主要是給使用者輸入或讀取資訊使用，例如網頁
- 後端則是處理前端送來的 request，並給出相對應的 response 再回傳，伺服器及資料庫都是屬於後端的部份


## 假設我今天去 Google 首頁搜尋框打上：JavaScript 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。
- 網頁中的程式會依使用者輸入的值，發出相對應的 request 封包，透過 router 及 DNS server 等的合作之下傳送到 Google 的 server
- Google server 接到 request 之後，會解析這個 request ，並依 request 到資料庫中找符合這個 request 的資料
- 透過一連串演算法決定出要顯現的資料及其先後順序後，生成 response 封包
- 將 response 透過網路回傳到使用者端
- 使用者的硬體及瀏覽器會解析 response ，再將結果呈現在瀏覽器上


## 請列舉出 3 個「課程沒有提到」的 command line 指令並且說明功用
- `wc`: 後面加檔案名稱，預設可以印出一個檔案有幾行 new line 、有幾個字、 有幾個byte
- `date`: 可以列出現在的時間，時區依電腦設定
- `type`: 後面加 Command ，會顯示出這個 Command 的 type