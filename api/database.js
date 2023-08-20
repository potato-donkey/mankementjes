const sqlite3 = require("sqlite3").verbose();

const settings = require("./settings.json");

const moment = require("moment");

const bcrypt = require("bcrypt");
const saltRounds = 10;

let connection = new sqlite3.Database(settings.dbpath, (err) => {
  if (err) return console.error(err.message);

  console.log("Connected to file database");
});

const setup = () => {
  // Create user table

  connection.run(`
    CREATE TABLE IF NOT EXISTS user (
        username TEXT PRIMARY KEY,
        password TEXT,
        email TEXT
    );
`);

  // Create mankementje table
  connection.run(`
CREATE TABLE IF NOT EXISTS mankementje (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
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
    id INTEGER PRIMARY KEY AUTOINCREMENT,
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
  connection.all(
    `SELECT * FROM mankementje ORDER BY date DESC`,
    [],
    (err, rows) => {
      if (err) throw err;

      const mankementjes = [];
      let counter = 0;

      if (rows.length == 0) {
        res.send(mankementjes);
      }

      rows.forEach((row) => {
        connection.all(
          `SELECT * FROM comment WHERE mankementje = ? AND status != 'removed' ORDER BY date DESC`,
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
    }
  );
};

const getMankementje = (id, res) => {
  connection.get(`SELECT * FROM mankementje WHERE id = ?`, [id], (err, row) => {
    if (err) throw err;

    connection.all(
      `SELECT * FROM comment WHERE mankementje = ? AND status != 'removed' ORDER BY date DESC`,
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
    `SELECT * FROM mankementje WHERE park = ? AND location = ? AND section = ? ORDER BY date DESC`,
    [park, location, section],
    (err, rows) => {
      if (err) throw err;
      if (rows.length == 0) return res.send([]);
      res.send(rows);
    }
  );
};

const getArchivedMankementjes = (res) => {
  connection.all(
    `SELECT * FROM mankementje WHERE status = 'resolved' ORDER BY date DESC`,
    [],
    (err, rows) => {
      if (err) throw err;

      const mankementjes = [];
      let counter = 0;

      if (rows.length == 0) return res.send([]);

      rows.forEach((row) => {
        connection.all(
          `SELECT * FROM comment WHERE mankementje = ? ORDER BY date DESC`,
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
    }
  );
};

const loginUser = (username, password, res) => {
  connection.get(
    `SELECT * FROM user WHERE username = ?`,
    [username],
    (err, row) => {
      if (err) throw err;
      if (row) {
        bcrypt.compare(password, row.password, function (err, match) {
          if (err) throw err;
          console.info(`Password match: ${match}`);
          if (match) {
            res.redirect(
              `${settings.mankementjesurl}/auth/loginaction.php?username=${username}` // I know this is unsafe. I'm working on it.
            );

            console.info(`User ${username} logged in`);
          } else {
            res.redirect(
              `${settings.mankementjesurl}/auth/login.php?message=10`
            );
          }
        });
      } else {
        res.redirect(`${settings.mankementjesurl}/auth/login.php?message=11`);
      }
    }
  );
};

const createUser = (username, password, res) => {
  connection.get(
    `SELECT * FROM user WHERE username = ?`,
    [username],
    (err, row) => {
      if (err) throw err;
      if (row) {
        res.redirect(`${settings.mankementjesurl}/auth/login.php?message=11`);
      } else {
        bcrypt.genSalt(saltRounds, function (err, salt) {
          bcrypt.hash(password, salt, function (err, hash) {
            connection.run(
              `INSERT INTO user VALUES (?, ?, ?)`,
              [username, hash, null],
              (err) => {
                if (err) throw err;
                res.redirect(
                  `${settings.mankementjesurl}/auth/login.php?message=23`
                );
              }
            );
          });
        });
      }
    }
  );
};

const addComment = (mankementje, username, content, res) => {
  connection.run(
    `INSERT INTO comment (mankementje, username, content, date, status) VALUES (?, ?, ?, datetime(), ?)`,
    [parseInt(mankementje), username, content, "review"],
    (err) => {
      if (err) throw err;
      console.info(
        `Comment added to mankementje ${mankementje} by ${username}: ${content}`
      );
      res.redirect(
        `${settings.mankementjesurl}/mankementje.php?id=${mankementje}&message=31`
      );
    }
  );
};

const deleteComment = (id, username, res) => {
  connection.run(
    `UPDATE comment SET status = 'removed' WHERE id = ?`,
    [id],
    (err) => {
      if (err) throw err;
      connection.get(`SELECT * FROM comment WHERE id = ?`, [id], (err, row) => {
        if (err) throw err;
        const mankementje = row.mankementje;
        const content = row.content;

        console.log(mankementje);

        console.info(`Comment ${id} deleted by ${username}: ${content}`);
        res.redirect(
          `${settings.mankementjesurl}/mankementje.php?id=${mankementje}&message=30`
        );
      });
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
  getArchivedMankementjes,
  loginUser,
  createUser,
  addComment,
  deleteComment,
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
//   `INSERT INTO mankementje VALUES (2, 'japser4', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Joris_en_de_Draak_-_Dragon.JPG/1280px-Joris_en_de_Draak_-_Dragon.JPG', 'Hek kapot', 'Hek bij invalideningang Baron is kapot', 'resolved', 'Efteling', 'Baron 1898', 'Invalideningang', '2023-08-17', '2023-08-18');`
// );

// connection.run(
//   `INSERT INTO comment VALUES (1,1, 'japser4', 'Dit lampje is weer gemaakt!', '2023-08-18', 'public');`
// );
