## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
- DNS: domain name system，為可以將網域名跟 IP address 做對應的伺服器。可以讓使用者連上 www.google.com ，並不需要知道 Google網站 的 IP address。
- Google 宣稱他們提供的 Public DNS server，有三大類好處：Performance (效能)、Security (安全性)、Correctness (正確性)。
  1. Performance: 因為 Google DNS server 有建立大規模的 cache 以及 load balancer 去引導網路流量，因此可以提供更好的效能。
  2. Security: 因為 DNS 很容易受到各種攻擊，例如因 cache 被竄改、而將使用者引導至惡意網站或是被用做 DoS 攻擊。 Google 宣稱，已經在其 DNS 上，套用多種建議的 solution 並完全支援 DNSSEC protocol。此外，Google DNS server 也不會解析被他們判斷為有安全性威脅的網域。
  3. Correctness: Google DNS 會依據 DNS standards，每次均以正確答案去回覆每一個 query。另外如同上一點所提及，Google DNS 不會解析被他們判斷為有安全性威脅的網域。Google 也承諾 Public DNS server 不會 redirect 使用者。
- 個人認為對 Google 的好處可能是在於，這是可以搜集網站流量數據的其中一種方式? 再搭配使用者的地區、時間、裝置等資料，可以強化 Google 的搜尋引擎演算法。 

- 參考資料：https://developers.google.com/speed/public-dns/docs/intro

## 資料庫的 ACID 是什麼？
- ACID 是為了保證 Transaction 的正確性，而需要符合的四個特性。Transaction 可以用實際交易來做為例子，例如：
  1. 轉帳：A 轉帳 20 塊給 B，要保證 A 少 20塊的同時，B 多了 20 塊
  2. 購物網站：A 下單購買的同時，相對應品項的庫存數量要減少相同數量
  3. 其他會同時涉及多筆 query 的操作
- 原子性 atomicity: queries 只能是全部成功或是全部失敗 (例如：轉帳成功/失敗、下單成功/失敗)
- 一致性 consistency: 維持資料的一致性 (例如：錢的總數相同、賣出及庫存總數量相同)
- 隔離性 isolation: 多筆交易不會互相影響 (不能同時改同一個值)
- 持久性 durability: 交易成功之後，寫入的資料不會不見

## 什麼是資料庫的 lock？為什麼我們需要 lock？
- lock 是為了確保 ACID 中的 isolation、避免 race condition (也就是同時有多筆 transactions 對同一張表或是同一個 row 做存取)。
- Race condition 可能會使交易完之後的結果出現錯誤，例如使用者 A 及 B 同時下單同樣僅剩一個的商品，有可能會出現在讀取資料時，系統均回報有剩餘庫存，而讓兩個使用者下單成立，造成超賣的結果 (write skew)。
- lock 依鎖定的 scope 不同而分為：exclusive lock (不可讀取及不可存取)、shared lock (可讀取但不可存取)、range lock (不可讀取及不可存取某一個 range 內的資料)。

## NoSQL 跟 SQL 的差別在哪裡？
NoSQL 代表是 not only SQL。在 NoSQL database 的結構中，不存在 schema (tables, relations)，而是用 key-value 的方式來儲存資料，也因此並不支援以表格關聯為基礎的 JOIN 功能。通常用來儲存結構不固定的資料，像是 log。著名的 NoSQL database: MongoDB。