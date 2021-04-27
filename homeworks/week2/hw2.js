function capitalize(str) {
  if (str.charCodeAt(0) >= 97 && str.charCodeAt(0) <= 122) {
    str = String.fromCharCode(str.charCodeAt(0) - 32) + str.slice(1)
  }
  return str
}
