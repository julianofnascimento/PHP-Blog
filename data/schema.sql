CREATE TABLE post ( id INTEGER PRIMARY KEY AUTOINCREMENT, title varchar(100) NOT NULL, content TEXT NOT NULL);
insert into post(title, content) values('Post 1', 'Content 1');
insert into post(title, content) values('Post 2', 'Content 2');
insert into post(title, content) values('Post 3', 'Content 3');
insert into post(title, content) values('Post 4', 'Content 4');

CREATE TABLE comments
(
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    content TEXT NOT NULL,
    post_id INTEGER NOT NULL
);

INSERT INTO comments(content, post_id) VALUES('comentario 1', 1);
INSERT INTO comments(content, post_id) VALUES('comentario 2', 1);
INSERT INTO comments(content, post_id) VALUES('comentario 3', 2);
INSERT INTO comments(content, post_id) VALUES('comentario 4', 2);

CREATE TABLE users
(
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(60),
    full_name VARCHAR(150) NOT NULL
);

INSERT INTO users(username, password, full_name)
            values('juliano@gmail.com', '$2y$10$SmBSsF8poKzWWjEXbthVFugzLJsVmLWPzavcHHb3NkkCVJNE0uzIK', 'Juliano Ferreira');