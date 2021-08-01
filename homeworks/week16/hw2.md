# hw2
## 程式碼如下：
```javascript
for (var i = 0; i < 5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}
```

## 執行結果
```
i: 0
i: 1
i: 2
i: 3
i: 4
5
5
5
5
5
```

## 執行過程
1. 進入 for 迴圈，宣告全域變數 `i`，並 assign 0 給 `i`，檢查 `i` 是否小於 5。
2. `i` 小於 5，因此進入 block，將 `console.log('i: ' + i)` 放入 call stack 並執行，輸出 `i: 0`，從 call stack pop `console.log('i: ' + i)`。
3. 將 `setTimeout()` 放入 call stack 並執行，在達成所設定的條件後，意即定時 0 * 1000 ms 後，將 call back function `() => {console.log(i)}` 放入 callback queue 等待。
4. for loop block 中無其他程式碼須執行，故執行 `i++`，`i` 的值變為 1。進入下一圈迴圈前，檢查 `i` 是否小於 5。
5. `i` 小於 5，因此進入 block，將 `console.log('i: ' + i)` 放入 call stack 並執行，輸出 `i: 1`，從 call stack pop `console.log('i: ' + i)`。
6. 將 `setTimeout()` 放入 call stack 並執行，在達成所設定的條件後，意即定時 1 * 1000 ms 後，將 call back function `() => {console.log(i)}` 放入 callback queue 等待。
7. for loop block 中無其他程式碼須執行，故執行 `i++`，`i` 的值變為 2。進入下一圈迴圈前，檢查 `i` 是否小於 5。
8. `i` 小於 5，因此進入 block，將 `console.log('i: ' + i)` 放入 call stack 並執行，輸出 `i: 2`，從 call stack pop `console.log('i: ' + i)`。
9. 將 `setTimeout()` 放入 call stack 並執行，在達成所設定的條件後，意即定時 2 * 1000 ms 後，將 call back function `() => {console.log(i)}` 放入 callback queue 等待。
10. for loop block 中無其他程式碼須執行，故執行 `i++`，`i` 的值變為 3。進入下一圈迴圈前，檢查 `i` 是否小於 5。
11. `i` 小於 5，因此進入 block，將 `console.log('i: ' + i)` 放入 call stack 並執行，輸出 `i: 3`，從 call stack pop `console.log('i: ' + i)`。
12. 將 `setTimeout()` 放入 call stack 並執行，在達成所設定的條件後，意即定時 3 * 1000 ms 後，將 call back function `() => {console.log(i)}` 放入 callback queue 等待。
13. for loop block 中無其他程式碼須執行，故執行 `i++`，`i` 的值變為 4。進入下一圈迴圈前，檢查 `i` 是否小於 5。
14. `i` 小於 5，因此進入 block，將 `console.log('i: ' + i)` 放入 call stack 並執行，輸出 `i: 4`，從 call stack pop `console.log('i: ' + i)`。
15. 將 `setTimeout()` 放入 call stack 並執行，在達成所設定的條件後，意即定時 4 * 1000 ms 後，將 call back function `() => {console.log(i)}` 放入 callback queue 等待。
16. for loop block 中無其他程式碼須執行，故執行 `i++`，`i` 的值變為 5。進入下一圈迴圈前，檢查 `i` 是否小於 5。
17. 由於 `i` 等於 5，不符合條件，故跳出 for loop。 因為 call stack 已經清空，後續也沒有其他未排入的 function，因此開始將 callback queue 中之 function 排入 call stack。
18. 將 `() => {console.log(i)}` 放入 call stack 並執行，再將 `console.log(i)` 放入 call stack 並執行，輸出 `5`，從 call stack pop `console.log(i)`，最後從 call stack pop `() => {console.log(i)}`。
19. 將 `() => {console.log(i)}` 放入 call stack 並執行，再將 `console.log(i)` 放入 call stack 並執行，輸出 `5`，從 call stack pop `console.log(i)`，最後從 call stack pop `() => {console.log(i)}`。
20. 將 `() => {console.log(i)}` 放入 call stack 並執行，再將 `console.log(i)` 放入 call stack 並執行，輸出 `5`，從 call stack pop `console.log(i)`，最後從 call stack pop `() => {console.log(i)}`。
21. 將 `() => {console.log(i)}` 放入 call stack 並執行，再將 `console.log(i)` 放入 call stack 並執行，輸出 `5`，從 call stack pop `console.log(i)`，最後從 call stack pop `() => {console.log(i)}`。
22. 將 `() => {console.log(i)}` 放入 call stack 並執行，再將 `console.log(i)` 放入 call stack 並執行，輸出 `5`，從 call stack pop `console.log(i)`，最後從 call stack pop `() => {console.log(i)}`。
23. 結束。