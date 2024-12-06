const fruits = require("./data.js");

const index = () => {
    for (const fruit of fruits) {
        console.log(fruit);
    }
    console.log("");
};

const store = (name) => {
    fruits.push(name);
    console.log(`${name} telah ditambahkan:`)
    index();
};

const update = (position, name) => {
    if (position < 0 || position >= fruits.length) {
        console.log("Posisi index tidak sesuai");
        return;
    }
    const oldName = fruits[position];
    fruits[position] = name;
    console.log(`${oldName} telah diubah menjadi ${name}:`);
    index();
};

const destroy = (position) => {
    if (position < 0 || position >= fruits.length) {
        console.log("Posisi index tidak sesuai");
        return;
    }
    const [removed] = fruits.splice(position, 1); // Menggunakan Object Destructuring
    console.log(`${removed} telah dihapus:`);
    index();
};

module.exports = {index, store, update, destroy};