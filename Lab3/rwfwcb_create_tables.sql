/*	Robert Fink
--	rwfwcb 18074424
--	cs3380 lab3
*/


/*A1--Create the pilot table.*/
create table pilot (
	fname varchar(15),
	lname varchar(15) NOT NULL,
	license_num integer AUTO_INCREMENT PRIMARY KEY,
	birthdate date NOT NULL
)ENGINE=INNODB;

/*A2--Create the plane table with a foreign key referencing 'pilot'.*/
create table plane (
	tail_num varchar(10) PRIMARY KEY,
	brand varchar(25),
	model varchar(25),
	owner_license_num integer references pilot(license_num),
	num_engines smallint
)ENGINE=INNODB;

/*B1--Insert 10 records into the pilot table.*/
insert into pilot values('Charles', 'Lindbergh', DEFAULT, '1902-04-02');
insert into pilot values('Amelia', 'Earhart', DEFAULT, '1897-07-24');
insert into pilot values('Bessie', 'Coleman', DEFAULT, '1892-01-26');
insert into pilot values('Chuck', 'Yeager', DEFAULT, '1923-02-13');
insert into pilot values('Jeana', 'Yeager', DEFAULT, '1952-05-18');
insert into pilot values('Chesley', 'Sullenberger', DEFAULT, '1951-01-23');
insert into pilot values('Matt', 'Hall', DEFAULT, '1971-09-16');
insert into pilot values('Rogert', 'Williams', DEFAULT, '1894-08-12');
insert into pilot values('Paul', 'Tibbets', DEFAULT, '1915-02-23');
insert into pilot values('Jacqueline', 'Cochran', DEFAULT, '1906-05-11');

/*B2--Insert 10 records into the plane table (provide a valid license #).*/
insert into plane values(1, 'Boeing', '747-8', 21, 4);
insert into plane values(2, 'Boeing', '747-8', 1, 4);
insert into plane values(3, 'Boeing', '747-8', 11, 4);
insert into plane values(4, 'Boeing', '777x', 91, 2);
insert into plane values(5, 'Boeing', '787', 81, 2);
insert into plane values(6, 'Airbus', 'A318', 71, 1);
insert into plane values(7, 'Airbus', 'A380', 61, 4);
insert into plane values(8, 'Airbus', 'A380', 31, 4);
insert into plane values(9, 'Airbus', 'A320', 41, 2);
insert into plane values(10, 'Cessna', 'Z900', 51, 6);
