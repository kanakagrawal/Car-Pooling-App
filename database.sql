CREATE TABLE user(
	email VARCHAR(64) PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	phone NUMERIC NOT NULL,	-- UNIQUE,
	creditcard VARCHAR(64),
	password VARCHAR(64) NOT NULL
)

CREATE TABLE car(
	carid VARCHAR(64) PRIMARY KEY,
	model VARCHAR(64) NOT NULL,
	color VARCHAR(64) NOT NULL,
	capacity NUMERIC NOT NULL,
	owner VARCHAR(64) REFERENCES user(email)
)

CREATE TABLE ride(
	carid VARCHAR(64) REFERENCES car(carid),
	time_stamp DATETIME,
	origin VARCHAR(64) NOT NULL,
	destination VARCHAR(64) NOT NULL,
	price NUMERIC NOT NULL,
	PRIMARY KEY(carid,time_stamp)
)


CREATE TABLE complete_ride(
	client VARCHAR(64) REFERENCES user(email),
	final_price NUMERIC NOT NULL,
	carid VARCHAR(64),
	time_stamp DATETIME,
	FOREIGN KEY(carid,time_stamp) REFERENCES ride(carid,time_stamp),
	PRIMARY KEY(carid,time_stamp,client)
)


