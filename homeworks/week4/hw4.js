const request = require('request')
const process = require('process')

const clientID = 'tpdkp7cv9zhne97341r6xl07qpwf1q'
const acceptValue = 'application/vnd.twitchtv.v5+json'
let limit = ''

if (process.argv[2] > 0) {
  limit = `?limit=${process.argv[2]}`
}

const options = {
  url: `https://api.twitch.tv/kraken/games/top${limit}`,
  headers: {
    Method: 'GET',
    Accept: acceptValue,
    'Client-ID': clientID
  }
}

request(
  options,
  (error, response, body) => {
    const json = JSON.parse(body)
    for (let i = 0; i < json.top.length; i++) {
      console.log(json.top[i].viewers, json.top[i].game.name)
    }
  }
)
