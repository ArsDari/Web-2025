const VOWELS = 'аеёиоуыэюя';

function countVowels(arg) {
    if (typeof(arg) === 'string') {
        let stringVowels = [];
        for (let i = 0; i < arg.length; i++) {
            if (VOWELS.includes(arg[i].toLowerCase())) {
                stringVowels.push(arg[i]);
            }
        }
        return stringVowels.length + ' (' + stringVowels.join(', ') + ')';
    }
    return 'Ошибка: переданный аргумент не является строкой';
}

console.log(countVowels());
console.log(countVowels(1));
console.log(countVowels(2));
console.log(countVowels([1, 2]));
console.log(countVowels('Привет, мир!'));
console.log(countVowels('СвЯзАнНыЕ оДной целью'));
console.log(countVowels('ПОВАР СПРАШИВАЕТ ПОВАР, А КАКОВА ТВОЯ ПРОФЕССИЯ?\
    ПОВАР ОТВЕЧАЕТ ПОВАРУ: "Я ПОВАР АХАХАХАХХАХАХАХАХАХАХАХАХАХХА"'));