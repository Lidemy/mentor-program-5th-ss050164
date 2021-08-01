# hw1
## 程式碼如下：
```javascript
console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)
```

## 執行結果為：
```
1
3
5
2
4
```

## 執行過程：
1. 將 `console.log(1)` 放入 call stack 並執行，輸出 `1`，從 call stack pop `console.log(1)`。
2. 將 `setTimeout()` 放入 call stack 並執行，在達成所設定的條件後，意即定時 0 ms 後，將 call back function `() => {console.log(2)}` 放入 callback queue 等待。
3. 將 `console.log(3)` 放入 call stack 並執行，輸出 `3`，從 call stack pop `console.log(3)`。
4. 將 `setTimeout()` 放入 call stack 並執行，在達成所設定的條件後，意即定時 0 ms 後，將 call back function `() => {console.log(4)}` 放入 callback queue 等待。
5. 將 `console.log(5)` 放入 call stack 並執行，輸出 `5`，從 call stack pop `console.log(5)`。
6. 因為 call stack 已經清空，後續也沒有其他未排入的 function，因此開始將 callback queue 中之 function 排入 call stack。
7. 將 `() => {console.log(2)}` 放入 call stack 並執行，再將 `console.log(2)` 放入 call stack 並執行，輸出 `2`，從 call stack pop `console.log(2)`，最後從 call stack pop `() => {console.log(2)}`。
8. 將 `() => {console.log(4)}` 放入 call stack 並執行，再將 `console.log(4)` 放入 call stack 並執行，輸出 `4`，從 call stack pop `console.log(4)`，最後從 call stack pop `() => {console.log(4)}`。
9. 結束。