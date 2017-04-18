CREATE TABLE USERS (
	user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR (60) NOT NULL,
	pseudo VARCHAR (30) NOT NULL,
	image VARCHAR (150), #URL
	gender CHAR (1) NOT NULL,
	firstname VARCHAR (30) NOT NULL,
	lastname VARCHAR (30) NOT NULL,
	birthday DATE NOT NULL,
	register_date DATE NOT NULL,
	country CHAR (2) NOT NULL,
	pwd VARCHAR (60) NOT NULL, 
	moderator TINYINT NOT NULL, 
	preferences INTEGER,
	access_token VARCHAR (60),
	update_date DATE,
	active_account TINYINT
);

CREATE TABLE FOLLOWER (
	user_account VARCHAR (60)REFERENCES USERS (email),
	follower_account VARCHAR (60)REFERENCES USERS (email),
	PRIMARY KEY (user_account, follower_account)
);	

CREATE TABLE MUSIC_TYPE (
	type_ref CHAR (3) PRIMARY KEY,
	type_name VARCHAR (60)
	
);

CREATE TABLE ARTICLE (
	article_id INTEGER PRIMARY KEY,
	article_author VARCHAR (60) REFERENCES USERS (email),
	article_title VARCHAR (60) NOT NULL,
	article_content TEXT NOT NULL,
	article_image VARCHAR (150)NOT NULL,
	article_subject CHAR (3) NOT NULL
);

CREATE TABLE MUSIC (
	music_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	music_name VARCHAR (80)NOT NULL, 
	author_comment TEXT, 
	lyrics TEXT,  
	music_image VARCHAR (150), #url
	music_type CHAR (3) REFERENCES MUSIC_TYPE (type_ref)	
);

CREATE TABLE VISIT (
	visit_user INTEGER REFERENCES USERS (user_id), 
	visit_music INTEGER REFERENCES MUSIC (music_id),
	visit_date DATE	 NOT NULL,
	PRIMARY KEY (visit_user, visit_music)
);
CREATE TABLE UPLOAD (
	upload_user INTEGER REFERENCES USERS (user_id), 
	upload_music INTEGER REFERENCES MUSIC (music_id),
	visibility BOOLEAN,
	webradio BOOLEAN, 
	upload_date DATE NOT NULL,
	PRIMARY KEY (upload_user, upload_music)
);

CREATE TABLE OPINION (
	opinion_user INTEGER REFERENCES USERS (user_id),
	opinion_music INTEGER REFERENCES MUSIC (music_id),
	mark INTEGER,
	commentary VARCHAR (255),
	PRIMARY KEY (opinion_user, opinion_music)
);

