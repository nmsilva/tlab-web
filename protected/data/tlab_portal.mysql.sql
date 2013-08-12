drop DATABASE if exists tlab_portal;
create database tlab_portal;
use tlab_portal;

drop table if exists COMPARTIMENTOS;

drop table if exists ENTIDADES;

drop table if exists EQUIPAMENTOS;

drop table if exists ERROS;

drop table if exists INSTITUICOES;

drop table if exists METRICAS;

drop table if exists METRICAS_INSTANT;

drop table if exists SENSORES;

drop table if exists TIPOS_UTILIZADOR;

drop table if exists UNIDADES;

drop table if exists UTILIZADORES;

/*==============================================================*/
/* Table: COMPARTIMENTOS                                        */
/*==============================================================*/
create table COMPARTIMENTOS
(
   ID_COMP              int not null auto_increment,
   ID_INST              int not null,
   IDENTIFICACAO        char(100) not null,
   primary key (ID_COMP)
);

/*==============================================================*/
/* Table: ENTIDADES                                             */
/*==============================================================*/
create table ENTIDADES
(
   ID_ENT               int not null auto_increment,
   API_KEY              char(50) not null,
   NOME                 char(200) not null,
   LOCALIDADE           char(50) not null,
   COD_POSTAL           char(10) not null,
   EMAIL                char(100) not null,
   RUA                  char(50) not null,
   NIF                  char(9) not null,
   TELEFONE             char(9),
   TELEMOVEL            char(9),
   DATA_REGISTO         timestamp,
   ATIVO                bool,
   LOGO                 char(200),
   primary key (ID_ENT)
);

/*==============================================================*/
/* Table: EQUIPAMENTOS                                          */
/*==============================================================*/
create table EQUIPAMENTOS
(
   ID_EQUIP             int not null auto_increment,
   ID_COMP              int not null,
   IDENTIFICACAO        char(100),
   primary key (ID_EQUIP)
);

/*==============================================================*/
/* Table: ERROS                                                 */
/*==============================================================*/
create table ERROS
(
   ID_ERRO              int not null auto_increment,
   ID_SENSOR            int not null,
   TIPO                 char(5),
   DATA                 timestamp not null,
   IDENTIFICACAO        char(150),
   DESCRICAO            char(200),
   VISTO                bool,
   DATA_VISUALIZACAO    datetime,
   primary key (ID_ERRO)
);

/*==============================================================*/
/* Table: INSTITUICOES                                          */
/*==============================================================*/
create table INSTITUICOES
(
   ID_INST              int not null auto_increment,
   ID_ENT               int not null,
   IDENTIFICACAO        char(100) not null,
   primary key (ID_INST)
);

/*==============================================================*/
/* Table: METRICAS                                              */
/*==============================================================*/
create table METRICAS
(
   ID_METRICA           int not null auto_increment,
   ID_SENSOR            int not null,
   DATA_REGISTO         timestamp not null,
   VMEDIO               decimal(8,2) not null,
   VMAX                 decimal(8,2),
   VMIN                 decimal(8,2),
   primary key (ID_METRICA)
);

/*==============================================================*/
/* Table: METRICAS_INSTANT                                      */
/*==============================================================*/
create table METRICAS_INSTANT
(
   ID_INST_METR         int not null auto_increment,
   ID_SENSOR            int not null,
   DATA_REGISTO         timestamp,
   VALOR                decimal(8,2),
   primary key (ID_INST_METR)
);

/*==============================================================*/
/* Table: SENSORES                                              */
/*==============================================================*/
create table SENSORES
(
   ID_SENSOR            int not null auto_increment,
   ID_USER              int,
   ID_COMP              int,
   ID_UNI               int not null,
   ID_EQUIP             int,
   IDENTIFICACAO        char(100) not null,
   VMAX                 decimal(8,2) not null,
   VMIN                 decimal(8,2) not null,
   ATIVO                bool,
   EMAIL_ERRO           char(150),
   EMAIL_AVISO          char(150),
   primary key (ID_SENSOR)
);

/*==============================================================*/
/* Table: TIPOS_UTILIZADOR                                      */
/*==============================================================*/
create table TIPOS_UTILIZADOR
(
   ID_TIPO              int not null auto_increment,
   IDENTIFICACAO        char(100) not null,
   primary key (ID_TIPO)
);

/*==============================================================*/
/* Table: UNIDADES                                              */
/*==============================================================*/
create table UNIDADES
(
   ID_UNI               int not null auto_increment,
   IDENTIFICACAO        char(100) not null,
   TVALOR               char(50),
   primary key (ID_UNI)
);

/*==============================================================*/
/* Table: UTILIZADORES                                          */
/*==============================================================*/
create table UTILIZADORES
(
   ID_USER              int not null auto_increment,
   ID_ENT               int,
   ID_TIPO              int not null,
   NOME                 char(150) not null,
   EMAIL                char(100) not null,
   PASSWORD             char(150) not null,
   SALT                 char(50) not null,
   CHAVE_RECUP          char(100),
   TELEFONE             char(9),
   TELEMOVEL            char(9),
   DATA_REGISTO         timestamp not null,
   DATA_ALTERACAO       timestamp not null,
   LINGUA               int,
   ATIVO                bool,
   IMAGEM               char(200),
   primary key (ID_USER)
);

alter table COMPARTIMENTOS add constraint FK_CONTEM foreign key (ID_INST)
      references INSTITUICOES (ID_INST) on delete restrict on update restrict;

alter table EQUIPAMENTOS add constraint FK_TEM foreign key (ID_COMP)
      references COMPARTIMENTOS (ID_COMP) on delete restrict on update restrict;

alter table ERROS add constraint FK_REGISTA foreign key (ID_SENSOR)
      references SENSORES (ID_SENSOR) on delete restrict on update restrict;

alter table INSTITUICOES add constraint FK_PERTENCE foreign key (ID_ENT)
      references ENTIDADES (ID_ENT) on delete restrict on update restrict;

alter table METRICAS add constraint FK_APRESENTA foreign key (ID_SENSOR)
      references SENSORES (ID_SENSOR) on delete restrict on update restrict;

alter table METRICAS_INSTANT add constraint FK_MOSTRA foreign key (ID_SENSOR)
      references SENSORES (ID_SENSOR) on delete restrict on update restrict;

alter table SENSORES add constraint FK_ENCONTRASE foreign key (ID_COMP)
      references COMPARTIMENTOS (ID_COMP) on delete restrict on update restrict;

alter table SENSORES add constraint FK_ESTA foreign key (ID_EQUIP)
      references EQUIPAMENTOS (ID_EQUIP) on delete restrict on update restrict;

alter table SENSORES add constraint FK_REPRESENTA foreign key (ID_UNI)
      references UNIDADES (ID_UNI) on delete restrict on update restrict;

alter table SENSORES add constraint FK_RESPONSAVEL foreign key (ID_USER)
      references UTILIZADORES (ID_USER) on delete restrict on update restrict;

alter table UTILIZADORES add constraint FK_REGISTAM foreign key (ID_ENT)
      references ENTIDADES (ID_ENT) on delete restrict on update restrict;

alter table UTILIZADORES add constraint FK_UTILIZA foreign key (ID_TIPO)
      references TIPOS_UTILIZADOR (ID_TIPO) on delete restrict on update restrict;

/*==============================================================*/
/* Insert Default Data                                   */
/*==============================================================*/

INSERT INTO `tipos_utilizador` (`ID_TIPO`, `IDENTIFICACAO`) VALUES
(1, 'Administração'),
(2, 'Técnicos'),
(3, 'Clientes');


INSERT INTO `utilizadores` (`ID_USER`, `ID_ENT`, `ID_TIPO`, `NOME`, `EMAIL`, `PASSWORD`, `SALT`, `CHAVE_RECUP`, `TELEFONE`, `TELEMOVEL`, `DATA_REGISTO`, `DATA_ALTERACAO`) VALUES ('1', NULL, '1', 'Administração', 'geral@tlab.pt', 'd4420172f6318dda1c1703253935c454b099847b6e2310c54272b0c4ac86d3ab8e386145b784c4dba00a27590b9a071c295503bbb7753558372e9a3edc411e39', 'fbr_aPtn7Nkh3fY6Bsgg249IHPGNTdt~', NULL, NULL, NULL, CURRENT_TIMESTAMP, '0000-00-00 00:00:00');