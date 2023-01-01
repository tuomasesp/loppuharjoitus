CREATE TABLE tuoteryhma (
    id INTEGER NOT NULL PRIMARY KEY,
    trnimi VARCHAR(255) NOT NULL
);
INSERT INTO tuoteryhma (id,trnimi) VALUES (1,"Kaikenlaista");
INSERT INTO tuoteryhma (id,trnimi) VALUES (2,"Muuta");

CREATE TABLE tuote (
    id INTEGER NOT NULL PRIMARY KEY,
    tuotenimi VARCHAR(255) NOT NULL,
    tuotekuvaus VARCHAR(255),
    tuotekuva VARCHAR(255),
    tuoteryhmaid INTEGER NOT NULL,
    FOREIGN KEY(tuoteryhmaid) REFERENCES tuoteryhma(id)
);

INSERT INTO tuote (id,tuotenimi,tuotekuvaus,tuoteryhmaid) VALUES (1,"Tuplajuustohampurilainen","Mehevää juustoa, rasvaista mättöä",1);
INSERT INTO tuote (id,tuotenimi,tuotekuvaus,tuoteryhmaid) VALUES (2,"Kuplavohveli","Hyvä.",1);
INSERT INTO tuote (id,tuotenimi,tuotekuvaus,tuoteryhmaid) VALUES (3,"Kinkkuleipä","Kinkku joulukinkkua",1);
INSERT INTO tuote (id,tuotenimi,tuotekuvaus,tuoteryhmaid) VALUES (4,"Sitruunasooda","On happoja",2);
INSERT INTO tuote (id,tuotenimi,tuotekuvaus,tuoteryhmaid) VALUES (5,"Kola-kola","Sitä mitä se sanoo",2);
INSERT INTO tuote (id,tuotenimi,tuotekuvaus,tuoteryhmaid) VALUES (6,"Vesi","Raikasta",2);

CREATE TABLE asiakas (
    asiakasnro INTEGER NOT NULL PRIMARY KEY,
    asiakasnimi VARCHAR(255) NOT NULL,
    osoite VARCHAR(255) NOT NULL,
    postinro VARCHAR(255) NOT NULL,
    postitmp VARCHAR(255) NOT NULL,
    puhelinnro VARCHAR(255),
    sahkoposti VARCHAR(255),
    knimi VARCHAR(50),
    FOREIGN KEY (knimi) REFERENCES kayttaja(knimi)
);


CREATE TABLE kayttaja (
    knimi VARCHAR(50) NOT NULL PRIMARY KEY, 
    salasana VARCHAR(255) NOT NULL 
    
);


INSERT INTO asiakas (asiakasnro,asiakasnimi,osoite,postinro,postitmp) VALUES (1,"Jakki Heikkinen","Kustinpolku 21","88900","Kuhmo");
INSERT INTO asiakas (asiakasnro,asiakasnimi,osoite,postinro,postitmp) VALUES (2,"Lollipop Kemppainen","Kiannankatu 123","89600","Suomussalmi");
INSERT INTO asiakas (asiakasnro,asiakasnimi,osoite,postinro,postitmp) VALUES (3,"Untamo Warsteiner","Perttiläntie 34","76540","Perttikylä");
CREATE TABLE tilaus (
    tilausnro INTEGER NOT NULL PRIMARY KEY,
    tilauspvm TIMESTAMP DEFAULT current_timestamp,
    asiakasnro INTEGER NOT NULL,
    FOREIGN KEY (asiakasnro) REFERENCES asiakas(asiakasnro)
);

CREATE TABLE tilausrivi (
    tilausnro INTEGER NOT NULL,
    tuotenro INTEGER NOT NULL,
    FOREIGN KEY (tilausnro) REFERENCES tilaus (tilausnro)
    ON DELETE RESTRICT,
    FOREIGN KEY (tuotenro) REFERENCES tuote (id)
    ON DELETE RESTRICT
);
    