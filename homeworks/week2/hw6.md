``` js
function isValid(arr) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] <= 0) return 'invalid'
  }
  for(var i=2; i<arr.length; i++) {
    if (arr[i] !== arr[i-1] + arr[i-2]) return 'invalid'
  }
  return 'valid'
}

isValid([3, 5, 8, 13, 22, 35])
```

## 執行流程
1. 執行第 1 行，宣告 function `isValid`
2. 執行第 11 行，呼叫 `isValid`
3. 回到第 1 行執行 `isValid`，並將 `arr` 指向儲存input array ，即 [3, 5, 8, 13, 22, 35] ， 的記憶體位置
4. 執行第 2 行，初始化變數 `i` ，並將 0 assign 給 `i` ，檢查 `i` 是否小於 `arr` 的長度 6 ，是，繼續執行，開始進入第一個迴圈
5. 執行第 3 行，判斷 `arr[0]` ，也就是 3 是否小於等於 0 ，不是，跳出 if
6. 跑回第 2 行， `i++` ， `i` 變為 1 ，檢查 `i` 是否小於 `arr` 的長度 6 ，是，繼續執行，進入第二個迴圈
7. 執行第 3 行，判斷 `arr[1]` ，也就是 5 是否小於等於 0 ，不是，跳出 if
8. 跑回第 2 行， `i++` ， `i` 變為 2 ，檢查 `i` 是否小於 `arr` 的長度 6 ，是，繼續執行，進入第三個迴圈
9. 執行第 3 行，判斷 `arr[2]` ，也就是 8 是否小於等於 0 ，不是，跳出 if
10. 跑回第 2 行， `i++` ， `i` 變為 3 ，檢查 `i` 是否小於 `arr` 的長度 6 ，是，繼續執行，進入第四個迴圈
11. 執行第 3 行，判斷 `arr[3]` ，也就是 13 是否小於等於 0 ，不是，跳出 if
12. 跑回第 2 行， `i++` ， `i` 變為 4 ，檢查 `i` 是否小於 `arr` 的長度 6 ，是，繼續執行，進入第五個迴圈
13. 執行第 3 行，判斷 `arr[4]` ，也就是 22 是否小於等於 0 ，不是，跳出 if
14. 跑回第 2 行， `i++` ， `i` 變為 5 ，檢查 `i` 是否小於 `arr` 的長度 6 ，是，繼續執行，進入第六個迴圈
15. 執行第 3 行，判斷 `arr[5]` ，也就是 35 是否小於等於 0 ，不是，跳出 if
16. 跑回第 2 行， `i++` ， `i` 變為 6 ，檢查 `i` 是否小於 `arr` 的長度 6 ，不是，跳出第一個 for loop 的 block
17. 執行第 5 行，初始化變數 `i`，並將 2 assign 給 `i` ，檢查 `i` 是否小於 `arr` 的長度 6 ，是，繼續執行，開始進入第一個迴圈
18. 執行第 6 行，判斷 `arr[2]` 是否不等於 `arr[1]` 加 `arr[0]` ，也就是 8 是否不等於 5 + 3 ，不是，跳出 if
19. 執行第 5 行，`i++`， `i` 變為 3 ，檢查 `i` 是否小於 `arr` 的長度 6 ，是，繼續執行，進入第二個迴圈
20. 執行第 6 行，判斷 `arr[3]` 是否不等於 `arr[2]` 加 `arr[1]` ，也就是 13 是否不等於 8 + 5 ，不是，跳出 if
21. 執行第 5 行，`i++`， `i` 變為 4 ，檢查 `i` 是否小於 `arr` 的長度 6 ，是，繼續執行，進入第三個迴圈
22. 執行第 6 行，判斷 `arr[4]` 是否不等於 `arr[3]` 加 `arr[2]` ，也就是 22 是否不等於 13 + 8 ，是，回傳 string `invalid`
23. 執行完畢