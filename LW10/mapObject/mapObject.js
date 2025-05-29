const nums = { a: 1, b: 2, c: 3 };

function mapObject(arg, callback) {
    const result = {};
    for (let value in arg) {
        result[value] = callback(arg[value]);
    }
    return result;
}

console.log(mapObject(nums, x => x * 2));