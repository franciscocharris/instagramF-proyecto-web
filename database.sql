CREATE DATABASE instagramf;
use instagramf;
-- cosas que cambie en la tabla de ususrios
-- role: predeterminado user, surname: predeterminado  null, nick:predeterminado null, image: predeterminado null
CREATE TABLE users(
	id int(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	role VARCHAR(20) NOT NULL,
	name VARCHAR(100) NOT NULL,
	surname VARCHAR(200) NOT NULL,
	nick VARCHAR(100) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	image VARCHAR(255) NOT NULL,
	created_at DATETIME,
	updated_at DATETIME,
	remember_token VARCHAR(255)
);

CREATE TABLE images(
	id INT(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	user_id INT(255) NOT NULL,
	image_path VARCHAR(255) NOT NULL,
	description TEXT,
	created_at DATETIME,
	update_at DATETIME,
	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments(
	id INT(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	user_id INT(255) NOT NULL,
	image_id INT(255) NOT NULL,
	content TEXT NOT NULL,
	created_at DATETIME,
	update_at DATETIME,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (image_id) REFERENCES images(id)
);

CREATE TABLE likes(
	id INT(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	user_id INT(255) NOT NULL,
	image_id INT(255) NOT NULL,
	created_at DATETIME,
	update_at DATETIME,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (image_id) REFERENCES images(id)
);

-- insertar en la tabla users

INSERT INTO users (role, name, surname, nick, email, password, image, created_at, update_at, remember_token) 
VALUES ('user', 'Fran', 'charris Camargo', 'mr.proelite', 'fran@gmail.com', 1, 'fran.jpg', CURTIME(), CURTIME(), NULL );

INSERT INTO users (role, name, surname, nick, email, password, image, created_at, update_at, remember_token) 
VALUES ('user', 'santi', 'charris Camargo', 'mr.santi', 'santi@gmail.com', 1, 'santi.jpg', CURTIME(), CURTIME(), NULL );

INSERT INTO users (role, name, surname, nick, email, password, image, created_at, update_at, remember_token) 
VALUES ('user', 'mirian', ' Camargo', 'mami', 'mirian@gmail.com', 1, 'mami.jpg', CURTIME(), CURTIME(), NULL );

-- insertar en la tabla images
INSERT INTO images (user_id, image_path, description, created_at, update_at) VALUES (1, 'fran.jpg', 'descripcion de prueba 1', CURTIME(), CURTIME());

INSERT INTO images (user_id, image_path, description, created_at, update_at) VALUES (1, 'fran2.jpg', 'descripcion de prueba 2', CURTIME(), CURTIME());

INSERT INTO images (user_id, image_path, description, created_at, update_at) VALUES (1, 'fran3.jpg', 'descripcion de prueba 3', CURTIME(), CURTIME());

INSERT INTO images (user_id, image_path, description, created_at, update_at) VALUES (3, 'mami.jpg', 'descripcion de prueba 4', CURTIME(), CURTIME());

-- insertar comentarios

INSERT INTO comments (user_id, image_id, content, created_at, update_at) VALUES (1, 4, 'buena foto de familia', CURTIME(), CURTIME());

INSERT INTO comments (user_id, image_id, content, created_at, update_at) VALUES (2, 1, 'buena foto EN LA PLAYA', CURTIME(), CURTIME());

INSERT INTO comments (user_id, image_id, content, created_at, update_at) VALUES (2, 4, 'buena foto ', CURTIME(), CURTIME());

-- insertar en likes

INSERT INTO likes (user_id, image_id, created_at, update_at) VALUES (1, 4, CURTIME(), CURTIME() );

INSERT INTO likes (user_id, image_id, created_at, update_at) VALUES (2, 4, CURTIME(), CURTIME() );

INSERT INTO likes (user_id, image_id, created_at, update_at) VALUES (3, 1, CURTIME(), CURTIME() );

INSERT INTO likes (user_id, image_id, created_at, update_at) VALUES (3, 2, CURTIME(), CURTIME() );

INSERT INTO likes (user_id, image_id, created_at, update_at) VALUES (2, 1, CURTIME(), CURTIME() );