const express = require("express");

const app = express();
const moment = require('moment');

const db = require("./database");

app.get("/", (req, res) => {
  res.send("Hello World");
});

// Get all mankementjes
app.get("/mankementjes/all", (req, res) => {

  db.all(`SELECT * FROM mankementje`, [], (err, rows) => {
    if (err) throw err;

    const mankementjes = [];
    let counter = 0;

    rows.forEach(row => {
      
      db.all(`SELECT * FROM comment WHERE mankementje = ?`, [row.id], (err, comments) => {
        if(err) throw err;
        row.comments = [];
        row.date = moment(row.date).format("D-MM-YYYY");

        comments.forEach(comment => {
          row.comments.push(comment);
        });

        mankementjes.push(row);
        counter++;
        if (counter == rows.length) {
          res.send(mankementjes);
        }
      });

    });
    
  });
});

// Get mankementje by id
app.get("/mankementjes/:id", (req, res) => {

  const id = req.params.id;

  db.get(`SELECT * FROM mankementje WHERE id = ?`, [id], (err, row) => {
    if (err) throw err;

      db.all(`SELECT * FROM comment WHERE mankementje = ?`, [id], (err, comments) => {
        if(err) throw err;
        row.comments = [];

        console.log(row.date);

        row.date = moment(row.date).format("D-MM-YYYY");

        let counter = 0;

        comments.forEach(comment => {
          comment.date = moment(comment.date).format("D-MM-YYYY");

          row.comments.push(comment);
          counter++;
          if (counter == comments.length) {
            res.send(row);
          }
        });

        if(comments.length == 0) {
          res.send(row);
        }

      });

    });
    
  });

app.listen(3000, () => console.log("Listening on port 3000..."));
