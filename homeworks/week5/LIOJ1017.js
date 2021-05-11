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
  const C = Number(lines[0])
  const N = Number(lines[1])
  const arr = []
  for (let i = 2; i < lines.length; i++) {
    arr.push(Number(lines[i]))
  }

  arr.sort((a, b) => b - a)

  let sum = 0
  const limit = C < N ? C : N
  for (let i = 0; i < limit; i++) {
    sum += arr[i]
  }
  console.log(sum)
}
