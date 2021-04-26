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
  const n = Number(lines[0])
  for (let i = 1; i < n + 1; i++) {
    const set = lines[i].split(' ')
    set[0] = BigInt(set[0])
    set[1] = BigInt(set[1])
    set[2] = Number(set[2])
    console.log(win(set[0], set[1], set[2]))
  }
}

function win(A, B, K) {
  if (K === 1) {
    if (A > B) {
      return 'A'
    } else if (B > A) {
      return 'B'
    } else {
      return 'DRAW'
    }
  } else {
    if (A < B) {
      return 'A'
    } else if (B < A) {
      return 'B'
    } else {
      return 'DRAW'
    }
  }
}
