# hw3
## 程式碼如下：
```javascript
var a = 1
function fn() {
  console.log(a)
  var a = 5
  console.log(a)
  a++
  var a
  fn2()
  console.log(a)
  function fn2() {
    console.log(a)
    a = 20
    b = 100
  }
}
fn()
console.log(a)
a = 10
console.log(a)
console.log(b)
```

## 執行結果
```
undefined
5
6
20
1
10
100
```

## 執行過程
1. 在 global execution context (簡稱 EC) 中宣告全域變數 `a` 及 function `fn`。
2. 將 1 assign 給 `a`
3. 執行 function `fn`，進入 `fn` 的 EC。宣告 `fn EC` 內的變數 `a` 及 function `fn2`。
4. 執行 `console.log(a)`，因為有變數 `a` 存在於 `fn EC`，且尚未 assign value 給這個 `a`，故會輸出 `undefined`。
5. 執行 `var a = 5`，將 5 assign `fn EC` 內的變數 `a`。
6. 執行 `console.log(a)`，因為目前 `fn EC` 的變數 `a` 為 5，故會輸出 `5`。
7. 執行 `a++`，將 `6` assign 給 `fn EC` 的變數 `a`。
8. 又在 `fn EC` 宣告一次變數 `a`，但是在同個 EC 裡面已經宣告過變數 `a`，故 JavaScript 會忽略這一句。
9. 執行 function `fn2`，進入 `fn2` 的 EC。因為 `fn2 EC` 沒有宣告變數或 function，故會直接開始執行。
10. 執行 `console.log(a)`，但因為 `fn2 EC` 中沒有存在變數 `a`，因此會往上一層，也就是 `fn EC` 尋找是否有變數 `a`。因為有在 `fn EC` 中找到變數 `a`，輸出 `6`。
11. 執行 `a = 20`，但因為 `fn2 EC` 中沒有存在變數 `a`，因此會往上一層，也就是 `fn EC` 尋找是否有變數 `a`。因為有在 `fn EC` 中找到變數 `a`，會將 20 assign 給這個變數 `a`。
12. 執行 `b = 100`，但因為 `fn2 EC` 中沒有存在變數 `b`，因此會往上一層，也就是 `fn EC` 尋找是否有變數 `b`。但是在 `fn EC` 中也沒有找到變數 `b`，會再往上一層找，也就是 `global EC`。然而，`global EC` 中也沒有宣告過 `b`，因此 JavaScript 會在 `global EC` 宣告全域變數 `b`，並將 100 assign 給 `b`。
13. `fn2` 執行完畢，`fn2 EC` 被移除。
14. 執行 `console.log(a)`，因為目前 `fn EC` 的變數 `a` 為 20，故會輸出 `20`。
15. `fn` 執行完畢，`fn EC` 被移除。
16. 執行 `console.log(a)`，因為目前 `global EC` 的變數 `a` 為 1，故會輸出 `1`。
17. 執行 `a = 10`，將 10 assign 給 `global EC` 中的變數 `a`。
18. 執行 `console.log(a)`，因為目前 `global EC` 的變數 `a` 為 10，故會輸出 `10`。
19. 執行 `console.log(b)`，因為目前 `global EC` 的變數 `b` 為 100，故會輸出 `100`。