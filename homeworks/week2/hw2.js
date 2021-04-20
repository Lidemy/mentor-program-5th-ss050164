function capitalize(str) {
	if (str.charCodeAt(0) >= 97 && str.charCodeAt(0) <= 122) {
		str = String.fromCharCode(str.charCodeAt(0) - 32) + str.slice(1)
	}
	//str = str[0].toUpperCase() + str.slice(1)
	return str  
}

console.log(capitalize('hello'));