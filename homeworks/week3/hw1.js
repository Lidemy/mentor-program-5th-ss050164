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

function solve(input) {
  const n = Number(input[0])
  for (let i = 1; i <= n; i++) {
    printStars(i)
  }
}

function printStars(n) {
  let layer = ''
  for (let i = 1; i <= n; i++) {
    layer += '*'
  }
  console.log(layer)
}
