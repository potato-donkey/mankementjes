const sqlite3 = require("sqlite3").verbose();

const settings = require("./settings.json");

let connection = new sqlite3.Database(settings.dbpath, (err) => {
  if (err) return console.error(err.message);

  console.info("Connected to file database");
});

// Filling db for testing

connection.run(`
INSERT INTO park VALUES ('Efteling');
`);

connection.run(`
INSERT INTO location VALUES ('Vogel Rok', 'Efteling');
`);

connection.run(`
INSERT INTO section VALUES ('Wachtrij', 'Vogel Rok', 'Efteling');
`);

connection.run(`
INSERT INTO section VALUES ('Baan', 'Vogel Rok', 'Efteling');
`);

connection.run(`
INSERT INTO section VALUES ('Gebouw', 'Vogel Rok', 'Efteling');
`);

connection.run(`
INSERT INTO location VALUES ('Joris en de Draak', 'Efteling');
`);

connection.run(`
INSERT INTO section VALUES ('Wachtrij', 'Joris en de Draak', 'Efteling');
`);

connection.run(`
INSERT INTO section VALUES ('Baan', 'Joris en de Draak', 'Efteling');
`);

connection.run(`
INSERT INTO section VALUES ('Gebouw', 'Joris en de Draak', 'Efteling');
`);

connection.run(
  `INSERT INTO mankementje VALUES (1, 'japser', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Joris_en_de_Draak_-_Dragon.JPG/1280px-Joris_en_de_Draak_-_Dragon.JPG', 'Lampje kapot', 'Lampje kapot bij de colamachine', 'open', 'Efteling', 'Joris en de Draak', 'Wachtrij', '2023-08-18', null);`
);

connection.run(
  `INSERT INTO mankementje VALUES (2, 'japser', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Joris_en_de_Draak_-_Dragon.JPG/1280px-Joris_en_de_Draak_-_Dragon.JPG', 'Hek kapot', 'Hek bij invalideningang Baron is kapot', 'resolved', 'Efteling', 'Baron 1898', 'Invalideningang', '2023-08-17', '2023-08-18');`
);

connection.run(
  `INSERT INTO comment VALUES (1,1, 'japser', 'Dit lampje is weer gemaakt!', '2023-08-19', 'public');`
);

connection.run(
  `INSERT INTO user VALUES ('Beheerder', '$2a$10$sZPcEnOYwPu0vhZy0vndVeywe4IQduaNSL9TUU3iamlQjCv4qwqpq', 'admin@mankementjes.nl');`
);
// Password 'wachtwoord'
