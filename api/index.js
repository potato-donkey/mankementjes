const express = require("express");

const app = express();

app.get("/", (req, res) => {
  res.send("Hello World");
});

// Get all mankementjes
app.get("/mankementjes/all", (req, res) => {
  res.send([
    // hardcoded for testing purposes
    // {
    //   id: 10,
    //   image:
    //     "https://nl.letsgodigital.org/uploads/2018/01/efteling-vogel-rok.jpg",
    //   title: "Lampje kapot",
    //   description: "Lampje in de keuken is kapot",
    //   status: "open",
    //   date: "2023-08-18",
    //   park: "Efteling",
    //   location: "Vogel Rok",
    //   section: "Wachtrij",
    //   comments: [
    //     {
    //       user: 1,
    //       comment: "Ik heb hetzelfde probleem",
    //       date: "2023-08-18",
    //     },
    //   ],
    // },
  ]);
});

app.listen(3000, () => console.log("Listening on port 3000..."));
