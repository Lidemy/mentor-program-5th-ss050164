## 什麼是 DOM？
- Document Object Model，文件物件模型，是一個提供存取 HTML、XML 及 SVG 等文件的 API 。在 DOM 中，會將各類文件以樹狀結構來表示。
- 樹狀結構是由 Node 組成，若將 HTML 以樹狀結構來表示，則一般會產生四種類型的 Node：document, element, text, attribute.
 - Document: 即指整份文件。
 - Element: 即 HTML 中的各類標籤，例如 `body`, `div`, `h1`, `footer` 等
 - Text: 被標籤包起來的文字，例如 `<h1>I am the title</h1>` 中的 `I am the title`
 - Attribute: 標籤的屬性，例如`<div class="block">The div</div>` 中的 `block`：但貌似目前 attribute node 已被淘汰、不使用

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
- HTML DOM 中，事件傳遞機制順序為: 
  1. Capture Phase 捕獲階段
  2. Target Phase
  3. Bubbling Phase 冒泡階段
- 捕獲階段：將事件從 root node，透過層層 node 與 node 之間的連結 ( link )，以 parent 傳到 child 的方向，傳遞到 target (會是一個 element node)
- 冒泡階段：從 target，以 child 傳到 parent 的方向，將事件傳回 root node。

## 什麼是 event delegation，為什麼我們需要它？
- 中文為事件代理機制。意即可以透過 parent node 去監聽 child nodes 的事件。
- 假設一個 parent node 底下有多個 child node，若是選擇在 child node 的層級加上 event listener，會使得資源浪費 (每一個 child 都要有一個 event listener)，因此若透過 parent node 監聽，因為只需要一個 event listener，可以節省資源。
- 此外，假設有動態新增 child node 的需求，如果選擇在 child node 的層級加 event listener，會使得新增的 child node 不會被監聽到，若是透過 parent node，則不會有此問題。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
- `event.preventDefault()` 不會阻止事件傳遞，但會取消瀏覽器預設會執行的動作，例如送出表單、跳至另一個網頁、新開分頁等。一旦 call 了這個 function，效果會繼續存在於之後傳遞的事件中。
- `event.stopPropagation()` 是用於阻止事件繼續傳遞，在捕獲跟冒泡階段都適用。
- 以下方 HTML 及 Javascript 為例
``` html
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FE102-2</title>  
  <style>
    .inner {
      background: green;
      height: 100px;
      width: 200px;
    }
    .outer {
      background: navy;
      height: 200px;
      width: 400px;
    }
  </style>
</head>
<body>
  <div class="outer">
    <div class="inner">
      <button class="btn" data-value="1">1</button>
    </div>
  </div>
</body>
</html>
```
``` javascript
    document.querySelector(".outer").addEventListener("click", (e) => {
     console.log(".outer capture")
    }, true)
    document.querySelector(".inner").addEventListener("click", (e) => {
     console.log(".inner capture")
    }, true)
    document.querySelector(".btn").addEventListener("click", (e) => {
     console.log(".btn capture")
    }, true)

    document.querySelector(".outer").addEventListener("click", (e) => {
     console.log(".outer bubbling")
    }, false)
    document.querySelector(".inner").addEventListener("click", (e) => {
     console.log(".inner bubbling")
    }, false)
    document.querySelector(".btn").addEventListener("click", (e) => {
     console.log(".btn bubbling")
    }, false)
```
- 在未加`event.preventDefault()` 及 `event.stopPropagation()` 之情況下，點擊 button 在 console 會出現以下結果 ( Chrome 瀏覽器)：
```
.outer capture
.inner capture
.btn capture
.btn bubbling
.inner bubbling
.outer bubbling
```
- 然而若在 `.inner` 的捕獲階段加上 `event.stopPropagation()`
```javascript
    document.querySelector(".inner").addEventListener("click", (e) => {
      e.stopPropagation()
     console.log(".inner capture")
    }, true)
```
則點擊 button 在 console 會只出現以下結果，因為在 inner 捕獲後，事件傳遞已經被阻止
```
.outer capture
.inner capture
```
- 如果是在 `.inner` 的捕獲階段改為加上 `event.preventDefault()`
```javascript
    document.querySelector(".inner").addEventListener("click", (e) => {
      e.preventDefault()
     console.log(".inner capture")
    }, true)
```
則點擊 button 在 console 會仍會出現未加上之前的結果，這是因為 `event.preventDefault()` 並不會阻止事件傳遞，而是取消瀏覽器預設會執行的動作。
```
.outer capture
.inner capture
.btn capture
.btn bubbling
.inner bubbling
.outer bubbling
```