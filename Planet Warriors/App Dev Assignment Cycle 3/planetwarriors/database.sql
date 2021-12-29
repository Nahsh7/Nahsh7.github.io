/*create database*/
CREATE DATABASE planetwarriors;

/*use the database*/
USE planetwarriors;

/*Create Surveyor Table*/

CREATE TABLE Surveyor
(
	surveyorID int(3) UNIQUE NOT NULL AUTO_INCREMENT,
	firstName varchar(255) NOT NULL,
	lastName varchar(255)  NOT NULL,
	userName varchar(255) UNIQUE NOT NULL,
	phoneNo varchar(255) UNIQUE NOT NULL,
	gender varchar(255)  NOT NULL,
	password varchar(255)  NOT NULL,
	address varchar(255)  NOT NULL,
	position varchar(255) NOT NULL,
	PRIMARY KEY(surveyorID)
);

/*insert some values into the surveyor table*/
INSERT INTO Surveyor(firstName, lastName, userName, phoneNo, gender, password, address, position) VALUES("Kim", "Possible", "kim123", "724-2145", "Female", "password123", "San Juan, Second Street", "surveyor");
INSERT INTO Surveyor(firstName, lastName, userName, phoneNo, gender, password, address, position) VALUES("Harry", "Goodman", "harry321", "255-2153", "Male", "goodman123", "34 Eastern Main Road St Augstine", "surveyor");
INSERT INTO Surveyor(firstName, lastName, userName, phoneNo, gender, password, address, position) VALUES("James", "Phillip", "james567", "628-2184", "Male", "phillip789", "Apartment 4, Waterloo Rd, Arouca", "surveyor");


/*Create table for coordinator*/
CREATE TABLE Coordinator
(
	coordinatorID int(3) UNIQUE NOT NULL AUTO_INCREMENT,
	firstName varchar(255) NOT NULL,
	lastName varchar(255)  NOT NULL,
	userName varchar(255) UNIQUE NOT NULL,
	phoneNo varchar(255) UNIQUE NOT NULL,
	gender varchar(255)  NOT NULL,
	password varchar(255)  NOT NULL,
	position varchar(255) NOT NULL,
	PRIMARY KEY(coordinatorID)
);

/*insert some values into the coordinator table*/
INSERT INTO Coordinator(firstName, lastName, userName, phoneNo, gender, password, position) VALUES("Lary", "Garcia", "lary123", "755-2145", "Male", "lary123", "coordinator");
INSERT INTO Coordinator(firstName, lastName, userName, phoneNo, gender, password, position) VALUES("David", "Jones", "david321", "351-2141", "Male", "david123", "coordinator");
INSERT INTO Coordinator(firstName, lastName, userName, phoneNo, gender, password, position) VALUES("William", "Brown", "brownwilliam", "471-2411", "Male", "williambrown456", "coordinator");


/*Create Site table*/
CREATE TABLE Site
(
	siteID int(3) UNIQUE NOT NULL AUTO_INCREMENT,
	siteName varchar(255) UNIQUE NOT NULL,
	siteGeography varchar(255) NOT NULL,
	address varchar(255)  NOT NULL,
	generalDescription varchar(500) NOT NULL,
	accessFee varchar(255)  NOT NULL,
	dateAdded timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
	warden varchar(255) UNIQUE NOT NULL,
	wardenNo varchar(255) UNIQUE NOT NULL,
	status varchar(255) NOT NULL,
	imageName varchar(255) NOT NULL,
	surveyorID int NOT NULL,
	PRIMARY KEY(siteID),
	FOREIGN KEY(surveyorID) REFERENCES Surveyor (surveyorID)
);

/*insert some values into the site table*/
INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES ("Paria Falls", "Waterfall", "Blanchisseuse", "Paria Falls is a waterfall located in Blanchisseuse ", "$100", "Henry Roberts", "624-2513", "ready", "Paria-Falls.png", "1");

INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES ("Caroni Swamp", "Swamp", "Caroni", "Caroni Swamp is a swamp located in Caroni", "$100", "Hermione Jones", "722-2141", "not ready", "Caroni-Swamp.png", "3");

INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES ("Mermaid Pool", "Natural Pool", "MWGP+MP7, Matura", "Mermaid Pool is a natural pool located in MWGP+MP7, Matura", "$100", "Olivia Scott", "288-2451", "ready", "Mermaid-Pool.png", "2");

INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES ("Pointe-à-Pierre Wildfowl", "Wetland", "Pointe-à-Pierre", "Point-a-Pierre Wild Fowl Trust is a wetland habitat that is home to locally endangered wetland birds. Interestingly, the Trust is located on the compound of a major petrochemical and oil refinery in south Trinidad.", "$100", "Frank James", "583-2451", "ready", "pointapierre.jpg", "2");

INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES ("Emperor Valley Zoo", "Zoo", "Port-of-Spain", "Emperor Valley Zoo is the biggest zoo in Trinidad and Tobago. It is located North of the Queen's Park Savannah and West of the Royal Botanic Gardens in Port of Spain.", "$100", "Bob Frank", "634-2531", "not ready", "emperorvalleyzoo2.jpg", "3");

INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES ("Queen's Park Savannah", "Savannah", "Port-of-Spain", "Queen's Park Savannah is a park in Port of Spain, Trinidad and Tobago. Known locally as simply the Savannah, it is Port of Spain's largest open space.", "$100", "Fred Phillip", "743-6331", "ready", "queenspark2.jpg", "2");

INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES ("Las Cuevas Beach", "Beach", "North of Port-of-Spain", "The sandy beach of Las Cuevas Bay is located in a large bay in the north of the island of Trinidad. Its length exceeds 2.5 km and its width is 50 metres.", "$100", "Ben Paul", "473-3231", "not ready", "lascuevas.jpg", "1");

INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES ("Asa Wright Nature Centre", "Rain Forest", "Blanchisseuse", "This small resort, buried among mountains deep in the Trinidad rain forest, is famous for its amazing diversity in animal and plant species.", "$100", "Bruce Wayne", "736-3521", "ready", "asawright.jpg", "1");

INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES ("Manzanilla Beach", "Beach", "East Coast", "Manzanilla Beach is a beach in Trinidad and Tobago. Located on the east coast of Trinidad, the larger island, the beach sits directly on the Manzanilla Bay adjoined to the larger north Atlantic Ocean.", "$100", "Peter Parker", "624-2112", "not ready", "manzanilla.jpg", "1");

INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES ("Maracus Beach", "Beach", "North of Port-of-Spain", "Maracas Bay is a bay with sandy beach on the island of Trinidad. It is located on the north side of the island, an hour's mountainous drive from the capital city of Port of Spain via the North Coast Road.", "$100", "Bruce Banner", "624-4212", "ready", "maracus2.jpg", "1");

/*Create Volunteer table*/

CREATE TABLE Volunteer
(
	volunteerID int(3) UNIQUE NOT NULL AUTO_INCREMENT,
	firstName varchar(255) NOT NULL,
	lastName varchar(255)  NOT NULL,
	imageName varchar(255) NOT NULL,
	nationalID varchar(11) UNIQUE NOT NULL,
	phoneNo varchar(255) UNIQUE NOT NULL,
	email varchar(255) UNIQUE NOT NULL,
	address varchar(255)  NOT NULL,
	gender varchar(255)  NOT NULL,
	DoB datetime NOT NULL,
	coordinatorID int NOT NULL,
	PRIMARY KEY(volunteerID),
	FOREIGN KEY(coordinatorID) REFERENCES Coordinator (coordinatorID)
);

INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES("Paul", "Jackson", "Profile-pic.png", "19900506", "632-2151", "pauljackson@gmail.com", "34 Mausica Road, D'abadie ", "Male", "1990-05-02", "1" );
INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES("Skylar", "Tennison", "Profile-pic.png", "20000422621", "789-2156", "skylerjackson@hotmail.com", "24 Cleaver Road, Arima", "female", "2000-04-22", "2" );
INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES("Ryan", "Logan", "Profile-pic.png", "19990708625", "791-9241", "ryanlogan@yahoo.com", "Apartment 5, Flour Lane, Sande Grande", "Male", "1999-07-08", "1" );
INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES("Rajh", "Brown", "Profile-pic.png", "20010812626", "677-3261", "rajhbrown@gmail.com", "4 Daniel Street, Valencia", "Male", "2001-08-12", "2" );
INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES("Sachin", "Maharaj", "Profile-pic.png", "20020708235", "299-2915", "sachinmaharj@gmail.com", "36 High Street, San Juan", "Male", "2002-07-08", "2" );
INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES("Shakira", "Cedeno", "Profile-pic.png", "1998050662", "388-2151", "shakiracedeno@gmail.com", "43 Kings Street, Woodbrook", "Female", "1998-05-06", "2" );
INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES("Adrian", "Chance", "Profile-pic.png", "19800509637", "277-2151", "adrianchance@gmail.com", "Apartment 8, Louis Lane, Barataria",  "Male", "1980-05-09", "3" );
INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES("Elena", "Powers", "Profile-pic.png", "20010603326", "399-1255", "elenapowers@hotmail.com", "41 Monroe Road, Chaguanas",  "female", "2001-06-03", "3" );
INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES("Bryan", "Williams", "Profile-pic.png", "19990725326", "420-2151", "bryanwilliams@outlook.com", "6 Queens Road, St.Anns",  "Male", "1999-07-25", "3" );
INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES("Dwayne", "Carter", "Profile-pic.png", "20020617", "620-1516", "dwaynecarter@outlook.com", "13 Henry Street, San Fernando",  "Male", "2002-06-17", "3" );

/*make the volunteeredSites table*/
CREATE TABLE volunteeredSites
(
	volunteeredSitesID int(3) UNIQUE NOT NULL AUTO_INCREMENT,
	volunteerID int NOT NULL,
	siteID int NOT NULL,
	PRIMARY KEY(volunteeredSitesID),
	FOREIGN KEY(volunteerID) REFERENCES Volunteer (volunteerID),
	FOREIGN KEY(siteID) REFERENCES Site (siteID)

);

