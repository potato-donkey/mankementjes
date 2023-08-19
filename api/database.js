const sqlite3 = require("sqlite3").verbose();

let connection = new sqlite3.Database("./db/mankementjes.db", (err) => {
  if (err) return console.error(err.message);

  console.log("Connected to file database");
});

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

// connection.run(`INSERT INTO mankementje VALUES (1, 'japser', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Joris_en_de_Draak_-_Dragon.JPG/1280px-Joris_en_de_Draak_-_Dragon.JPG', 'Lampje kapot', 'Lampje kapot bij de colamachine', 'open', 'Efteling', 'Joris en de Draak', 'Wachtrij', '2023-08-18', null);`)

// connection.run(`INSERT INTO comment VALUES (1,1, 'japser', 'Dit lampje is weer gemaakt!', '2023-08-18', 'public');`)

module.exports = connection;
