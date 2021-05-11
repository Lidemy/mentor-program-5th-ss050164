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
  const arr = lines[1].split(' ')
  for (let i = 0; i < arr.length; i++) {
    arr[i] = Number(arr[i])
  }

  const upper = arr[arr.length - 1]
  const count = []
  for (let i = 0; i <= upper; i++) {
    count.push(0)
  }
  for (let i = 0; i < arr.length; i++) {
    count[arr[i]]++
  }

  let max = -Infinity
  for (let i = 1; i < count.length; i++) {
    max = count[i] > max ? count[i] : max
  }

  console.log(max)
}
