// import express
const express = require("express");
// import router
const router = require("./routes/api.js");
// buat object express
const app = express();

// use middleware
app.use(express.json());
app.use(express.urlencoded());

app.use(router);

// mendefinisikan port
app.listen(3000, () => {
  console.log("Server running at http://localhost:3000");
});