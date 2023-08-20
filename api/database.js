const sqlite3 = require("sqlite3").verbose();

const settings = require("./settings.json");

const moment = require("moment");

let connection = new sqlite3.Database(settings.dbpath, (err) => {
  if (err) return console.error(err.message);

  console.log("Connected to file database");
});

const setup = () => {
  // Create mankementje table
  connection.run(`
CREATE TABLE IF NOT EXISTS mankementje (
    id INTEGER PRIMARY KEY,
    username TEXT,
    image TEXT,
    title TEXT,
    description TEXT,
    status TEXT,
    park TEXT,
    location TEXT,
    section TEXT,
    date TEXT,
    solved TEXT
);
`);

  // Create comment table
  connection.run(`
CREATE TABLE IF NOT EXISTS comment (
    id INTEGER PRIMARY KEY,
    mankementje INTEGER,
    username TEXT,
    content TEXT,
    date TEXT,
    status TEXT
);
`);

  // Create park table
  connection.run(`
    CREATE TABLE IF NOT EXISTS park (
        park TEXT PRIMARY KEY
    );
`);

  // Create location table
  connection.run(`
    CREATE TABLE IF NOT EXISTS location (
        location TEXT,
        park TEXT,

        PRIMARY KEY (location, park)
    );
`);

  // Create section table
  connection.run(`
    CREATE TABLE IF NOT EXISTS section (
        section TEXT,
        location TEXT,
        park TEXT,

        PRIMARY KEY (location, park, section)
    );
`);
};

const getAllMankementjes = (res) => {
  connection.all(`SELECT * FROM mankementje`, [], (err, rows) => {
    if (err) throw err;

    const mankementjes = [];
    let counter = 0;

    rows.forEach((row) => {
      connection.all(
        `SELECT * FROM comment WHERE mankementje = ?`,
        [row.id],
        (err, comments) => {
          if (err) throw err;
          row.comments = [];
          row.date = moment(row.date).format(settings.dateformat);

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
};

const getMankementje = (id, res) => {
  connection.get(`SELECT * FROM mankementje WHERE id = ?`, [id], (err, row) => {
    if (err) throw err;

    connection.all(
      `SELECT * FROM comment WHERE mankementje = ?`,
      [id],
      (err, comments) => {
        if (err) throw err;
        row.comments = [];

        row.date = moment(row.date).format(settings.dateformat);

        let counter = 0;

        comments.forEach((comment) => {
          comment.date = moment(comment.date).format(settings.dateformat);

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
};

const getParks = (res) => {
  connection.all(`SELECT * FROM park`, [], (err, rows) => {
    if (err) throw err;
    res.send(rows.map((row) => row.park)); // Send only park names
  });
};

const getLocations = (park, res) => {
  connection.all(
    `SELECT * FROM location WHERE park = ?`,
    [park],
    (err, rows) => {
      if (err) throw err;
      const locations = rows.map((row) => row.location); // Send only location names
      res.send({
        park: park,
        locations: locations,
      });
    }
  );
};

const getSections = (park, location, res) => {
  connection.all(
    `SELECT * FROM section WHERE park = ? AND location = ?`,
    [park, location],
    (err, rows) => {
      if (err) throw err;
      const sections = rows.map((row) => row.section); // Send only section names
      res.send({
        park: park,
        location: location,
        sections: sections,
      });
    }
  );
};

const getMankementjesInSection = (park, location, section, res) => {
  connection.all(
    `SELECT * FROM mankementje WHERE park = ? AND location = ? AND section = ?`,
    [park, location, section],
    (err, rows) => {
      if (err) throw err;
      res.send(rows);
    }
  );
};

module.exports = {
  connection,
  setup,
  getAllMankementjes,
  getMankementje,
  getParks,
  getLocations,
  getSections,
  getMankementjesInSection,
};

// Filling db for testing

// connection.run(`
// INSERT INTO park VALUES ('Efteling');
// `);

// connection.run(`
// INSERT INTO location VALUES ('Vogel Rok', 'Efteling');
// `);

// connection.run(`
// INSERT INTO section VALUES ('Wachtrij', 'Vogel Rok', 'Efteling');
// `);

// connection.run(`
// INSERT INTO section VALUES ('Baan', 'Vogel Rok', 'Efteling');
// `);

// connection.run(`
// INSERT INTO section VALUES ('Gebouw', 'Vogel Rok', 'Efteling');
// `);

// connection.run(`
// INSERT INTO location VALUES ('Joris en de Draak', 'Efteling');
// `);

// connection.run(`
// INSERT INTO section VALUES ('Wachtrij', 'Joris en de Draak', 'Efteling');
// `);

// connection.run(`
// INSERT INTO section VALUES ('Baan', 'Joris en de Draak', 'Efteling');
// `);

// connection.run(`
// INSERT INTO section VALUES ('Gebouw', 'Joris en de Draak', 'Efteling');
// `);

// connection.run(
//   `INSERT INTO mankementje VALUES (1, 'japser', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Joris_en_de_Draak_-_Dragon.JPG/1280px-Joris_en_de_Draak_-_Dragon.JPG', 'Lampje kapot', 'Lampje kapot bij de colamachine', 'open', 'Efteling', 'Joris en de Draak', 'Wachtrij', '2023-08-18', null);`
// );

// connection.run(
//   `INSERT INTO mankementje VALUES (2, 'japser', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Joris_en_de_Draak_-_Dragon.JPG/1280px-Joris_en_de_Draak_-_Dragon.JPG', 'Hek kapot', 'Hek bij invalideningang Baron is kapot', 'resolved', 'Efteling', 'Baron 1898', 'Invalideningang', '2023-08-17', '2023-08-18');`
// );

// connection.run(`INSERT INTO comment VALUES (1,1, 'japser', 'Dit lampje is weer gemaakt!', '2023-08-18', 'public');`)
