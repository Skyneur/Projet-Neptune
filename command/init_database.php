<?php

require_once __DIR__ . '/../database.php';

$pdo->query('
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        name VARCHAR(40) NOT NULL,
        firstname VARCHAR(40) NOT NULL,
        email VARCHAR(139) NOT NULL,
        password VARCHAR(255) NOT NULL,
        isAdmin INT NOT NULL DEFAULT(0)
    )
');
$pdo->query('
    CREATE UNIQUE INDEX users_id_IDX ON users (id)
');
$pdo->query('
    CREATE TABLE IF NOT EXISTS bedroom (
        id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        "number" INTEGER NOT NULL,
        bathroom INTEGER DEFAULT (0) NOT NULL,
        wc INTEGER DEFAULT (0) NOT NULL,
        expo INTEGER DEFAULT (0) NOT NULL,
        double_bed INTEGER DEFAULT (0) NOT NULL,
        single_bed INTEGER DEFAULT (0) NOT NULL,
        couch INTEGER DEFAULT (0) NOT NULL
    )
');
$pdo->query('
    CREATE UNIQUE INDEX bedroom_id_IDX ON bedroom (id)
');
$pdo->query('
CREATE TABLE IF NOT EXISTS reservation (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "user" INTEGER NOT NULL,
    bedroom INTEGER NOT NULL,
    "start" DATE NOT NULL,
    "end" DATE NOT NULL,
    validated INTEGER DEFAULT (0) NOT NULL,
    CONSTRAINT reservation_FK FOREIGN KEY ("user") REFERENCES users(id),
    CONSTRAINT reservation_FK_1 FOREIGN KEY (bedroom) REFERENCES bedroom(id)
);
');