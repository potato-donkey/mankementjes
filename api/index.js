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

app.get("/mankementjes/archief", (req, res) => {
  db.all(
    `SELECT * FROM mankementje WHERE status = 'resolved'`,
    [],
    (err, rows) => {
      if (err) throw err;

      const mankementjes = [];
      let counter = 0;

      rows.forEach((row) => {
        db.all(
          `SELECT * FROM comment WHERE mankementje = ?`,
          [row.id],
          (err, comments) => {
            if (err) throw err;
            row.comments = [];
            row.date = moment(row.date).format("D-MM-YYYY");

            comments.forEach((comment) => {
              row.comments.push(comment);
            });

            mankementjes.push(row);
            counter++;
            if (counter == rows.length) {
              res.send(mankementjes);
            }
          }
        );
      });
    }
  );
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
