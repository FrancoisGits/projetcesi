# MariaDB 10.4
# connectlife schema creation script
# tables: insee, societes, clients

create database if not exists connectlife;
use connectlife;

create table if not exists insee
(
    id         int auto_increment
        primary key,
    cp         int(5)       not null,
    ville      varchar(100) not null,
    complement varchar(100) null
);

create table if not exists societes
(
    id  int auto_increment
        primary key,
    nom varchar(100) not null
);

create table if not exists clients
(
    id         int auto_increment
        primary key,
    civilite   tinyint(1)   not null,
    nom        varchar(100) not null,
    prenom     varchar(100) not null,
    adresse2   varchar(255) null,
    adresse1   varchar(255) not null,
    telephone1 bigint(13)   null,
    telephone2 bigint(13)   null,
    email      varchar(100) not null,
    guid       varchar(36)  not null,
    inseeId    int          not null,
    societeId  int          null,
    constraint clients_insee_id_fk
        foreign key (inseeId) references insee (id),
    constraint clients_societes_id_fk
        foreign key (societeId) references societes (id)
);


