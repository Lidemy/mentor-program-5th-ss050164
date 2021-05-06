const request = require('request')
const process = require('process')

const clientID = 'tpdkp7cv9zhne97341r6xl07qpwf1q'
const acceptValue = 'application/vnd.twitchtv.v5+json'
const game = process.argv[2]
const limit = 100
let offset = 0

const options = {
  url: `https://api.twitch.tv/kraken/streams/?game=${game}&limit=${limit}&offset=${offset}`,
  headers: {
    Method: 'GET',
    Accept: acceptValue,
    'Client-ID': clientID
  }
}

function getStreams() {
  request(options,
    (error, response, body) => {
      if (error) {
        return console.log('Failed to get streams')
      }

      let json
      try {
        json = JSON.parse(body)
      } catch (error) {
        console.log('Body is not in JSON format', error)
        return
      }
      for (let i = 0; i < json.streams.length; i++) {
        console.log(json.streams[i].channel.status, json.streams[i].channel._id)
      }
      if (offset < 100) {
        offset = 100
        options.url = `https://api.twitch.tv/kraken/streams/?game=${game}&limit=${limit}&offset=${offset}`
        getStreams()
      }
    }
  )
}

getStreams()
