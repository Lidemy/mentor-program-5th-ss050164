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
  const arrayA = []
  const arrayB = []
  for (let i = 1; i < lines.length; i++) {
    if (lines[i] === 'A') {
      arrayA.push(i)
    } else {
      arrayB.push(i)
    }
  }

  if (arrayA.length === arrayB.length || arrayA.length === 0 || arrayB.length === 0) {
    console.log('PEACE')
  } else if (arrayA.length < arrayB.length) {
    for (let i = 0; i < arrayA.length; i++) {
      console.log(arrayA[i])
    }
  } else {
    for (let i = 0; i < arrayB.length; i++) {
      console.log(arrayB[i])
    }
  }
}
