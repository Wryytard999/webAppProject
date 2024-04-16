/*==============================================================*/
/* Nom de SGBD :  MySQL_sgbd_web project                        */
/* Date de cr�ation :  15/04/2024 21:36:13                     */
/*==============================================================*/


drop table if exists ASSISTER;

drop table if exists ENCADREMENT;

drop table if exists FILLIERE;

drop table if exists JURY;

drop table if exists NIVEAU;

drop table if exists PARTICIPER;

drop table if exists PROFESSEUR;

drop table if exists RESPONSABLE;

drop table if exists VISITE;

/*==============================================================*/
/* Table : ASSISTER                                             */
/*==============================================================*/
create table ASSISTER
(
   ID_PROFESSEUR        bigint not null,
   ID_VISITE            bigint not null,
   primary key (ID_PROFESSEUR, ID_VISITE)
);

/*==============================================================*/
/* Table : ENCADREMENT                                          */
/*==============================================================*/
create table ENCADREMENT
(
   ID_ENCADREMENT       bigint not null AUTO_INCREMENT,
   ID_PROFESSEUR        bigint not null,
   ID_NIVEAU            bigint not null,
   ETUDIANT             varchar(50),
   DATE                 date,
   NOTE                 text,
   primary key (ID_ENCADREMENT)
);


/*==============================================================*/
/* Table : FILLIERE                                             */
/*==============================================================*/
create table FILLIERE
(
   ID_FILLIERE          bigint not null AUTO_INCREMENT,
   ID_RESPONSABLE       bigint not null,
   LBL_FILLIERE         varchar(50),
   NBR_NIVEAU           int,
   primary key (ID_FILLIERE)
);


/*==============================================================*/
/* Table : JURY                                                 */
/*==============================================================*/
create table JURY
(
   ID_JURY              bigint not null AUTO_INCREMENT,
   ID_NIVEAU            bigint not null,
   ID_RESPONSABLE       bigint not null,
   DATE_DEBUT           datetime,
   DATE_FIN             datetime,
   NOTE                 text,
   TYPE_DE_JURY         varchar(20),
   primary key (ID_JURY)
);

/*==============================================================*/
/* Table : NIVEAU                                               */
/*==============================================================*/
create table NIVEAU
(
   ID_NIVEAU            bigint not null AUTO_INCREMENT,
   ID_FILLIERE          bigint not null,
   LBL_NIVEAUX          varchar(10),
   primary key (ID_NIVEAU)
);

/*==============================================================*/
/* Table : PARTICIPER                                           */
/*==============================================================*/
create table PARTICIPER
(
   ID_PROFESSEUR        bigint not null,
   ID_JURY              bigint not null,
   primary key (ID_PROFESSEUR, ID_JURY)
);

/*==============================================================*/
/* Table : PROFESSEUR                                           */
/*==============================================================*/
create table PROFESSEUR
(
   ID_PROFESSEUR        bigint not null AUTO_INCREMENT,
   CODE_APOGE           varchar(20),
   PRENOM               varchar(50),
   NOM                  varchar(50),
   CONTACT              varchar(15),
   EMAIL_EDU            varchar(50),
   EMAIL_PERS           varchar(50),
   primary key (ID_PROFESSEUR)
);

/*==============================================================*/
/* Table : RESPONSABLE                                          */
/*==============================================================*/
create table RESPONSABLE
(
   ID_PROFESSEUR        bigint not null,
   ID_RESPONSABLE       bigint not null AUTO_INCREMENT,
   LBL_RESPO            varchar(20),
   primary key (ID_RESPONSABLE)
);


/*==============================================================*/
/* Table : VISITE                                               */
/*==============================================================*/
create table VISITE
(
   ID_VISITE            bigint not null,
   ID_NIVEAU            bigint not null,
   ID_RESPONSABLE       bigint not null,
   LIEU                 varchar(50),
   DATE_DEBUT           datetime,
   DATE_FIN             datetime,
   NOTE                 text,
   primary key (ID_VISITE)
);


alter table ASSISTER add constraint FK_ASSISTER foreign key (ID_PROFESSEUR)
      references PROFESSEUR (ID_PROFESSEUR) on delete CASCADE on update CASCADE;

alter table ASSISTER add constraint FK_ASSISTER2 foreign key (ID_VISITE)
      references VISITE (ID_VISITE) on delete CASCADE on update CASCADE;

alter table ENCADREMENT add constraint FK_APPLIQUER foreign key (ID_NIVEAU)
      references NIVEAU (ID_NIVEAU) on delete CASCADE on update CASCADE;

alter table ENCADREMENT add constraint FK_ENCADRER foreign key (ID_PROFESSEUR)
      references PROFESSEUR (ID_PROFESSEUR) on delete CASCADE on update CASCADE;

alter table FILLIERE add constraint FK_CONTROLLE foreign key (ID_RESPONSABLE)
      references RESPONSABLE (ID_RESPONSABLE) on delete CASCADE on update CASCADE;

alter table JURY add constraint FK_CONCERNE foreign key (ID_NIVEAU)
      references NIVEAU (ID_NIVEAU) on delete CASCADE on update CASCADE;

alter table JURY add constraint FK_GERER foreign key (ID_RESPONSABLE)
      references RESPONSABLE (ID_RESPONSABLE) on delete CASCADE on update CASCADE;

alter table NIVEAU add constraint FK_INCLUS foreign key (ID_FILLIERE)
      references FILLIERE (ID_FILLIERE) on delete CASCADE on update CASCADE;

alter table PARTICIPER add constraint FK_PARTICIPER foreign key (ID_PROFESSEUR)
      references PROFESSEUR (ID_PROFESSEUR) on delete CASCADE on update CASCADE;

alter table PARTICIPER add constraint FK_PARTICIPER2 foreign key (ID_JURY)
      references JURY (ID_JURY) on delete CASCADE on update CASCADE;

alter table RESPONSABLE add constraint FK_HERITAGE_1 foreign key (ID_PROFESSEUR)
      references PROFESSEUR (ID_PROFESSEUR) on delete CASCADE on update CASCADE;

alter table VISITE add constraint FK_APPARTIENT foreign key (ID_NIVEAU)
      references NIVEAU (ID_NIVEAU) on delete CASCADE on update CASCADE;

alter table VISITE add constraint FK_CHAPERONNER foreign key (ID_RESPONSABLE)
      references RESPONSABLE (ID_RESPONSABLE) on delete CASCADE on update CASCADE;

