const request = require('request')
const process = require('process')

const baseURL = 'https://lidemy-book-store.herokuapp.com/books'
const action = process.argv[2]
const firstParameter = process.argv[3]
const secondParameter = process.argv[4]

switch (action) {
  case 'list':
    listBooks()
    break
  case 'read':
    readBook(firstParameter)
    break
  case 'create':
    createBook(firstParameter)
    break
  case 'update':
    updateBook(firstParameter, secondParameter)
    break
  case 'delete':
    deleteBook(firstParameter)
    break
  default:
    console.log('Invalid action. Please try again')
}

function listBooks(error, response, body) {
  request(
    `${baseURL}?_limit=20`,
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
}

function readBook(bookID) {
  request(
    `${baseURL}/${bookID}`,
    (error, response, body) => {
      if (error) {
        return console.log('Failed to read a book', error)
      }

      let json
      try {
        json = JSON.parse(body)
      } catch (error) {
        console.log('Body is not in JSON format', error)
        return
      }
      console.log(json.id, json.name)
    }
  )
}

function createBook(bookName) {
  request.post(
    {
      url: `${baseURL}/`,
      form: {
        name: bookName
      }
    },
    (error, response, body) => {
      if (error) {
        return console.log('Failed to create a new book', error)
      }
      console.log('Created a new book!')
      console.log(body)
    }
  )
}

function updateBook(bookID, bookName) {
  request.patch(
    {
      url: `${baseURL}/${bookID}`,
      form: {
        name: bookName
      }
    },
    (error, response, body) => {
      if (error) {
        return console.log('Failed to update the book', error)
      }
      console.log('Updated the book!')
      console.log(body)
    }
  )
}

function deleteBook(bookID) {
  request.del(
    {
      url: `${baseURL}/${bookID}`
    },
    (error, response, body) => {
      if (error) {
        return console.log('Failed to delete the book', error)
      }
      console.log('Deleted the book!')
    }
  )
}
