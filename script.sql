#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: modele
#------------------------------------------------------------

CREATE TABLE modele(
        libelle       Varchar (50) NOT NULL ,
        nom_fichier   Varchar (50) ,
        nom_table     Varchar (50) ,
        date_creation Date NOT NULL
    ,CONSTRAINT modele_PK PRIMARY KEY (libelle)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type_champ
#------------------------------------------------------------

CREATE TABLE type_champ(
        type_champ Varchar (1024) NOT NULL ,
        actif      Bool NOT NULL
    ,CONSTRAINT type_champ_PK PRIMARY KEY (type_champ)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: champ
#------------------------------------------------------------

CREATE TABLE champ(
        id           Int  Auto_increment  NOT NULL ,
        nom_champ    Varchar (50) NOT NULL ,
        longueur     Double ,
        val_min_nb   Double ,
        val_max_nb   Double ,
        val_min_date Date ,
        val_max_date Date ,
        liste_txt    Varchar (1024) ,
        fichier      Varchar (1024)  ,
        libelle      Varchar (50) NOT NULL ,
        type_champ   Varchar (1024) NOT NULL
    ,CONSTRAINT champ_PK PRIMARY KEY (id)

    ,CONSTRAINT champ_modele_FK FOREIGN KEY (libelle) REFERENCES modele(libelle)
    ,CONSTRAINT champ_type_champ0_FK FOREIGN KEY (type_champ) REFERENCES type_champ(type_champ)
)ENGINE=InnoDB;
#------------------------------------------------------------
# Populate database
#------------------------------------------------------------



INSERT type_champ
VALUE ("INT",TRUE)
, ("VARCHAR",TRUE)
, ("CHAR",TRUE)
, ("TINYINT",TRUE)
, ("DOUBLE",TRUE)
, ("DATE",TRUE)
,("TIME",TRUE)
, ("DATETIME",TRUE)
, ("BOOLEAN",TRUE);
