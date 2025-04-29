  
CREATE TABLE tiers (
	id serial PRIMARY KEY,
	title VARCHAR (255) NOT NULL,
	price INT
);

INSERT INTO tiers (title, price) 
VALUES 
('Bronze', 20),
('Silver', 50),
('Gold', 100),
('Platinum', 250);



CREATE TABLE members (
	id serial PRIMARY KEY,
	first_name VARCHAR (255) NOT NULL,
	last_name VARCHAR (255),
  address VARCHAR (255),
  tier_id INT,
  active TINYINT(1) DEFAULT 0
);
INSERT INTO members (first_name, last_name, adress, tier_id, active) 
VALUES 
('Selena', 'Heidenreich', '858 Murl Locks Lake Jonasside, TN 33085-2765' , 2, 1),
('Melisa', 'Bas', '994 Kunze Inlet Kemmerberg, WA 69344', 3, 1),
('Matias', 'Larson', '12340 Kub Ridge Hailiemouth, MN 96724', 3, 1),
('Mckayla', 'Gopinatha', '50601 Homenick Lake Suite 855 Keelingbury, WV 62917-8508', 4, 1);

