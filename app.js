const { index, store, update, destroy } = require("./FruitController.js");

const main = () => {
    console.log("Menampilkan semua buah:");
    index("");
    store("Pisang");
    update(0, "Kelapa");
    destroy(0);
};

main();