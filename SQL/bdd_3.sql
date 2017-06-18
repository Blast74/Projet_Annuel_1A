

#        BDD Projet_Annuel_1A


# Table: ARTICLES ----> REFERENCE les articles du site (Non approuvé encore)


CREATE TABLE ARTICLES(
        article_id      int (11) Auto_increment  NOT NULL PRIMARY KEY ,
        article_author  Int ,
        article_title   Varchar (60) NOT NULL ,
        article_content Text NOT NULL ,
        article_image   Varchar (150) NOT NULL ,
        article_subject Char (3) NOT NULL ,
        upLoadDate      Char (25) ,
        email           Varchar (60) NOT NULL
);



# Table: MUSIC ---> reference les musiques uploader du site


CREATE TABLE MUSIC(
        music_id       int (11) Auto_increment  NOT NULL PRIMARY KEY ,
        music_name     Varchar (100) NOT NULL ,
        subtype_type   Varchar (25) ,
        subtype_name   Varchar (60),
        author_pseudo  Varchar (30) NOT NULL,
        author_comment Text ,
        lyrics         Text ,
        music_image    Text ,
        note_music     Int ,
        number_of_votes Int,
        isDeleted      TinyINT(1) NOT NULL DEFAULT 0,
        dateupload     Date ,
        report         TinyINT(1) NOT NULL DEFAULT 1,
        valid_report   TinyINT(1) NOT NULL DEFAULT 0,
        upload_date    Date ,
        email          Varchar (60) NOT NULL
);


# Table: USERS ---> contient les points attriués


CREATE TABLE USERS(
        id             BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        email          Varchar (60) NOT NULL UNIQUE KEY,        
        pseudo         Varchar (30) NOT NULL ,
        image          Text ,
        gender         Char (1) NOT NULL ,
        firstname      Varchar (30) NOT NULL ,
        lastname       Varchar (30) NOT NULL ,
        birthday       Date NOT NULL ,
        register_date  Date NOT NULL ,
        country        Char (2) NOT NULL ,
        pwd            Varchar (60) NOT NULL ,
        moderator      TinyINT NOT NULL DEFAULT 0,
        access_token   Varchar (60) ,
        update_date    Date ,
        connect_date   Date ,
        trophy_points  Int NOT NULL DEFAULT 0 ,
        active_account TinyINT,
        UNIQUE (pseudo)
);


# Table: VISIT


CREATE TABLE VISIT(
        visit_date  Date ,
        music_id    Int NOT NULL ,
        email       Varchar (60) NOT NULL,
        PRIMARY KEY (music_id ,email)
);



# Table: FOLLOW


CREATE TABLE FOLLOW(
        follow Int       DEFAULT 0,
        email            Varchar (60) NOT NULL,
        email_follower   Varchar (60) NOT NULL,
        PRIMARY KEY (email ,email_follower)
);

CREATE TABLE LINKED(
        email          Varchar (60) NOT NULL,
        music_id       Int NOT NULL ,
        is_LINKED       TinyINT NOT NULL DEFAULT 0,
        music_note     TinyINT, #yes or no //A voté ou pas
        PRIMARY KEY (email ,music_id)
);

# Table: OPINION


CREATE TABLE OPINION(
        mark            Int ,
        commentary      Varchar (255) ,
        commentary_date Date NOT NULL ,
        email           Varchar (60) NOT NULL,
        music_id        Int NOT NULL ,
        PRIMARY KEY (email ,music_id)
);


ALTER TABLE ARTICLES ADD CONSTRAINT FK_ARTICLES_email FOREIGN KEY (email) REFERENCES USERS(email);
ALTER TABLE MUSIC ADD CONSTRAINT FK_MUSIC_email FOREIGN KEY (email) REFERENCES USERS(email);
ALTER TABLE VISIT ADD CONSTRAINT FK_VISIT_music_id FOREIGN KEY (music_id) REFERENCES MUSIC(music_id);
ALTER TABLE VISIT ADD CONSTRAINT FK_VISIT_email FOREIGN KEY (email) REFERENCES USERS(email);
ALTER TABLE FOLLOW ADD CONSTRAINT FK_FOLLOW_email FOREIGN KEY (email) REFERENCES USERS(email);
ALTER TABLE FOLLOW ADD CONSTRAINT FK_FOLLOW_email_follower FOREIGN KEY (email_follower) REFERENCES USERS(email);
ALTER TABLE OPINION ADD CONSTRAINT FK_OPINION_email FOREIGN KEY (email) REFERENCES USERS(email);
ALTER TABLE OPINION ADD CONSTRAINT FK_OPINION_music_id FOREIGN KEY (music_id) REFERENCES MUSIC(music_id);
ALTER TABLE LINKED ADD CONSTRAINT FK_LINKED_email FOREIGN KEY (email) REFERENCES USERS(email);
ALTER TABLE LINKED ADD CONSTRAINT FK_LINKED_music_id FOREIGN KEY (music_id) REFERENCES MUSIC(music_id);


INSERT INTO `users`     ( `email`, `pseudo`, `image`, `gender`, `firstname`, `lastname`, `birthday`, `register_date`, `country`, `pwd`, `moderator`, `access_token`, `update_date`, `active_account`) VALUES
                        ('venzo.terence@gmail.com', 'terence74', NULL, 'm', 'Terence', 'Venzo', '1991-03-01', '1991-03-01', 'fr', '$2y$10$pVPoizfLjqBUFAwlhJCSmebwSZBHF2sZKv2ctB2w7K1JWOLakggNe', 3, NULL, NULL, 1),
                        ('venzo.terence@hotmail.fr', 'salut74', NULL, 'm', 'Terence', 'Venzo', '1994-12-11', '1994-12-11', 'fr', '$2y$10$cmgfyXfUme3/RpFtxmLktuP/N.3ASk8ULDOC3hAifew/x7q8mAUxy', 1, NULL, NULL, 1),
                        ('venzo.terence@free.fr', 'terence74960', NULL, 'm', 'Terence', 'Venzo', '1994-12-12', '1994-12-12', 'fr', '$2y$10$ttsclwCYEcb50TX7SQ.mfevgbQSlzr6i5l7DS6Yt2AsCJHsjlwzdC', 1, NULL, NULL, 1),
                        ('terence74@gmail.com', 'Terence75012', NULL, 'm', 'Terence', 'Venzo', '1994-06-30', '1994-06-30', 'fr', '$2y$10$uSkCzaJTfvTIDnLy.aEHlO3M4Zr7dZKgOZ1DE3itcKBOwGREgGgdi', 2, NULL, NULL, 1),
                        ('zrfzrfz@efzefe.fr', 'efzfzrfzr', NULL, 'm', 'czefzrfzf', 'zfzerfz', '1994-09-08', '1994-09-08', 'fr', '$2y$10$cNdhV7gCy.49llC/qVLis.AEZofYBzODguMgWKx9Y6lxt0y6fzm72', 2, NULL, NULL, 1),
                        ('iozejfioze@zehfhiozejfo.ffr', 'iozefzeiof', NULL, 'm', 'efuzoeufhoefh', 'ehfiohozefo', '1994-06-21', '1994-06-21', 'fr', '$2y$10$a5kLxzAiybm22l.WUx0i7uXHYOfkjQ6i0Gav367kQl.Da3Rah.h8e', 2, NULL, NULL, 1),
                        ('izejfioejff@eufhiqehoe.fr', 'lejfzpoefk', NULL, 'm', 'ukzefuizefize', 'iefjziofjipoe', '1993-06-18', '1993-06-18', 'fr', '$2y$10$GcQp9/WuE7Uvn9cO4TT9pOXkUzwgxPxfHUeqAUYF7n201bVkatnQC', 1, NULL, NULL, 1),
                        ('moqejfepojkfpq@efqlefjpod.com', 'ioqejfqopjoejjf', NULL, 'm', 'zefiozhofir', 'pcdkspkvzef', '1996-08-15', '1996-08-15', 'fr', '$2y$10$GJZqZDGiOxFHwPDB3YrWg.xK59BNFp8jo.FtiKPc3W82Vs5a89K82', 1, NULL, NULL, 1),
                        ('dhdjfckzjuk@djzuejsiz.fr', 'usqhlfezuehp', NULL, 'm', 'iqfheuhqzhf', 'cieofnomzeif', '1988-03-08', '1988-03-08', 'fr', '$2y$10$2J2DgxvqSz0fsyipiFdTMuwqSfAN2m34uJRyStxjFCuqAq7uo4YNi', 1, NULL, NULL, 1);
