-- Drop any existing databases
DROP DATABASE IF EXISTS PUCC;
CREATE DATABASE PUCC;
USE PUCC;

-- Create a new blank table in the current database
CREATE TABLE pilots (
	pilotRANK CHAR (30) NOT NULL,
    FName CHAR (30) NOT NULL,
    LName CHAR (33) NOT NULL,
    CSign CHAR (30),
    pilotID int NOT NULL,
    PRIMARY KEY (pilotID)
    );
    
-- Insert pilots into system
INSERT INTO pilots VALUES ('Captain', 'Donny', 'Coffin', 'Headphones', 1);
INSERT INTO pilots VALUES ('Captain', 'Meghan', 'Vandermass', 'Snow', 2);
INSERT INTO pilots VALUES ('Captain', 'Morgan', 'Wagner', 'Oven', 3);
INSERT INTO pilots VALUES ('Captain', 'Brian', 'Guerrero', 'Glass', 4);
INSERT INTO pilots VALUES ('Captain', 'Giles', 'McGillick', 'Food', 5);
INSERT INTO pilots VALUES ('Captain', 'Kyle', 'Daley', 'Gamer', 6);
     
CREATE TABLE flights (
	flightID int NOT NULL,
    flightDesc char (254),
    PRIMARY KEY (flightID)
	);

-- Insert flights into system
INSERT INTO flights VALUES (1, 'Generic Description');
INSERT INTO flights VALUES (2, 'Generic Description');
INSERT INTO flights VALUES (3, 'Generic Description');
INSERT INTO flights VALUES (4, 'Generic Description');
INSERT INTO flights VALUES (5, 'Generic Description');
INSERT INTO flights VALUES (6, 'Generic Description');
INSERT INTO flights VALUES (7, 'Generic Description');
INSERT INTO flights VALUES (8, 'Generic Description');
INSERT INTO flights VALUES (9, 'Generic Description');
INSERT INTO flights VALUES (10, 'Generic Description');
INSERT INTO flights VALUES (11, 'Generic Description');
INSERT INTO flights VALUES (12, 'Generic Description');

CREATE TABLE syllabi_events (
	flightID int,
    eventID int NOT NULL,
    eventDesc char (254),
    PRIMARY KEY (eventID),
    CONSTRAINT FK_flights_se
		FOREIGN KEY (flightID) REFERENCES flights (flightID)
	);

-- Insert Syllabi_events into system
INSERT INTO syllabi_events VALUES (1, 1, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (2, 2, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (3, 3, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (4, 4, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (5, 5, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (6, 6, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (7, 7, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (8, 8, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (9, 9, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (10, 10, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (11, 11, 'SE Generic Description');
INSERT INTO syllabi_events VALUES (null, 12, 'SE Generic Description');

CREATE TABLE syllabi (
	syllabiID int NOT NULL,
    eventID int NOT NULL,
    syllabiDesc char (254),
    CONSTRAINT syllabi_PK PRIMARY KEY (syllabiID, eventID),
    CONSTRAINT FK_syllabi_events_s
		FOREIGN KEY (eventID) REFERENCES syllabi_events (eventID)
	);

-- Insert into Syllabi
INSERT INTO syllabi VALUES (1, 1, 'S Generic Description');
INSERT INTO syllabi VALUES (1, 2, 'S Generic Description');
INSERT INTO syllabi VALUES (1, 3, 'S Generic Description');
INSERT INTO syllabi VALUES (1, 4, 'S Generic Description');
INSERT INTO syllabi VALUES (1, 5, 'S Generic Description');
INSERT INTO syllabi VALUES (1, 6, 'S Generic Description');
INSERT INTO syllabi VALUES (1, 7, 'S Generic Description');
INSERT INTO syllabi VALUES (1, 8, 'S Generic Description');

CREATE TABLE syllabi_type (
	pilotID int NOT NULL,
    syllabiID int NOT NULL,
    CONSTRAINT syllabi_list_PK PRIMARY KEY (pilotID, syllabiID),
	CONSTRAINT FK_pilots_st
		FOREIGN KEY (pilotID) REFERENCES pilots (pilotID),
	CONSTRAINT FK_syllabi_st
		FOREIGN KEY (syllabiID) REFERENCES syllabi (syllabiID)
	);

-- Insert into Syllabi_type
INSERT INTO syllabi_type VALUES (1, 1);
INSERT INTO syllabi_type VALUES (2, 1);
INSERT INTO syllabi_type VALUES (3, 1);
INSERT INTO syllabi_type VALUES (4, 1);
INSERT INTO syllabi_type VALUES (5, 1);
INSERT INTO syllabi_type VALUES (6, 1);

CREATE TABLE completed_prereqs (
	pilotID int NOT NULL,
    eventID int NOT NULL,
    CONSTRAINT completed_prereqs_PK PRIMARY KEY (pilotID, eventID),
	CONSTRAINT FK_pilots_cp 
		FOREIGN KEY (pilotID) REFERENCES pilots (pilotID),
	CONSTRAINT FK_syllabi_events_cp
		FOREIGN KEY (eventID) REFERENCES syllabi_events (eventID)
	);

-- Insert into Completed_prereqs
INSERT INTO completed_prereqs VALUES (1, 1);
INSERT INTO completed_prereqs VALUES (1, 2);
INSERT INTO completed_prereqs VALUES (1, 3);
INSERT INTO completed_prereqs VALUES (2, 1);
INSERT INTO completed_prereqs VALUES (2, 2);
INSERT INTO completed_prereqs VALUES (2, 3);
INSERT INTO completed_prereqs VALUES (3, 1);
INSERT INTO completed_prereqs VALUES (3, 2);
INSERT INTO completed_prereqs VALUES (3, 3);
INSERT INTO completed_prereqs VALUES (4, 1);
INSERT INTO completed_prereqs VALUES (4, 2);
INSERT INTO completed_prereqs VALUES (4, 3);
INSERT INTO completed_prereqs VALUES (5, 1);
INSERT INTO completed_prereqs VALUES (5, 2);
INSERT INTO completed_prereqs VALUES (5, 3);
INSERT INTO completed_prereqs VALUES (6, 1);
INSERT INTO completed_prereqs VALUES (6, 2);
INSERT INTO completed_prereqs VALUES (6, 3);

select * from pilots;
select * from flights;
select * from completed_prereqs;
select * from syllabi_events;
select * from syllabi_type;
select * from syllabi;

