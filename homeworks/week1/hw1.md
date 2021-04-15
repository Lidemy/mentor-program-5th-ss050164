## 交作業流程
1. 在 local 端新建一個要拿來放作業的資料夾
2. 在 Command Line 以 `cd` 指令移至該資料夾
3. 以 `git clone repository 網址` 將 Lidemy 的作業複製一份到 local 資料夾
4. 在 Command Line 以 `cd` 指令移至複製下來的資料夾
5. 1 ~ 4 之後可以不用重複進行
6. 以 `git branch branchName` 建立新的分支
7. 以 `git checkout branchName` 移動到新的分支
8. 可以開始寫作業 (已有作業檔案)
9. 寫完之後使用 `git add .` 或 `git add 檔名` 將修改過的檔案放到 stage 中
10. 以 `git commit -m "打想要表達的訊息"` 在 local 端進行 commit
11. 也可以使用 `git commit -am "訊息"` 將前兩個步驟合併，因為寫作業，僅係修改檔案並未新增
12. 以 `git push origin branchName` 將 local 端的分支 push 到 github