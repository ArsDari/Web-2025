function triple(number) {
    return number * 3;
}

function biggerThan10(number) {
    return number > 10;
}

const numbers = [2, 5, 8, 10, 3];
console.log(numbers.map(triple).filter(biggerThan10));