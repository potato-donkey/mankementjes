const express = require("express");
const bodyparser = require("body-parser");
const multer = require("multer")();

const app = express();
const moment = require("moment");

const settings = require("./settings.json");

const welcome_message = require("./welcome_message.json");

const db = require("./database.js");

db.setup();

app.use(bodyparser.json());
app.use(multer.array());
app.use(bodyparser.urlencoded({ extended: true }));

app.get("/", (req, res) => {
  res.send(welcome_message);
});

// Get all mankementjes
app.get("/mankementjes", (req, res) => {
  db.getAllMankementjes(res);
});

app.get("/mankementjes/archief", (req, res) => {
  db.getArchivedMankementjes(res);
});

// Get mankementje by id
app.get("/mankementjes/:id", (req, res) => {
  const id = req.params.id;

  db.getMankementje(id, res);
});

// Get all parks
app.get("/parken", (req, res) => {
  db.getParks(res);
});

// Get all locations
app.get("/parken/:park", (req, res) => {
  const park = req.params.park;

  db.getLocations(park, res);
});

// Get all sections
app.get("/parken/:park/:location", (req, res) => {
  const park = req.params.park;
  const location = req.params.location;

  db.getSections(park, location, res);
});

// Get all mankementjes in a section
app.get("/parken/:park/:location/:section", (req, res) => {
  const park = req.params.park;
  const location = req.params.location;
  const section = req.params.section;

  db.getMankementjesInSection(park, location, section, res);
});

// Add user
app.post("/user/register", (req, res) => {
  const user = req.body;
  const username = user.username;
  const password = user.password;
  const passwordRepeat = user.passwordRepeat;

  if (password !== passwordRepeat) {
    return res.redirect(
      `${settings.mankementjesurl}/auth/login.php?message=20`
    );
  }

  if (!password.match(settings.passwordregex)) {
    return res.redirect(
      `${settings.mankementjesurl}/auth/login.php?message=22`
    );
  }

  db.createUser(username, password, res);
});

// Login user
app.post("/user/login", (req, res) => {
  const user = req.body;
  const username = user.username;
  const password = user.password;

  db.loginUser(username, password, res);
});

// Add comment
app.post("/comment/add", (req, res) => {
  const comment = req.body;
  const mankement = comment.mankementje;
  const username = comment.user;
  const content = comment.content;

  db.addComment(mankement, username, content, res);
});

// Delete comment
app.get("/comment/delete/:id/:username", (req, res) => {
  const id = req.params.id;
  const username = req.params.username;

  db.deleteComment(id, username, res);
});

app.listen(settings.port, () =>
  console.log(`Listening on port ${settings.port}...`)
);
