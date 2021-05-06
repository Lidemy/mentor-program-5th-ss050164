const request = require('request')

request(
  'https://lidemy-book-store.herokuapp.com/books?_limit=10',
  (error, response, body) => {
    if (error) {
      return console.log('Failed to list books', error)
    }

    let json
    try {
      json = JSON.parse(body)
    } catch (error) {
      console.log('Body is not in JSON format', error)
      return
    }

    for (let i = 0; i < json.length; i++) {
      console.log(json[i].id, json[i].name)
    }
  }
)
