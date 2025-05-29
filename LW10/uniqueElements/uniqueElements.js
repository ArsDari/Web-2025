function uniqueElements(arg) {
    const result = {};
    for (let value of arg) {
        value = String(value);
        if (!result[value]) {
            result[value] = 1;
        }
        else {
            result[value]++;
        }
    }
    return result;
}

console.log(uniqueElements(['привет', 'hello', 1, '1']));
console.log(uniqueElements(['', '', false, true, true]));
console.log(uniqueElements(['', '', 0, false, {'a': 'БВГДЕЕ'}, {1: 2}, {1: 2}]));