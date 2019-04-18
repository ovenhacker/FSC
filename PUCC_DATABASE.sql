-- Drop any existing databases
DROP DATABASE IF EXISTS PUCC;
CREATE DATABASE PUCC;
USE PUCC;

-- Create all tables
CREATE TABLE syllabus (
    fltID VARCHAR(8),
    fltNxt VARCHAR(8),
    fltNxtTwo VARCHAR(5),
    fltRqOne VARCHAR(8),
    fltRqTwo VARCHAR(5),
    fltRqThree VARCHAR(5),
    acReq VARCHAR(1),
    mxConfig VARCHAR(24),
    formationXships NUMERIC(2, 1),
    night VARCHAR(1);
);

CREATE TABLE pilotFlt (
    pilotID NUMERIC(4),
    fltIDCompleted VarChar(8)
);

CREATE TABLE pilots (
    pilotID NUMERIC(4),
    lName VARCHAR(30),
    fName VARCHAR(8),
    callSign VARCHAR(12),
    rank VARCHAR(5),
    ip VARCHAR(1),
    fcpRcp VARCHAR(1),
    syllabusOne NUMERIC(2),
    syllabusTwo NUMERIC(2),
    syllabusThree NUMERIC(2),
		puckType VARCHAR(2)
);

CREATE TABLE syllabusIDs (
	syllabusID NUMERIC(2),
	syllabusName VARCHAR(30)
);

CREATE TABLE puckColors (
	puckType VARCHAR(2),
	background VARCHAR(32),
	font VARCHAR(32)
);

-- populate tables
INSERT INTO syllabus VALUES
    ('TR-1','TR-2','-','-','-','-','Y','cold gun',1.0,'n'),
    ('TR-2','TR-3','-','TR-1','-','-','-','cold gun',1.0,'n'),
    ('TR-3','TR-4','-','TR-2','-','-','-','cold gun',2.0,'n'),
    ('TR-4','TR-5','-','TR-3','-','-','-','cold gun',2.0,'n'),
    ('TR-5','TR-6 (P)','-','TR-4','-','-','-','cold gun',2.0,'n'),
    ('TR-6 (P)','AHC','-','TR-5','-','-','Y','cold gun',2.0,'n'),
    ('AHC','BFM-1','-','TR-6 (P)','-','-','Y','cold gun, 8xBDL50',2.0,'n'),
    ('BFM-1','BFM-2','-','AHC','-','-','Y','cold gun, missile config',2.0,'n'),
    ('BFM-2','BFM-3','-','BFM-1','-','-','-','cold gun, missile config',2.0,'n'),
    ('BFM-3','BFM-4','-','BFM-2','-','-','-','cold gun, missile config',2.0,'n'),
    ('BFM-4','BFM-5','-','BFM-3','-','-','-','cold gun, missile config',2.0,'n'),
    ('BFM-5','BFM-6','-','BFM-4','-','-','-','cold gun, missile config',2.0,'n'),
    ('BFM-6','BFM-7','-','BFM-5','-','-','-','cold gun, missile config',2.0,'n'),
    ('BFM-7','BFM-8','-','BFM-6','-','-','Y','cold gun, missile config',2.0,'n'),
    ('BFM-8','ACM-1','-','BFM-7','-','-','-','cold gun, missile config',2.0,'n'),
    ('ACM-1','SA-1','-','BFM-8','-','-','Y','8xBDL50, 2xAMRAM',1.0,'n'),
    ('SA-1','SA-2','-','ACM-1','-','-','Y','hot gun, 2xAMRAM',4.0,'n'),
    ('SA-2','LASDT-1','-','SA-1','-','-','Y','hot gun, 2xAMRAM',4.0,'n'),
    ('LASDT-1','LASDT-2','-','SA-2','-','-','Y','hot gun, 8xBDL50',4.0,'n'),
    ('LASDT-2','SA-3','-','LASDT-1','-','-','-','hot gun, 8xBDL50',4.0,'n'),
    ('SA-3','SA-4','-','LASDT-2','-','-','Y','hot gun, 2xAMRAM',2.0,'n'),
    ('SA-4','ACM-2','-','SA-3','-','-','-','hot gun, 2xAMRAM',2.0,'n'),
    ('ACM-2','ACM-3','-','SA-4','-','-','Y','8xBDL50, 2xAMRAM',4.0,'n'),
    ('ACM-3','TI-1','-','ACM-2','-','-','-','8xBDL50, 2xAMRAM',4.0,'n'),
    ('TI-1','TI-2','-','ACM-3','-','-','Y','cold gun',1.0,'n'),
    ('TI-2','TI-3','-','TI-1','-','-','Y','cold gun',1.0,'n'),
    ('TI-3','LASDT-3','NTR-1','TI-2','-','-','Y','cold gun',2.0,'n'),
    ('LASDT-3','SA-5','-','TI-3','-','-','Y','hot gun, 8xBDL50',4.0,'n'),
    ('SA-5','SA-6','-','LASDT-3','-','-','-','hot gun, 2xAMRAM',2.0,'n'),
    ('SA-6','SA-7','-','SA-5','-','-','-','hot gun, 2xAMRAM',2.0,'n'),
    ('SA-7','SA-8','-','SA-6','-','-','-','hot gun, 2xAMRAM',2.0,'n'),
    ('SA-8','SA-9','-','SA-7','-','-','Y','hot gun, 2xAMRAM',2.0,'n'),
    ('SA-9','SA-10','-','SA-8','-','-',NULL,'hot gun, 2xAMRAM',2.0,'n'),
    ('SA-10','SAT-1','-','SA-9','-','-','Y','hot gun, 2xAMRAM',2.0,'n'),
    ('NTR-1','NTR-2','-','TI-3','-','-','Y','8xBDL50, 4xAMRAM',1.0,'n'),
    ('NTR-2','NTI','-','NTR-1','-','-','-','8xBDL50, 4xAMRAM',1.0,'n'),
    ('NTI','SAN-1','SAN-3','NTR-2','-','-','Y','cold gun',2.0,'n'),
    ('SAN-1','SAN-2','-','NTI','-','-','Y','8xBDL50, 4xAMRAM',2.0,'n'),
    ('SAN-2','SAT-1','-','SAN-1','-','-','Y','8xBDL50, 4xAMRAM',4.0,'n'),
    ('SAN-3','SAN-4','-','NTI','-','-','Y','8xBDL50, 4xAMRAM',2.0,'n'),
    ('SAN-4','SAT-1','-','SAN-3','-','-','Y','8xBDL50, 4xAMRAM',2.0,'n'),
    ('SAT-1','SAT-2','-','SA-10','SAN-2','SAN-4','-','hot gun, 4xBDL50',1.0,'n'),
    ('SAT-2','-','-','SAT-1','-','-','-','hot gun, 4xBDL50',1.0,'n'),
    ('DAAR','NAAR','-','TR-4','-','-','Y','cold gun',1.0,'n'),
    ('NAAR','-','-','DAAR','-','-','Y','cold gun',1.0,'n');

INSERT INTO pilots VALUES
    (1,'Lipkin',         'Sean',    'POTUS',      'Cpt',  'Y','F',3,2,    NULL, 'IP'),
    (2,'Johnson',        'Dillon',  'Shoe',       'LtCol','Y','R',3,2,    1,    'IP'),
    (3,'McGillick',      'Giles',   'Ski',        '2Lt',  'N','F',3,NULL, NULL, 'BS'),
    (4,'Coffin-Shiavon', 'Donald',  'Headphones', '2Lt',  'N','R',3,NULL, NULL, 'BS'),
    (6,'Miller',         'Joe',     'Window',     '1Lt',  'y','f',3,NULL, NULL, 'IP'),
    (7,'Gutierrez',      'Luis',    'Misty',      '1LT',  'n','r',2,NULL, NULL, 'IS'),
    (8,'Patel',          'Keeshan', 'Monty',      'Cpt',  'y','f',3,2,    NULL, 'IP'),
    (9,'Balasubramanian','Partha',  'Reaper',     'Maj',  'y','r',3,2,    1,    'IP'),
    (10,'Kostenbader',   'Karl',    'Tracker',    'Cpt',  'n','f',3,NULL, NULL, 'BS'),
    (11,'Ollis',         'Seth',    'Chopper',    'Gen',  'N','r',1,NULL, NULL, 'SS'),
    (12,'Emerson',       'Katie',   'Baby Giraffe','Cpt', 'Y','f',3,2,    NULL, 'IP'),
    (13,'Young',         'Felix',   'BOLT',       '3Lt',  'N','r',3,NULL, NULL, 'BS'),
    (14,'Mikos',         'Ed',      'AX',         '1Lt',  'n','f',3,NULL, NULL, 'BS'),
    (15,'Pietrzak',      'George',  'Flipper',    '2lt',  'n','r',3,NULL, NULL, 'BS'),
    (16,'Krishnan',      'Luke',    'Red Roper',  'cpt',  'n','r',1,NULL, NULL, 'SS'),
    (17,'Higginbotham',  'Samuel',  'Ninja',      '1lt',  'n','f',3,NULL, NULL, 'BS'),
    (18,'Auger',         'Tony',    'Legend',     'cpt',  'y','f',3,1,    NULL, 'IP'),
    (19,'Ostendorf',     'Jordan',  'Zelda',      'ltCol','y','r',3,2,    1,    'IP'),
    (20,'Huffman',       'Martin',  'Charzard',   'col',  'n','f',1,NULL, NULL, 'SS'),
    (21,'Painter',       'Paul',    'Grumpy Cat', 'maj',  'y','r',3,NULL, NULL, 'BS'),
    (22,'Livingston',    'John',    'Yellow',     'Col',  'n','f',1,NULL, NULL, 'SS'),
    (23,'Eltz',          'Barb',    'Chair',      'cpt',  'y','r',3,2,    NULL, 'IP'),
    (24,'Bruggeman',     'Jennifer','Reaper',     'ltcol','y','f',3,2,    1,    'IP'),
    (25,'Breeze',        'Kiele',   'Spoon',      'ltgen','n','r',1,NULL, NULL, 'SS'),
    (26,'Tilton',        'Paris',   'Python',     '2lt',  'n','f',3,NULL, NULL, 'BS');

INSERT INTO pilotFlt VALUES
    (3, 'BFM-8'),
    (4, 'ACM-1'),
    (7, 'SA-1'),
    (10, 'SA-1'),
    (11, 'ACM-1'),
    (13, 'BFM-8'),
    (14, 'BFM-8'),
    (15, 'BFM-7'),
    (16, 'BFM-7'),
    (17, 'BFM-8'),
    (20, 'BFM-8'),
    (22, 'ACM-1'),
    (25, 'ACM-1'),
    (26, 'SA-1');

INSERT INTO syllabusIDs VALUES
	(1, 'S-Course'),
	(2, 'I-Course'),
	(3, 'B-Course');

INSERT INTO puckColors VALUES
	('IP', 'black','white'),
	('BS', 'green','black'),
	('SS', 'magenta','black'),
	('IS', 'yellow','black');



-- stored procedures
-- to execute: EXEC procedure_name;
CREATE PROCEDURE prioritize_pilots AS SELECT * FROM pilots ORDER BY syllabusOne, syllabusTwo, syllabusThree GO;
SELECT lname, background, font FROM pilots RIGHT
  JOIN puckColors ON pilots.puckType = puckColors.puckType ORDER BY syllabusOne;
SELECT lname, fltIDCompleted, fltNxt fltNxtTwo FROM pilots
    JOIN pilotFlt ON pilots.pilotID = pilotFlt.pilotID
    JOIN syllabus ON pilotFlt.fltIDCompleted = syllabus.fltID
