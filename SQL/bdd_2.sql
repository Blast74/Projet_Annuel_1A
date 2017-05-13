#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: ARTICLES
#------------------------------------------------------------

CREATE TABLE ARTICLES(
        article_id      int (11) Auto_increment  NOT NULL PRIMARY KEY ,
        article_author  Int ,
        article_title   Varchar (60) NOT NULL ,
        article_content Text NOT NULL ,
        article_image   Varchar (150) NOT NULL ,
        article_subject Char (3) NOT NULL ,
        upLoadDate      Char (25) ,
        user_id         Int NOT NULL
);


#------------------------------------------------------------
# Table: MUSIC
#------------------------------------------------------------

CREATE TABLE MUSIC(
        music_id       int (11) Auto_increment  NOT NULL PRIMARY KEY ,
        music_name     Varchar (100) NOT NULL ,
        author_comment Text ,
        lyrics         Text ,
        music_image    Text ,
        note_music     Int ,
        isDeleted      Bool NOT NULL ,
        webradio       Bool NOT NULL ,
        dateupload     Date ,
        upload_user    Int ,
        upload_music   Int ,
        visibility     Bool NOT NULL ,
        upload_date    Date ,
        user_id        Int NOT NULL
);


#------------------------------------------------------------
# Table: MUSIC_SUBTYPE
#------------------------------------------------------------

CREATE TABLE MUSIC_SUBTYPE(
        subtype_ref  int (11) Auto_increment  NOT NULL PRIMARY KEY ,
        subtype_type Varchar (25) ,
        subtype_name Varchar (60)
);


#------------------------------------------------------------
# Table: USERS
#------------------------------------------------------------

CREATE TABLE USERS(
        user_id        int (11) Auto_increment  NOT NULL PRIMARY KEY ,
        email          Varchar (60) NOT NULL ,
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
        active_account TinyINT
);


#------------------------------------------------------------
# Table: TROPHY
#------------------------------------------------------------

CREATE TABLE TROPHY(
        trophy_ref         int (11) Auto_increment  NOT NULL PRIMARY KEY ,
        trophy_name        Varchar (150) NOT NULL ,
        trophy_image       Text NOT NULL ,
        trophy_description Varchar (255) ,
        trophy_points      Int NOT NULL ,
        user_id            Int NOT NULL
);


#------------------------------------------------------------
# Table: LINKED
#------------------------------------------------------------

CREATE TABLE LINKED(
        music_id    Int NOT NULL ,
        subtype_ref Int NOT NULL ,
        PRIMARY KEY (music_id ,subtype_ref )
);


#------------------------------------------------------------
# Table: VISIT
#------------------------------------------------------------

CREATE TABLE VISIT(
        visit_music Int NOT NULL ,
        visit_user  Int ,
        visit_date  Date ,
        music_id    Int NOT NULL ,
        user_id     Int NOT NULL ,
        PRIMARY KEY (music_id ,user_id )
);


#------------------------------------------------------------
# Table: FOLLOW
#------------------------------------------------------------

CREATE TABLE FOLLOW(
        user_account     Int ,
        follower_account Int NOT NULL ,
        user_id          Int NOT NULL ,
        user_id_USERS    Int NOT NULL ,
        PRIMARY KEY (user_id ,user_id_USERS )
);


#------------------------------------------------------------
# Table: OPINION
#------------------------------------------------------------

CREATE TABLE OPINION(
        opinion_user    Int NOT NULL ,
        opinion_music   Int ,
        mark            Int ,
        commentary      Varchar (255) ,
        commentary_date Date NOT NULL ,
        user_id         Int NOT NULL ,
        music_id        Int NOT NULL ,
        PRIMARY KEY (user_id ,music_id )
);


#------------------------------------------------------------
# Table: PREFERENCE_SUBTYPE
#------------------------------------------------------------

CREATE TABLE PREFERENCE_SUBTYPE(
        pref_subtype_user Int NOT NULL ,
        pref_subtype      Char (6) NOT NULL ,
        subtype_ref       Int NOT NULL ,
        user_id           Int NOT NULL ,
        PRIMARY KEY (subtype_ref ,user_id )
);

ALTER TABLE ARTICLES ADD CONSTRAINT FK_ARTICLES_user_id FOREIGN KEY (user_id) REFERENCES USERS(user_id);
ALTER TABLE MUSIC ADD CONSTRAINT FK_MUSIC_user_id FOREIGN KEY (user_id) REFERENCES USERS(user_id);
ALTER TABLE TROPHY ADD CONSTRAINT FK_TROPHY_user_id FOREIGN KEY (user_id) REFERENCES USERS(user_id);
ALTER TABLE LINKED ADD CONSTRAINT FK_LINKED_music_id FOREIGN KEY (music_id) REFERENCES MUSIC(music_id);
ALTER TABLE LINKED ADD CONSTRAINT FK_LINKED_subtype_ref FOREIGN KEY (subtype_ref) REFERENCES MUSIC_SUBTYPE(subtype_ref);
ALTER TABLE VISIT ADD CONSTRAINT FK_VISIT_music_id FOREIGN KEY (music_id) REFERENCES MUSIC(music_id);
ALTER TABLE VISIT ADD CONSTRAINT FK_VISIT_user_id FOREIGN KEY (user_id) REFERENCES USERS(user_id);
ALTER TABLE FOLLOW ADD CONSTRAINT FK_FOLLOW_user_id FOREIGN KEY (user_id) REFERENCES USERS(user_id);
ALTER TABLE FOLLOW ADD CONSTRAINT FK_FOLLOW_user_id_USERS FOREIGN KEY (user_id_USERS) REFERENCES USERS(user_id);
ALTER TABLE OPINION ADD CONSTRAINT FK_OPINION_user_id FOREIGN KEY (user_id) REFERENCES USERS(user_id);
ALTER TABLE OPINION ADD CONSTRAINT FK_OPINION_music_id FOREIGN KEY (music_id) REFERENCES MUSIC(music_id);
ALTER TABLE PREFERENCE_SUBTYPE ADD CONSTRAINT FK_PREFERENCE_SUBTYPE_subtype_ref FOREIGN KEY (subtype_ref) REFERENCES MUSIC_SUBTYPE(subtype_ref);
ALTER TABLE PREFERENCE_SUBTYPE ADD CONSTRAINT FK_PREFERENCE_SUBTYPE_user_id FOREIGN KEY (user_id) REFERENCES USERS(user_id);
