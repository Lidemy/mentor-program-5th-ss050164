## Webpack 是做什麼用的？可以不用它嗎？
- Webpack 是一個用於專案打包的工具。最核心功能在於將 JavaScript 打包、建立各個模組間的關聯，最後依據專案需求產出一個或多個打包好的檔案，之後 HTML 檔案在需要引入 JavaScript 模組時，引入 Webpack 打包好的檔案即可。而除了打包 JavaScript 以外，Webpack 可以透過各種 loader 及 plugin 支援其他檔案類靈的打包 (CSS、Sass、圖片等)、`minify`、`uglify`、ES6 轉 ES5 等功能。
- 會需要 Webpack 的理由是，瀏覽器並不支援 Node.js 環境下的 `require` 及 `module.exports`。若要在瀏覽器上使用 JavaScript 模組，會需要透過寫額外 function 來讓瀏覽器可以執行。而如果是要引入透過 npm 安裝的第三方模組，則更是浩大的工程。但總而言之，理論上，不用 Webpack 也不會讓整個專案無法進行，但會需要自己額外處理引入 JavaScript 模組的問題。

## gulp 跟 webpack 有什麼不一樣？
- gulp 是任務管理工具，在使用者設定任務腳本流程後，可以用於任務自動化執行。因此如果沒有使用 gulp 協助管理，使用者會需要自己記得要執行哪些繁瑣的流程，再一個一個自己手動執行。
- 雖然在 FE201 的課程中，我們所看到 gulp 跟 webpack 所產生的結果很類似，例如都可以 minify 檔案、將JavaScript從新語法轉至舊語法等，但兩個工具想要解決的問題並不相同，webpack 為了解決瀏覽器對於 JavaScript 模組支援度，而 gulp 則是提供讓各種專案任務可子自動化進行。

## CSS Selector 權重的計算方式為何？
- CSS Selector 權重指的是 CSS 規則的優先權。當有兩個 CSS selectors 作用在同一個元素，那權重高的會生效；如果兩個權重相同，則後面出現的 selector 會蓋掉前面的 selector。
- 各 selector 權重由大至小為 `inline-style` (1, 0, 0, 0)  > `ID` (0, 1, 0, 0) > `class` & `pseudo-class` & `attribute` (0, 0, 1, 0) > `element` & `pseudo-element` (0, 0, 0, 1)
- 另外有一個例外，如果在 CSS 樣式參數後面加上 `!important`，則可以蓋過其他 selector 預設的權重。若要蓋過 `!important`，則只能在後面的規則中再出現一次 `!important`。