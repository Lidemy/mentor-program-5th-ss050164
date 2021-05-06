## 請以自己的話解釋 API 是什麼
- Application Programming Interface，是一個讓人傳送特定格式的資料以獲取、修改或新增資訊的界面。 對於使用者而言，只需要知道如何以 API 規範的格式發出 request，就可以進行 API 已定義好的功能，而不需要知道程式內部是如何進行資訊處理，這感覺跟 OOP 的封裝 (Encapsulation) 是類似的概念。
- 如果以飲料販賣機簡單舉例而言，投錢就類似要丟到 API 裡的必要的參數，按按鍵為用定義好的方式發送請求，按鍵種類為各種不同功能，掉出來的飲料則是使用者想得到的結果；使用者完全不需要知道販賣機內部是怎麼讓特定飲料掉出來，只要按對按鍵就可以拿到想要的飲料；當然，如果販賣機內部設定錯誤 (猶如 API 內部有 bug)，也是有可能掉出不是使用者 request 的飲料，或是根本沒掉飲料出來。

## 請找出三個課程沒教的 HTTP status code 並簡單介紹
- `403` 用戶端的錯誤回應之一，代表用戶端沒有權限存取，因此伺服器拒絕給予回應而給出的 response
- `405` 用戶端的錯誤回應之一，代表用戶端使用了不被該伺服器允許使用的 Method，常見的例子是網頁伺服器會被設定為拒絕 `PUT`、`DELETE`，以防止資料被修改
- `505` 伺服器端的錯誤回應之一，代表伺服器不支援或拒絕支援在 request 中使用的 HTTP 版本

## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

### 回傳餐廳資料
---
#### Url
`GET https://lidemy-restaurant.herokuapp.com/restaurants`

#### Optional query parameters
| Name | Type | Description |
| ------------- | ------------- | ------------- |
| `limit`  | integer | Maximum number of objects to return. Default: 10. Maximum: 100. |
| `offset`  | integer | Object offset for pagination of reults. Default: 0. Maximum: 500.|

### 回傳單一餐廳資料
---
#### Url
`GET https://lidemy-restaurant.herokuapp.com/restaurants/<restaurant ID>`

#### Optional query parameters
None

### 刪除餐廳
---
#### Url
`DELETE https://lidemy-restaurant.herokuapp.com/restaurants/<restaurant ID>`

#### Optional query parameters
None

### 新增餐廳
---
#### Url
`POST https://lidemy-restaurant.herokuapp.com/restaurants`

#### Parameters
| Name | Type | Description |
| ------------- | ------------- | ------------- |
| `name` | string | 餐廳名稱 |

#### Optional query parameters
| Name | Type | Description |
| ------------- | ------------- | ------------- |
| `category` | string | 餐廳類型 |
| `addr` | string | 餐廳地址 |
| `phone` | string | 餐廳電話 |

### 修改餐廳資訊
---
#### Url
`PUT https://lidemy-restaurant.herokuapp.com/restaurants/<restaurant ID>`

#### Parameters
| Name | Type | Description |
| ------------- | ------------- | ------------- |
| `name` | string | 餐廳名稱 |

#### Optional query parameters
| Name | Type | Description |
| ------------- | ------------- | ------------- |
| `category` | string | 餐廳類型 |
| `addr` | string | 餐廳地址 |
| `phone` | string | 餐廳電話 |
