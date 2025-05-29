const users = [
    { id: 1, name: "Alice" },
    { id: 2, name: "Bob" },
    { id: 3, name: "Charlie" }
];

function getUsername(user) {
    return user.name;
}

console.log(users.map(getUsername));