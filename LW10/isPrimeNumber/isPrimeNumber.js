function isPrime(number) {
    let sqrt_number = Math.trunc(number);
    for (let divider = 2; divider < sqrt_number; divider++) {
        if (sqrt_number % divider == 0) {
            return false;
        }
    }
    return true;
}

function generateResponse(arg) {
    if (Number.isInteger(arg)) {
        if (arg > 1) {
            return arg + (isPrime(arg) ? ' простое число' : ' составное число');
        }
        return arg + ' не является простым или составным числом';
    }
    return arg + ' не является натуральным числом';
}

function isPrimeNumber(arg) {
    let response = 'Результат: ';
    let temp = [];
    if (!Array.isArray(arg)) {
        arg = [arg];
    }
    for (const value of arg) {
        temp.push(generateResponse(value));
    }
    response += temp.join(';\n');
    return response;
}

console.log(isPrimeNumber());
console.log(isPrimeNumber(3));
console.log(isPrimeNumber(0));
console.log(isPrimeNumber(1));
console.log(isPrimeNumber(4));
console.log(isPrimeNumber(-1));
console.log(isPrimeNumber('3'));
console.log(isPrimeNumber('lol'));
console.log(isPrimeNumber([1, 2, 3, 4, 8, 10, -4, 7, 11, 13, 0.1, 0.0, 1.1, 1.7, 5.4, 'проверка']));
console.log(isPrimeNumber([2, 3]));
console.log(isPrimeNumber([4, 6]));
console.log(isPrimeNumber([1, '', 'Live and Learn']));