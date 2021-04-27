function join(arr, concatStr) {
  let result = ''
  for (let i = 0; i < arr.length; i++) {
    result = result + arr[i]
    if (i != arr.length - 1) {
      result = result + concatStr
    }
  }
  return result  
}

function repeat(str, times) {
  let result = ''
  for (let i = 0; i < times; i++) {
    result = result + str
  }
  return result
}
