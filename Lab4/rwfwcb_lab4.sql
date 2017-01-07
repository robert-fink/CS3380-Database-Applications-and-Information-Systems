/*	Robert Fink
	rwfwcb 18074424
	lab 4
*/

DROP TABLE IF EXISTS building;
CREATE TABLE building (
	name varchar(25),
	address varchar(25) NOT NULL,
	city varchar(25) NOT NULL,
	state varchar(25) NOT NULL,
	zipcode varchar(10) NOT NULL,
	PRIMARY KEY (address, zipcode)
)ENGINE=INNODB;


DROP TABLE IF EXISTS office;
CREATE TABLE office (
	room_number integer NOT NULL PRIMARY KEY,
	waiting_room_capacity integer DEFAULT 40 NOT NULL,
	address varchar(25),
	zipcode varchar(10),
	FOREIGN KEY (address, zipcode)
	REFERENCES building(address, zipcode) ON DELETE CASCADE
	)ENGINE=INNODB;


DROP TABLE IF EXISTS doctor;
CREATE TABLE doctor (
	medical_license_num integer(4),
	first_name varchar(25),
	last_name varchar(25),
	office_number integer(4),
	PRIMARY KEY (medical_license_num),
	FOREIGN KEY (office_number) REFERENCES office(room_number) ON DELETE CASCADE
)ENGINE=INNODB;

DROP TABLE IF EXISTS patient;
CREATE TABLE patient (
	ssn varchar(11) PRIMARY KEY,
	first_name varchar(25),
	last_name varchar(25),
	insuranceID integer(12)
)ENGINE=INNODB;

DROP TABLE IF EXISTS appointment;
CREATE TABLE appointment (
	appt_date date,
	appt_time time,
	doctor_license_num integer(5),
	patient_ssn varchar(11),
	FOREIGN KEY (doctor_license_num) REFERENCES doctor(medical_license_num) ON DELETE CASCADE,
	FOREIGN KEY (patient_ssn) REFERENCES patient(ssn) ON DELETE CASCADE,
	PRIMARY KEY (appt_date, appt_time, doctor_license_num, patient_ssn)
)ENGINE=INNODB;

DROP TABLE IF EXISTS `condition`;
CREATE TABLE `condition` (
	icd10 varchar(25) PRIMARY KEY,
	description varchar(500)
)ENGINE=INNODB;


DROP TABLE IF EXISTS labwork;
CREATE TABLE labwork (
	test_name varchar(25),
	test_timestamp timestamp,
	test_value varchar(500),
	patient_ssn varchar(11),
	FOREIGN KEY (patient_ssn) REFERENCES patient(ssn) ON DELETE CASCADE,
	CONSTRAINT labworkID PRIMARY KEY (patient_ssn, test_name, test_timestamp)
)ENGINE=INNODB;


DROP TABLE IF EXISTS insurance;
CREATE TABLE insurance (
	patient_ssn varchar(11),
	policy_num varchar(50),
	insurer varchar(25),
	FOREIGN KEY (patient_ssn) REFERENCES patient(ssn) ON DELETE CASCADE,
	CONSTRAINT insuranceID PRIMARY KEY (patient_ssn, policy_num, insurer)
)ENGINE=INNODB;
