const express = require("express");

const app = express();
const moment = require("moment");

const settings = require("./settings.json");

const welcome_message = require("./welcome_message.json");

const db = require("./database.js");

app.get("/", (req, res) => {
  res.send(welcome_message);
});

// Get all mankementjes
app.get("/mankementjes", (req, res) => {
  db.getAllMankementjes(res);
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

app.listen(settings.port, () =>
  console.log(`Listening on port ${settings.port}...`)
);
