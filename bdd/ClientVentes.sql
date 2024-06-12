CREATE TABLE IF NOT EXISTS Produits (
 idP INTEGER PRIMARY KEY AUTOINCREMENT,
 NomP VARCHAR (20),
 Prix INTEGER,
 Illustration VARCHAR (20)
 );

CREATE TABLE IF NOT EXISTS Acheteurs (
 idC INTEGER PRIMARY KEY AUTOINCREMENT,
 NomP VARCHAR (20),
 Ville VARCHAR (20)
 );

CREATE TABLE IF NOT EXISTS Achat (
 idT INTEGER PRIMARY KEY AUTOINCREMENT,
 idP INTEGER ,
 idC INTEGER ,
 Qte INTEGER,
 CONSTRAINT fk_idP FOREIGN KEY (idP) REFERENCES Produits(idP) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT fk_idC FOREIGN KEY (idC) REFERENCES Acheteurs(idC) ON DELETE CASCADE ON UPDATE CASCADE 
 );


INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (1 ,'Trotinette'  , 100, 'images/produits/trotinette.jpg');
INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (2 ,'Table de camping'  , 100, 'images/produits/table.jpg');
INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (3 ,'Vélo'  , 1000, 'images/produits/velo.jpg');
INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (4 ,'Tente'  , 200, 'images/produits/tente.jpg');
INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (5 ,'Lampe torche'  , 15, 'images/produits/lampe.jpg');
INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (6 ,'Montre'  , 15, 'images/produits/montre.jpg');
INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (7 ,'Raquette'  , 8, 'images/produits/raquette.jpg');
INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (8 ,'ballon'  , 10, 'images/produits/ballon.jpg');
INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (9 ,'paire de gants'  , 20, 'images/produits/gants.jpg');
INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (10 ,'paire de chaussettes'  , 3, 'images/produits/chaussettes.jpg');
INSERT INTO Produits (idP, NomP, Prix, Illustration) VALUES (11 ,'casquette'  , 6, 'images/produits/casquette.jpg');


INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (1 ,'Thomas' ,'Bordeaux');
INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (2 ,'Alice' ,'Morlaix' );
INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (3 ,'Margot' ,'Paris' );
INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (4 ,'Lola' ,'Lannion' );
INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (5 ,'Thierry' ,'Lannion' );
INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (6 ,'Sylvie' ,'Lannion' );
INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (7 ,'Valérie' ,'Quimper' );
INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (8 ,'Jean' ,'Brest' );
INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (9 ,'Yves' ,'Chateaulin' );
INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (10 ,'Henri' ,'Chateaulin' );
INSERT INTO Acheteurs (idC, NomP, Ville) VALUES (11 ,'Caroline' ,'Plougastel' );


INSERT INTO Achat (idP,idC,Qte) VALUES (1, 1, 1);
INSERT INTO Achat (idP,idC,Qte) VALUES (1, 2, 1);
INSERT INTO Achat (idP,idC,Qte) VALUES (2, 1, 1);
INSERT INTO Achat (idP,idC,Qte) VALUES (3, 3, 2);
INSERT INTO Achat (idP,idC,Qte) VALUES (4, 10, 10);
INSERT INTO Achat (idP,idC,Qte) VALUES (1, 4, 2);
INSERT INTO Achat (idP,idC,Qte) VALUES (4, 1, 4);
INSERT INTO Achat (idP,idC,Qte) VALUES (8, 4, 32);
INSERT INTO Achat (idP,idC,Qte) VALUES (1, 3, 5);
INSERT INTO Achat (idP,idC,Qte) VALUES (5, 4, 1);
INSERT INTO Achat (idP,idC,Qte) VALUES (6, 5, 1);
INSERT INTO Achat (idP,idC,Qte) VALUES (7, 6, 3);
INSERT INTO Achat (idP,idC,Qte) VALUES (8, 7, 4);
INSERT INTO Achat (idP,idC,Qte) VALUES (9, 8, 1);
INSERT INTO Achat (idP,idC,Qte) VALUES (10, 9, 2);
INSERT INTO Achat (idP,idC,Qte) VALUES (11, 10, 1);
INSERT INTO Achat (idP,idC,Qte) VALUES (5, 11, 2);
INSERT INTO Achat (idP,idC,Qte) VALUES (11, 10, 2);
