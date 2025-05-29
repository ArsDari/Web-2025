const UPPERCASE = ['a', 'b','c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's','t', 'u', 'v', 'w', 'x', 'y', 'z'];
const LOWERCASE = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
const NUMBERS = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
const SPECIAL_CHARS = ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '-', '.', '~', '|', '<', '>', '=', '-', '_', '/', ':', ';', '?', '[', ']', '{', '}', '~'];

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}

function generatePassword(length) {
    if (length > 3) {
        let password = '';
        password += UPPERCASE[getRandomInt(UPPERCASE.length)];
        password += LOWERCASE[getRandomInt(LOWERCASE.length)];
        password += NUMBERS[getRandomInt(NUMBERS.length)];
        password += SPECIAL_CHARS[getRandomInt(SPECIAL_CHARS.length)];
        for (let i = 4; i < length; i++) {
            switch (getRandomInt(4)) {
                case 0:
                    password += UPPERCASE[getRandomInt(UPPERCASE.length)];
                    break;
                case 1:
                    password += LOWERCASE[getRandomInt(LOWERCASE.length)];
                    break;
                case 2:
                    password += NUMBERS[getRandomInt(NUMBERS.length)];
                    break;
                case 3:
                    password += SPECIAL_CHARS[getRandomInt(SPECIAL_CHARS.length)];
                    break;
            }
        }
        return password;
    }
    return "Недостаточная длина пароля";
}

console.log(generatePassword(3));
console.log(generatePassword(4));
console.log(generatePassword(5));
console.log(generatePassword(12));