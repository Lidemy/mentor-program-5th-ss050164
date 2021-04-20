## 跟你朋友介紹 Git
- Git 是一套版本控制的軟體，可以保存所有修改的 log，主要是為避免在同一專案需要同時修改或新增多個功能時，產生版本混淆，或使得原本穩定版本無法繼續使用的情形，而在多人協作同一專案時，此功能更為重要。
 
#### 菜哥的需求
1. 首先要先打開 terminal (iOS) 或 Git Bash (Windows)
2. 以 `cd` 指令移動到笑話資料夾，或是先以 `mkdir` 建立新的笑話資料夾，再以 `cd` 指令移動
3. 在資料夾下輸入 `git init`，使該資料夾進入 git 的版本控制
4. 可以開始建立笑話檔案，在此是假設是第一次建笑話檔案
5. 以 `git add .` 將所有新建的笑話放入 stage 中
6. 以 `git commit -m "想打的訊息"` ，讓 git 建立一個版本記錄
7. 之後若要再新增或修改笑話，要先以 `git branch branchName`新開分支，避免直接改在主檔 (假設主檔為 main)
8. 以 `git checkout branchName` 移動到分支底下
9. 開始改或新增笑話
10. 以 `git add .` 將所有新建或修改過的笑話放入 stage 中
11. 以 `git commit -m "想打的訊息"` ，讓 git 建立一個版本記錄
12. 若這次沒有新增檔案，可以將前兩步驟以 `git commit -am "想打的訊息"` 合併執行
13. 若之後確定分支上的檔案均已修改完成，以 `git checkout main` 移動到主檔底下，再以 `git merge branchName` 將分支上的改動合併進來
14. 若確定檔案間沒有衝突，則可以 `git branch -d branchName` 將剛剛的分支刪除；若有衝突，則需先解決衝突

###### Github
1. 若也想在遠端也存有一份檔案，可以申請 Github 帳戶
2. 在 Github也建立一個 repository ，之後回到 CLI，以`git remote add origin repository的網址`設定 local 端與 Github的連結
3. 以 `git push -u origin main` 將本地主檔推送到 Github 上
4. 之後若在 local 端建立新的 branch 修改，也可以將 branch 推送到 Github上，指令為 `git push -u origin branchName`
5. 之後使用 Github 的 pull request 功能將遠端的 main 及 branch 進行 merge
6. 以 `git pull origin main` 將在 Github上整合好的 main 抓下來並與 local端的 main 進行 merge
7. 若沒有發生衝突，則可以 `git branch -d branchName` 將 local 端的 branch 刪除；若有衝突，則需先解決衝突
8. 使用 Github 好處是可以較容易看出檔案的改動，而留言功能，在多人協做時，可以使 code review 及溝通更為便利