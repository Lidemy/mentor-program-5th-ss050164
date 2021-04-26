const readline = require('readline')

const lines = []
const rl = readline.createInterface({
  input: process.stdin
})

rl.on('line', (line) => {
  lines.push(line)
})

rl.on('close', () => {
  solve(lines)
})

function solve(lines) {
  const arr = lines[0].split(' ')
  for (let i = 0; i < arr.length; i++) {
    arr[i] = Number(arr[i])
  }

  for (let i = arr[0]; i <= arr[1]; i++) {
    const digits = []
    let input = i

    do {
      digits.push(input % 10)
      input = Math.floor(input / 10)
    } while (Math.floor(input) > 0)

    let sum = 0
    for (let j = 0; j < digits.length; j++) {
      sum = sum + Math.pow(digits[j], digits.length)
    }
    if (sum === i) {
      console.log(sum)
    }
  }
}
