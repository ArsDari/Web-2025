function mergeObjects(arg1, arg2) {
    const result = {};
    for (let key in arg1) {
        result[key] = arg1[key];
    }
    for (let key in arg2) {
        result[key] = arg2[key];
    }
    return result;
}

console.log(mergeObjects({a: 1, b: 2}, {}));
console.log(mergeObjects({}, {a: 1, b: 2}));
console.log(mergeObjects({a: 1, b: 2}, {b: 3, c: 2}));
console.log(mergeObjects({a: 1, b: 2}, {d: 3, a: 5}));
console.log(mergeObjects({asfdg: 'gkhmgfmhk', b: 2}, {asfdg: '', d: 3, j: 5}));