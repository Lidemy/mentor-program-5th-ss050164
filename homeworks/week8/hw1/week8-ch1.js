let times = 1000
// first, second, third, none, error
const result = [0, 0, 0, 0, 0]

while (times > 0) {
  calChance()
  times--
}

function calChance() {
  const request = require('request')
  let json
  request(
    'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery',
    (error, response, body) => {
      if (error) {
        return console.log('Failed to get prize', error)
      }
      try {
        json = JSON.parse(body)
        switch (json.prize) {
          case 'FIRST':
            result[0]++
            break
          case 'SECOND':
            result[1]++
            break
          case 'THIRD':
            result[2]++
            break
          case 'NONE':
            result[3]++
            break
          default:
            result[4]++
            return
        }
        if ((result.reduce((prev, curr) => prev + curr)) === 1000) {
          console.log(result)
        }
      } catch (error) {
        result[4]++
        return console.log('Body is not in JSON format', error)
      }
    }
  )
}

// [ 51, 203, 297, 390, 59 ]
// [ 52, 204, 290, 394, 60 ]
// [ 60, 195, 289, 410, 46 ]
// [ 34, 184, 306, 418, 58 ]
// [ 59, 204, 286, 390, 61 ]
// [ 284, 988, 1486, 2004, 238 ]
// 5%, 20%, 30%, 40%, 5%
