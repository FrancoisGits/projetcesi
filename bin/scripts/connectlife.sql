# MariaDB 10.4
# connectlife schema creation script
# tables: insee, societes, clients

create database if not exists connectlife;
use connectlife;

create table if not exists fixtures
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

create table if not exists insee
(
    id         int auto_increment
        primary key,
    cp         int(5)       not null,
    ville      varchar(100) not null,
    complement varchar(100) null
);

create table if not exists clients
(
    id         int auto_increment
        primary key,
    civilite   enum ('M.', 'Mme') not null,
    nom        varchar(100)       not null,
    prenom     varchar(100)       not null,
    adresse1   varchar(255)       not null,
    adresse2   varchar(255)       null,
    telephone1 varchar(11)        null,
    telephone2 varchar(11)        null,
    email      varchar(100)       not null,
    societe    varchar(100)       null,
    poste      varchar(100)       null,
    guid       varchar(36)        not null,
    exported   tinyint(1)         null,
    inseeId    int                not null,
    constraint clients_guid_uindex
        unique (guid),
    constraint clients_insee_id_fk
        foreign key (inseeId) references insee (id)
);


