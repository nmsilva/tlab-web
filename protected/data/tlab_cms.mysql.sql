drop DATABASE if exists tlab_cms;
create database tlab_cms;
use tlab_cms;

/* Generated Script */

drop table if exists CATEGORIAS;

drop table if exists CATEGORIA_IDIOMA;

drop table if exists CAT_OBJETO;

drop table if exists IDIOMAS;

drop table if exists ITEM_MENU_IDIOMA;

drop table if exists MEDIAS;

drop table if exists MENUS;

drop table if exists MENU_ITEM;

drop table if exists OBJETOS;

drop table if exists OBJETO_IDIOMA;

drop table if exists OBJETO_MEDIA;

drop table if exists OPCOES_CMS;

/*==============================================================*/
/* Table: CATEGORIAS                                            */
/*==============================================================*/
create table CATEGORIAS
(
   ID_CAT               int not null auto_increment,
   SLUG                 char(255),
   ESTADO               bool,
   primary key (ID_CAT)
);

/*==============================================================*/
/* Table: CATEGORIA_IDIOMA                                      */
/*==============================================================*/
create table CATEGORIA_IDIOMA
(
   LANG_ID              int not null,
   ID_CAT               int not null,
   NOME                 char(255),
   TITULO               char(255),
   DESCRICAO            char(255),
   KEYWORDS             char(255),
   primary key (LANG_ID, ID_CAT)
);

/*==============================================================*/
/* Table: CAT_OBJETO                                            */
/*==============================================================*/
create table CAT_OBJETO
(
   OBJETO_ID            int not null,
   ID_CAT               int not null,
   primary key (OBJETO_ID, ID_CAT)
);

/*==============================================================*/
/* Table: IDIOMAS                                               */
/*==============================================================*/
create table IDIOMAS
(
   LANG_ID              int not null auto_increment,
   NOME                 char(255),
   DESCRI               char(255),
   ESTADO               bool,
   SHORT                char(50),
   REQUIRED             bool,
   BANDEIRA             char(50),
   primary key (LANG_ID)
);

/*==============================================================*/
/* Table: ITEM_MENU_IDIOMA                                      */
/*==============================================================*/
create table ITEM_MENU_IDIOMA
(
   LANG_ID              int not null,
   ID_MENU_ITEM         int not null,
   NOME                 char(255),
   DESCRICAO            char(255),
   primary key (LANG_ID, ID_MENU_ITEM)
);

/*==============================================================*/
/* Table: MEDIAS                                                */
/*==============================================================*/
create table MEDIAS
(
   ID_MEDIA             int not null auto_increment,
   NOME                 char(255),
   BODY                 text,
   PATH                 char(255),
   TYPE                 char(50),
   DATA_CRIACAO         timestamp,
   primary key (ID_MEDIA)
);

/*==============================================================*/
/* Table: MENUS                                                 */
/*==============================================================*/
create table MENUS
(
   ID_MENU              int not null auto_increment,
   NOME                 char(255),
   DATA_CRIACAO         timestamp,
   primary key (ID_MENU)
);

/*==============================================================*/
/* Table: MENU_ITEM                                             */
/*==============================================================*/
create table MENU_ITEM
(
   ID_MENU_ITEM         int not null auto_increment,
   MEN_ID_MENU_ITEM     int,
   ID_MENU              int,
   ID_CAT               int,
   TIPO                 char(100),
   VALOR                char(255),
   primary key (ID_MENU_ITEM)
);

/*==============================================================*/
/* Table: OBJETOS                                               */
/*==============================================================*/
create table OBJETOS
(
   OBJETO_ID            int not null auto_increment,
   DATA_CRIACAO         timestamp,
   ESTADO               bool,
   COMENTS              bool,
   TIPO                 char(100),
   primary key (OBJETO_ID)
);

/*==============================================================*/
/* Table: OBJETO_IDIOMA                                         */
/*==============================================================*/
create table OBJETO_IDIOMA
(
   OBJETO_ID            int not null,
   LANG_ID              int not null,
   CONTENT              text,
   TITULO               char(255),
   EXCERTO              char(255),
   KEYWORDS             char(255),
   primary key (OBJETO_ID, LANG_ID)
);

/*==============================================================*/
/* Table: OBJETO_MEDIA                                          */
/*==============================================================*/
create table OBJETO_MEDIA
(
   ID_MEDIA             int not null,
   OBJETO_ID            int not null,
   primary key (ID_MEDIA, OBJETO_ID)
);

/*==============================================================*/
/* Table: OPCOES_CMS                                            */
/*==============================================================*/
create table OPCOES_CMS
(
   ID_OPCAO             int not null auto_increment,
   KEY_OPCAO            char(255),
   VALUE_OPCAO          text,
   primary key (ID_OPCAO)
);

alter table CATEGORIA_IDIOMA add constraint FK_CATEGORIA_IDIOMA foreign key (LANG_ID)
      references IDIOMAS (LANG_ID) on delete restrict on update restrict;

alter table CATEGORIA_IDIOMA add constraint FK_CATEGORIA_IDIOMA2 foreign key (ID_CAT)
      references CATEGORIAS (ID_CAT) on delete restrict on update restrict;

alter table CAT_OBJETO add constraint FK_CAT_OBJETO foreign key (OBJETO_ID)
      references OBJETOS (OBJETO_ID) on delete restrict on update restrict;

alter table CAT_OBJETO add constraint FK_CAT_OBJETO2 foreign key (ID_CAT)
      references CATEGORIAS (ID_CAT) on delete restrict on update restrict;

alter table ITEM_MENU_IDIOMA add constraint FK_ITEM_MENU_IDIOMA foreign key (LANG_ID)
      references IDIOMAS (LANG_ID) on delete restrict on update restrict;

alter table ITEM_MENU_IDIOMA add constraint FK_ITEM_MENU_IDIOMA2 foreign key (ID_MENU_ITEM)
      references MENU_ITEM (ID_MENU_ITEM) on delete restrict on update restrict;

alter table MENU_ITEM add constraint FK_CATEGORIA_MENU_ITEM foreign key (ID_CAT)
      references CATEGORIAS (ID_CAT) on delete restrict on update restrict;

alter table MENU_ITEM add constraint FK_CONTEM2 foreign key (ID_MENU)
      references MENUS (ID_MENU) on delete restrict on update restrict;

alter table MENU_ITEM add constraint FK_PARENT foreign key (MEN_ID_MENU_ITEM)
      references MENU_ITEM (ID_MENU_ITEM) on delete restrict on update restrict;

alter table OBJETO_IDIOMA add constraint FK_OBJETO_IDIOMA foreign key (OBJETO_ID)
      references OBJETOS (OBJETO_ID) on delete restrict on update restrict;

alter table OBJETO_IDIOMA add constraint FK_OBJETO_IDIOMA2 foreign key (LANG_ID)
      references IDIOMAS (LANG_ID) on delete restrict on update restrict;

alter table OBJETO_MEDIA add constraint FK_OBJETO_MEDIA foreign key (ID_MEDIA)
      references MEDIAS (ID_MEDIA) on delete restrict on update restrict;

alter table OBJETO_MEDIA add constraint FK_OBJETO_MEDIA2 foreign key (OBJETO_ID)
      references OBJETOS (OBJETO_ID) on delete restrict on update restrict;

/*==============================================================*/
/* Insert Default Data                                   */
/*==============================================================*/

INSERT INTO `idiomas` (`LANG_ID`, `NOME`, `DESCRI`, `ESTADO`, `SHORT`, `REQUIRED`, `BANDEIRA`) VALUES
(1, 'Português', 'Português', 1, 'pt', 1, '_pt.png'),
(2, 'Inglês', 'Inglês', 1, 'en', 0, '_en.png'),
(3, 'Francês', 'Francês', 1, 'fr', 0, '_fr.png');

INSERT INTO `opcoes_cms` (`ID_OPCAO`, `KEY_OPCAO`, `VALUE_OPCAO`) VALUES (NULL, '_lang', '1'),(NULL, '_index', NULL);