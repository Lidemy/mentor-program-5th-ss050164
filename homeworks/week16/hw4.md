# hw4
## 程式碼如下：
```javascript
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello() // ??
obj2.hello() // ??
hello() // ??
```

## 執行結果
```
2
2
undefined
```

## 執行過程
1. 在 `global EC` 中宣告並初始化 object `obj`、object `obj2`以及function `hello`。
2. 執行 `obj.inner.hello()`，接著執行 `console.log(this.value)`，由於呼叫 `hello()` 的是 `obj.inner`，因此 `this` 指的會是 `obj.inner`，而 `obj.inner` 的 `value` 是 `2`，輸出會因而會是 `2`。
執行 `obj2.hello()`，接著執行 `console.log(this.value)`，由於呼叫 `hello()` 的是 `obj2`，而 `obj2` 指向的位置與 `obj.inner` 所指向的相同，因此 `this` 指的會是 `obj.inner`，而 `obj.inner` 的 `value` 是 `2`，輸出會因而會是 `2`。
3. 執行 `hello()`，接著執行 `console.log(this.value)`，由於 `this` 跟 function 怎麼被呼叫有關，而此行 `hello()` 並未透過物件呼叫，因此這邊的 `this` 在 Node.js 環境會是指向 `global`，在瀏覽器會是指向 `window`，而這兩個物件都沒有被定義 `value` 這個值，且並未使用 `use strict` mode，輸出因而會是 `undefined`。