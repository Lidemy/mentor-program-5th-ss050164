## 六到十週心得與解題心得
### Week 6
這周開始接觸 HTML 跟 CSS，這算是我以前沒碰過的部分，硬要說的話可能只有國高中電腦課用過 Front Page 建網頁，會去改裡面的 HTML 原始碼，所以大概知道標的這種東西，CSS 則是完全沒接觸過。這周一開始老實說蠻痛苦的，跟前面學 JavaScript 差很多，有學過其他程式語言，學 JavaScript 不會有太大的障礙，就是要熟悉一下 `callback function` 這件事。但是 HTML 跟 CSS 就完全不是程式語言，感覺上比較像是要去熟悉網頁排版的規則，跟各個規則會呈現出來的樣式。所以第六周時也是有點覺得很茫然，因為完全只能看著影片跟著切，不過後來幾周多練習幾次之後，大概比較抓得住要怎麼去切版跟要用什麼屬性。有時無聊也會開始看網站原始碼是怎麼切出網頁或做出效果的。

### Week 7
這周開始把 JavaScript 用在網頁裡，主要是在監聽事件發生後，要讓網頁做出相對應的行為。這周又回到比較像前五周的感覺了，不過因為要熟悉跟 DOM 相關的 API，也是有花一些時間熟悉；然後也得知 HTML 是樹狀結構，但已想不起來幾年前修過資料結構裡面的東西，只約略記得有 root, parent, child, edge 這類的詞。這周作業雖然切出來的 To Do List 還是長蠻糟的 (從小就沒有美感)，但好像有一點覺得自己可以做出什麼了。

### Week 8
這周是網頁 + 用 JavaScript 串 API，雖然概念上跟第四周很像，但是從瀏覽器拿資料的語法跟在純 JavaScript 裡面發 request 還是有點差別，不過這部分就是熟悉一下就好了，比較困難的部分我覺得是 `callback function` 比第四周複雜很多，因為這周的 `callback function` 要將收到的資料呈現在網頁上，而不單單只是 parse 出結果。

### Week 9
這周又是一個不同的領域，從前端串到後端去，其實這周應該是我很久以前就想學的部分。以前在學校修資料庫有做過專案，課堂上就是教資料庫相關的東西 (ER model, normalization, SQL, PL/SQL, physical design, etc)，雖然專案重點在於資料庫 schema 的設計跟 triggers & procedures，但是期末專案還是要有前端網頁來做呈現，而當時同組的沒有人有前端經驗，最後是在其中一個組員熬了好幾天的夜，用 .NET framework & C# 刻出一個不美觀但功能堪用的前端，才順利解決；別組有前端經驗的，就用了 bootstrap 框架，架出看起來很炫砲的前端。當時專案我是負責寫所有 triggers & procedures (現在差不多忘光了..) 跟一半的一般 SQL (`SELECT`, `INSERT`, `UPDATE`, `DELETE`)，沒有餘力支援前端的部分，所以也是一直覺得有點缺憾。或許之後到計畫後半段課程學了框架、且有餘力，可以再把這個專案挖出來，架一個好一點的前端，不過也是要把後端用 ORACLE PL/SQL 寫的部分，改成 MySQL 的語法。

### Week 10
- 第一個小挑戰真的蠻短的，主要是要從網頁原始碼找到被附註起來的 php，跟從中知道 query string 要帶什麼參數進去，之後是要知道網頁元素可以被 CSS 隱藏起來，跟找出被 hash 的數字再代進參數、點按鈕。
- 第二個小挑戰有點想到古早的文字遊戲 MUD，總歸來說運用了很多前幾周的概念，有些可以在瀏覽器上解，有些用 curl or JavaScript 可以比較快，關卡有數字轉進位、被 hidden 的元素、註解不被顯示、偽元素、 window、 cookie、 找出在 response 裡面的資訊、依程式邏輯找出可以通過的字串，可惜第十一關的 API 掛了~