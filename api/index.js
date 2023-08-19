const express = require("express");

const app = express();
const moment = require("moment");

const db = require("./database");

app.get("/", (req, res) => {
  res.send({
    message:
      "Welkom bij de Mankementjes API! Hier vind je alle data die ook te vinden is op de website.",
    endpoints: [
      "/mankementjes - Alle mankementjes, inclusief bijbehorende reacties.",
      "/mankementjes/<id> - Een specifiek mankementje, inclusief bijbehorende reacties.",
    ],
    types: [
      "De Mankementjes API bevat een aantal soorten data.",
      "Een mankementje is een melding van een probleem in het park. Denk aan storingen, kapotte lampjes, etc. Deze heeft een status. Valide statussen zijn 'open' en 'resolved'.",
      "Een reactie is een reactie op een mankementje. Deze kan worden geplaatst door een gebruiker. Ook deze heeft een status. Valide statussen zijn 'public', 'review', en 'removed'.",
      "Een park is... een park. Denk aan de Efteling, Disneyland, etc.",
      "Een locatie is een locatie in een park. Denk aan een attractie, een restaurant, etc.",
      "Een sectie is een sectie in een locatie. Denk aan een wachtrij, scéne, etc.",
    ],
    examples: {
      mankementje: {
        id: 1,
        username: "gebruikersnaam",
        image: "https://link.naar/foto.jpg",
        title: "Lampje kapot",
        description: "Het lampje bij de ingang van de attractie is kapot.",
        status: "resolved",
        park: "Efteling",
        location: "Symbolica",
        section: "Ingang",
        date: "18-08-2023",
        solved: "19-08-2023",
        comments: [
          {
            id: 1,
            mankementje: 1,
            username: "gebruikersnaam",
            content: "Lampje is weer gerepareerd!",
            date: "19-08-2023",
          },
        ],
      },
      reactie: {
        id: 1,
        mankementje: 1,
        username: "gebruikersnaam",
        content: "Lampje is weer gerepareerd!",
        date: "19-08-2023",
      },
    },
  });
});

// Get all mankementjes
app.get("/mankementjes", (req, res) => {
  db.all(`SELECT * FROM mankementje`, [], (err, rows) => {
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
  });
});

// Get mankementje by id
app.get("/mankementjes/:id", (req, res) => {
  const id = req.params.id;

  db.get(`SELECT * FROM mankementje WHERE id = ?`, [id], (err, row) => {
    if (err) throw err;

    db.all(
      `SELECT * FROM comment WHERE mankementje = ?`,
      [id],
      (err, comments) => {
        if (err) throw err;
        row.comments = [];

        console.log(row.date);

        row.date = moment(row.date).format("D-MM-YYYY");

        let counter = 0;

        comments.forEach((comment) => {
          comment.date = moment(comment.date).format("D-MM-YYYY");

          row.comments.push(comment);
          counter++;
          if (counter == comments.length) {
            res.send(row);
          }
        });

        if (comments.length == 0) {
          res.send(row);
        }
      }
    );
  });
});

app.listen(3000, () => console.log("Listening on port 3000..."));
