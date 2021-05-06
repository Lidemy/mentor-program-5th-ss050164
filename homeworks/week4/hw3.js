const request = require('request')
const process = require('process')

request(
  `https://restcountries.eu/rest/v2/name/${process.argv[2]}`,
  (error, response, body) => {
    if (error) {
      return console.log('Failed to search', error)
    }

    let json
    try {
      json = JSON.parse(body)
    } catch (error) {
      console.log('Body is not in JSON format', error)
      return
    }

    for (let i = 0; i < json.length; i++) {
      console.log('============')
      console.log(`國家: ${json[i].name}`)
      console.log(`首都: ${json[i].capital}`)
      console.log(`貨幣: ${json[i].currencies[0].code}`)
      console.log(`國碼: ${json[i].callingCodes}`)
    }
  }
)
