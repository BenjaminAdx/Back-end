/* Script généré automatiquement par Katyusha MCD v0.4.6 pour mysql */


/* Table : User */

CREATE TABLE User (
    ID INTEGER PRIMARY KEY AUTO_INCREMENT, 
    username VARCHAR(250) NOT NULL, 
    password VARCHAR(250) NOT NULL, 
    email VARCHAR(250) NOT NULL, 
    avatar VARCHAR(250), 
    code INTEGER, 
    ID_Role INTEGER NOT NULL
) ;


/* Table : Article */

CREATE TABLE Article (
    ID INTEGER PRIMARY KEY AUTO_INCREMENT, 
    title VARCHAR(250) NOT NULL, 
    content VARCHAR(250) NOT NULL, 
    image VARCHAR(250), 
    date DATETIME NOT NULL, 
    auteur VARCHAR(250) NOT NULL, 
    ID_User INTEGER NOT NULL
) ;


/* Table : Role */

CREATE TABLE Role (
    ID INTEGER PRIMARY KEY AUTO_INCREMENT, 
    nom VARCHAR(250) NOT NULL
) ;


/* Table : Jaime */

CREATE TABLE Jaime (
    ID_User INTEGER, 
    ID_Article INTEGER, 
    PRIMARY KEY(ID_User, ID_Article)
) ;


/* Table : Favoris */

CREATE TABLE Favoris (
    ID_User INTEGER, 
    ID_Article INTEGER, 
    PRIMARY KEY(ID_User, ID_Article)
) ;


/* Table : Commentaires */

CREATE TABLE Commentaires (
    ID INTEGER AUTO_INCREMENT, 
    commentaire VARCHAR(250) NOT NULL, 
    ID_User INTEGER, 
    ID_Article INTEGER, 
    PRIMARY KEY(ID, ID_User, ID_Article)
) ;





ALTER TABLE Article ADD CONSTRAINT FK_User_ID_User_Article FOREIGN KEY (ID_User) REFERENCES User(ID) ;

ALTER TABLE User ADD CONSTRAINT FK_Role_ID_Role_User FOREIGN KEY (ID_Role) REFERENCES Role(ID) ;

ALTER TABLE Jaime ADD CONSTRAINT FK_User_ID_User_Jaime FOREIGN KEY (ID_User) REFERENCES User(ID) ;

ALTER TABLE Jaime ADD CONSTRAINT FK_Article_ID_Article_Jaime FOREIGN KEY (ID_Article) REFERENCES Article(ID) ;

ALTER TABLE Favoris ADD CONSTRAINT FK_User_ID_User_Favoris FOREIGN KEY (ID_User) REFERENCES User(ID) ;

ALTER TABLE Favoris ADD CONSTRAINT FK_Article_ID_Article_Favoris FOREIGN KEY (ID_Article) REFERENCES Article(ID) ;

ALTER TABLE Commentaires ADD CONSTRAINT FK_User_ID_User_Commentaires FOREIGN KEY (ID_User) REFERENCES User(ID) ;

ALTER TABLE Commentaires ADD CONSTRAINT FK_Article_ID_Article_Commentaires FOREIGN KEY (ID_Article) REFERENCES Article(ID) ;


