function printFactor(n) {
	console.log(1)
	for(var i = 2; i <= n; i++) {
		if(n % i === 0) {
			console.log(i)
		}
	}  
}

printFactor(10);