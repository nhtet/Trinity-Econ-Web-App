CREATE TABLE Students(
sid INTEGER PRIMARY KEY AUTOINCREMENT,
fullname varchar(255),
username varchar(255),
password varchar(255),
email varchar(255),
dob varchar(255),
sex varchar(10));

CREATE TABLE Demand(
sid INTEGER NOT NULL,
gid INTEGER NOT NULL,
ndemand INTEGER,
tdemand INTEGER,
ademand INTEGER,
PRIMARY KEY (sid,gid));

CREATE TABLE Price(
sid INTEGER NOT NULL,
gid INTEGER NOT NULL,
price INTEGER,
adprice INTEGER,
PRIMARY KEY (sid,gid));

CREATE TABLE Cost(
sid INTEGER NOT NULL,
gid INTEGER NOT NULL,
cost INTEGER,
PRIMARY KEY (sid,gid));

CREATE TABLE Profit(
sid INTEGER NOT NULL,
gid INTEGER NOT NULL,
tprofit INTEGER,
adprofit INTEGER,
cprofit INTEGER,
PRIMARY KEY (sid,gid)
);

CREATE TABLE Reserved(
sid INTEGER NOT NULL,
gid INTEGER NOT NULL,
reserved INTEGER,
PRIMARY KEY (sid,gid)
);


CREATE TABLE Revenue(
sid INTEGER NOT NULL,
gid INTEGER NOT NULL,
trevenue INTEGER,
PRIMARY KEY (sid,gid));

CREATE TABLE Avtotal(
gid INTEGER NOT NULL,
aprice VARCHAR(255),
tadvertising INTEGER,
tndemand INTEGER,
tademand INTEGER,
tpdemand INTEGER,
ttdemand INTEGER,
trevenue INTEGER,
tcost INTEGER,
tpprofit INTEGER,
tcpprofit INTEGER,
ttprofit INTEGER,
tcffdemand INTEGER,
tadvprofit INTEGER
);

CREATE TABLE Elimination(
sid INTEGER NOT NULL,
gid INTEGER NOT NULL,
elimination varchar(255)
);

CREATE TABLE Gameround(
gid INTEGER PRIMARY KEY AUTOINCREMENT
);

INSERT INTO Gameround VALUES (NULL);
INSERT INTO Students VALUES(NULL,'Arthur M Schneider','aschneider','schneider','Arthur.Schneider@trincoll.edu','05/19/1963','Male');
