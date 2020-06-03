# MariaDB 10.4
# connectlife fixtures script
# tables: fixtures

use connectlife;

create table fixtures
(
    id        int auto_increment
        primary key,
    guid      varchar(36)  not null,
    nom       varchar(100) null,
    mail      varchar(100) null,
    isSociete tinyint(1)   null,
    constraint fixtures_guid_uindex
        unique (guid)
);

INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (1, 'c4662933-0a87-478c-9a0f-fd65ecd51eee', 'GERIN-LAJOIE', 'gerin-lajoie@gerin.com', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (2, '38a08666-59c3-4125-a6ac-6b83cf3ab425', 'DEVEREAUX', 'arthur.devereaux@gmail.com', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (3, '13bba70e-9cf4-4b60-9669-4392f9c43194', 'DELANNOY', 'jj.delannoy@delannoy-btp.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (4, 'ce480845-f7a6-46b0-8f79-ea5fb6aa8057', 'DEVILLERS', 'antoinedevillers@caramail.com', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (5, '44c04755-1111-4cdf-87b1-a9d4f019429c', 'DUTOIT', 'pauline.d@msn.com', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (6, 'f6d14fe8-d224-4edc-9977-747dca84384d', 'HACHETTE', 'f.hachette@hachette-tp.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (7, 'fdbffecd-50a9-45f5-adec-000b293b1d7c', 'CARTIER', 'jeanlouis.cartier@ribecourt-plomberie.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (8, 'eeee5de6-3076-4c71-998d-f9f0438f81d5', 'MESNY', 'n.mesny62@wanadoo.fr', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (9, '3f6d882c-38c1-402e-aee1-4c920c9369b1', 'ARDOUIN', 'ardouinplomberie62@orange.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (10, '60501eaf-9e63-44d9-9e16-b0c6fc46e0d1', 'JACQUIER', 'jerome.jacquier@ville-arras.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (11, '366a2661-f33a-40bc-a9b5-79ebb912c58f', 'STACHOWIAK', 'loulou.stac62@free.fr', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (12, '50f1e8b9-5113-479e-8d12-cb3cc72a13fb', 'CHRISTIAN', 'c.christian92@live.fr', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (13, '57285b2b-250f-4cf5-8eb6-80639982dfc6', 'FRANCHET', 'martine.franchet@gmail.com', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (14, 'f9106442-11d4-4ecf-9716-3ee1b0cba7d4', 'BLANC-MESNIL', 'bm59200@sfr.fr', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (15, '5718ce8b-3431-40b4-8fb3-c5ac37cbcf6b', 'ROGEZ', 'ghislaine.rogez@laposte.net', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (16, '6e014bed-3436-40a2-abf3-4d86f9324ef2', 'JANKULOWSKI', 'matthiasbg1978@lycos.com', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (17, '852b10eb-4e32-45d2-b615-769962a35651', 'COQUIDE', 'julien.coquide@gmail.com', 0);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (18, 'e3d6c9d1-c7fb-4100-8f79-da30ff660fee', 'PRZYDROZNY', 'jean.przy@renovtout-62.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (19, '54aef9a3-713a-44dd-99c0-e1c5a8518a0f', 'FRANQUART', 'contact@franquartbeton.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (20, 'df97f976-30f4-47b0-b1a0-7c0a6ce5fc14', 'BLANQUET', 'francis@constructionsblanquet.com', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (21, 'fcbf52f9-d8cf-4e5c-a179-873ef9ae0758', 'BENAZOUZ', 'sebastian.benazouz@eledis.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (22, '37ddcbd2-d5db-417c-b70b-40d07d09e7b3', 'FRANCOIS', 'martin.francois@eledis.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (23, '2b240022-7adc-4a00-90b9-ec73c45532d3', 'DESSEUX', 'lo-jean.desseux@eledis.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (24, '5cbf1b94-6ea2-4eeb-8b56-2d021585f626', 'ANCIEN', 'christophe.ancien@eledis.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (25, '1e2d62d3-10a6-490a-bb07-40f1bfa5d8a8', 'BOULETTE', 'maxime.boulette@eledis.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (26, '7b772da2-ec9f-406a-ac69-aebc1206a6e5', 'BERTOLTE', 'valentina.bertolte@eledis.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (27, '593eb3ce-6ba3-4129-8221-690e8d6b36f9', 'THIEVANS', 'tomasine.thievans@eledis.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (28, '15766d1a-0f14-44e7-bf81-32752e6890b9', 'JOHNSON', 'michael@constructionsblanquet.com', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (29, 'a6a710fa-5c5d-43f8-aba9-eb621a812e06', 'SCHMITT', 'joseph.schmitt@ribecourt-plomberie.fr', 1);
INSERT INTO connectlife.fixtures (id, guid, nom, mail, isSociete) VALUES (30, '30157283-9b6c-4e3e-a7a9-65782625c20f', 'DELABATH-DELAVACQUERIE-PERNOD', 'cunegonde@constructionsblanquet.com', 1);