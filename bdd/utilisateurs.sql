BEGIN TRANSACTION;
DROP TABLE IF EXISTS "utilisateurs";
CREATE TABLE IF NOT EXISTS "utilisateurs" (
	"EMAIL"	VARCHAR NOT NULL,
	"PASS"	VARCHAR NOT NULL,
	"STATUT"	VARCHAR NOT NULL DEFAULT 'Etudiant',
	PRIMARY KEY("EMAIL")
);
INSERT INTO "utilisateurs" ("EMAIL","PASS","STATUT") VALUES ('superuser@test.fr','L@nnion','admin'),
 ('simpleuser@test.fr','L@nnion','vendeur'), ('thomas@test.fr','L@nnion','client');
COMMIT;