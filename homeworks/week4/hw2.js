const request = require('request')
const process = require('process')

if (process.argv[2] === 'list') {
  request(
    'https://lidemy-book-store.herokuapp.com/books?_limit=20',
    (error, response, body) => {
      const json = JSON.parse(body)
      for (let i = 0; i < json.length; i++) {
        console.log(json[i].id, json[i].name)
      }
    }
  )
}

if (process.argv[2] === 'read') {
  const bookID = process.argv[3]
  request(
    `https://lidemy-book-store.herokuapp.com/books/${bookID}`,
    (error, response, body) => {
      const json = JSON.parse(body)
      console.log(json.id, json.name)
    }
  )
}

if (process.argv[2] === 'create') {
  request.post(
    {
      url: 'https://lidemy-book-store.herokuapp.com/books/',
      form: {
        name: process.argv[3]
      }
    }
  )
}

if (process.argv[2] === 'update') {
  const bookID = process.argv[3]
  request.patch(
    {
      url: `https://lidemy-book-store.herokuapp.com/books/${bookID}`,
      form: {
        id: bookID,
        name: process.argv[4]
      }
    }
  )
}

if (process.argv[2] === 'delete') {
  const bookID = process.argv[3]
  request.del(
    {
      url: `https://lidemy-book-store.herokuapp.com/books/${bookID}`
    }
  )
}
