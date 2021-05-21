## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
- `<address>`：用來標示聯絡資訊 (例如 email、聯絡電話等) 的標籤，雖然外觀效果跟 `<i>` 及 `<em>` 相同，但 `<address>` 有語義上的意義。
- `<video>`：在網頁中嵌入影片的標籤，可以設定長、寬、是否重複播放等；也可以用來嵌入音檔，但若要嵌入音檔，`<audio>` 會較為合適
- `<textarea>`：類似 `<input type="text">`，可以讓使用者輸入文字，最大的不同應該是可以設定輸入框的高度、輸入多行文字。 

## 請問什麼是盒模型（box model）
- 指的是，在 HTML 及 CSS 的架構中，每一個元素都可以當做一個盒子來看待。盒子的組成由內到外包含 `content` (內容), `padding` (內邊距), `border` (邊框)，而盒子跟盒子間的距離則是稱為 `margin` (外邊距)。
- 在預設的情況下 (即 `box-sizing` 為 `content-box`)，元素的長跟寬是指 `content` 的長跟寬，整個元素實際上的長寬會需要再加上 `padding` 及 `border` 的部份。而若將 `box-sizing` 設定為 `border-box`，則元素的長跟寬即是指 `content` + `padding` + `border`。

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
- `inline`: 例如 `span` 跟 `a`，content 的長跟寬不能調整，但可以跟別的 `inline` 或 `inline-block` 元素併排。
- `block`: 例如 `div`, `p`, `h1` 等標籤，特點是什麼屬性都可以調，但會佔滿所在區塊一整個橫條，意即在同一區塊內的同一橫列中不會有別的元素。
- `inline-block`: 兼有 `inline` 及 `block` 的特性，什麼屬性都可以調、又可以跟別的 `inline` 或 `inline-block` 元素併排。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
- `static`: 預設的定位，`top`, `right`, `bottom`, `left`, `z-index` 屬性無效。 
- `relative`: 以原本該在點的做為定位點，只會影響該個元素，不會影響別的元素的位置，意即不會改變網頁部局。
- `absolute`: 從該元素往上找，碰到的第一個非 `static` 的元素做為定位點。
- `fixed`: 相對於瀏覽器的位置 (精確來說是 viewport) 做定位。
- 如果前一個元素是以 `absolute` 或 `fixed` 做為定位，可以將前一個元素視為被抽走、適用另一個座標系，因此在 `absolute` 或 `fixed` 元素後面的元素，會遞補到 `absolute` 或 `fixed` 元素在原本 `static` 情況下的位置。