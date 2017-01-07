CREATE TABLE building (
	name varchar(25),
	address varchar(25) NOT NULL,
	city varchar(25)NOT NULL,
	state varchar(25)NOT NULL,
	zipcode varchar(10)NOT NULL,
	CONSTRAINT bd_ID PRIMARY KEY (address, zipcode)
)ENGINE=INNODB;


CREATE TABLE office (
	room_number integer AUTO_INCREMENT PRIMARY KEY,
	waiting_room_capacity integer
)ENGINE=INNODB;


CREATE TABLE doctor (
	medical_license_num integer AUTO_INCREMENT PRIMARY KEY,
	first_name varchar(25),
	last_name varchar(25),
)ENGINE=INNODB;


CREATE TABLE patient (
	ssn varchar(11) PRIMARY KEY,
	first_name varchar(25),
	last_name varchar(25),
)ENGINE=INNODB;

CREATE TABLE labwork (
	test_name varchar(25),
	test_timestamp timestamp,
	test_value varchar(500) 
)ENGINE=INNODB;


CREATE TABLE conditon (
	icd10 varchar(25) PRIMARY KEY,
	description varchar(500)
)ENGINE=INNODB;

CREATE TABLE insurance (
	policy_num varchar(50) FOREIGN KEY,
	insurer varchar(25)
)ENGINE=INNODB;