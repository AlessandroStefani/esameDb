-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Wed Aug 23 11:26:10 2023 
-- * LUN file: C:\Users\sando\Desktop\Esame DB\ESAMEDB.lun 
-- * Schema: COMPLETO/1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database progDB;
use progDB;


-- Tables Section
-- _____________ 

create table AEROPORTO (
     codiceAeroporto varchar(255) not null,
     nome varchar(255) not null,
     localita varchar(255) not null,
     constraint ID_AEROPORTO_ID primary key (codiceAeroporto));

create table BIGLIETTO (
     codiceBiglietto int not null AUTO_INCREMENT,
     codiceVolo int not null,
     codiceFiscale varchar(255) not null,
     prezzo varchar(255) not null,
     constraint ID_BIGLIETTO_ID primary key (codiceBiglietto),
     constraint SID_BIGLIETTO_1_ID unique (codiceFiscale, codiceBiglietto),
     constraint SID_BIGLIETTO_ID unique (codiceVolo, codiceBiglietto));

create table CLIENTE (
     nome varchar(255) not null,
     cognome varchar(255) not null,
     dataNascita varchar(255) not null,
     codiceFiscale varchar(255) not null,
     telefono varchar(255) not null,
     constraint ID_CLIENTE_ID primary key (codiceFiscale));

create table CONTROLLO (
     idVelivolo varchar(255) not null,
     codiceControllo varchar(255) not null,
     specifiche varchar(255) not null,
     durata varchar(255) not null,
     dataInizio DATE not null,
     dataFine DATE not null,
     note varchar(65535),
     constraint ID_CONTROLLO_ID primary key (idVelivolo, codiceControllo));

create table effettua (
     codiceVolo int not null,
     codicePersonale varchar(255) not null,
     constraint ID_effettua_ID primary key (codicePersonale, codiceVolo));

create table PERSONALE (
     codicePersonale varchar(255) not null,
     ruolo varchar(255) not null,
     nome varchar(255) not null,
     cognome varchar(255) not null,
     dataNascita DATE not null,
     codiceFiscale varchar(255) not null,
     telefono varchar(255) not null,
     dataAssunzione DATE not null,
     stato varchar(255) not null,
     oreAccumulate varchar(255) not null,
     oreDiVolo varchar(255),
     constraint SID_PERSONALE_ID unique (codiceFiscale),
     constraint ID_PERSONALE_ID primary key (codicePersonale));

create table RIPOSO (
     codicePersonale varchar(255) not null,
     data DATE not null,
     ora TIME not null,
     constraint ID_RIPOSO_ID primary key (codicePersonale, data, ora));

create table scalo (
     codiceAeroporto varchar(255) not null,
     codiceVolo int not null,
     constraint ID_scalo_ID primary key (codiceAeroporto, codiceVolo));

create table VELIVOLO (
     idVelivolo varchar(255) not null,
     modello varchar(255) not null,
     posti varchar(255) not null,
     oreDiVolo varchar(255) not null,
     eta varchar(255) not null,
     dataAcquisizione DATE not null,
     stato varchar(255) not null,
     constraint ID_VELIVOLO_ID primary key (idVelivolo));

create table VOLO (
     codiceVolo int not null AUTO_INCREMENT,
     durata varchar(255) not null,
     data DATE not null,
     ora TIME not null,
     idVelivolo varchar(255) not null,
     codiceAeroportoOrigine varchar(255) not null,
     codiceAeroportoDest varchar(255) not null,
     constraint ID_VOLO_ID primary key (codiceVolo),
     constraint SID_VOLO_ID unique (idVelivolo, data, ora));


-- Constraints Section
-- ___________________ 

alter table BIGLIETTO add constraint FKpasseggero
     foreign key (codiceVolo)
     references VOLO (codiceVolo);

alter table BIGLIETTO add constraint FKacquisto
     foreign key (codiceFiscale)
     references CLIENTE (codiceFiscale);

alter table CONTROLLO add constraint FKmanutenzione
     foreign key (idVelivolo)
     references VELIVOLO (idVelivolo);

alter table effettua add constraint FKpilota
     foreign key (codicePersonale)
     references PERSONALE (codicePersonale);

alter table effettua add constraint FKeff_VOL_FK
     foreign key (codiceVolo)
     references VOLO (codiceVolo);

alter table RIPOSO add constraint FKcompie
     foreign key (codicePersonale)
     references PERSONALE (codicePersonale);

alter table scalo add constraint FKsca_AER
     foreign key (codiceAeroporto)
     references AEROPORTO (codiceAeroporto);

alter table scalo add constraint FKsca_VOL_FK
     foreign key (codiceVolo)
     references VOLO (codiceVolo);

-- Not implemented
-- alter table VOLO add constraint ID_VOLO_CHK
--     check(exists(select * from effettua
--                  where effettua.codiceVolo = codiceVolo)); 

alter table VOLO add constraint FKorigine_FK
     foreign key (codiceAeroportoOrigine)
     references AEROPORTO (codiceAeroporto);

alter table VOLO add constraint FKmezzo
     foreign key (idVelivolo)
     references VELIVOLO (idVelivolo);

alter table VOLO add constraint FKdestinazione_FK
     foreign key (codiceAeroportoDest)
     references AEROPORTO (codiceAeroporto);


-- Index Section
-- _____________ 

create unique index ID_AEROPORTO_IND
     on AEROPORTO (codiceAeroporto);

create unique index ID_BIGLIETTO_IND
     on BIGLIETTO (codiceBiglietto);

create unique index SID_BIGLIETTO_1_IND
     on BIGLIETTO (codiceFiscale, codiceBiglietto);

create unique index SID_BIGLIETTO_IND
     on BIGLIETTO (codiceVolo, codiceBiglietto);

create unique index ID_CLIENTE_IND
     on CLIENTE (codiceFiscale);

create unique index ID_CONTROLLO_IND
     on CONTROLLO (idVelivolo, codiceControllo);

create unique index ID_effettua_IND
     on effettua (codicePersonale, codiceVolo);

create index FKeff_VOL_IND
     on effettua (codiceVolo);

create unique index SID_PERSONALE_IND
     on PERSONALE (codiceFiscale);

create unique index ID_PERSONALE_IND
     on PERSONALE (codicePersonale);

create unique index ID_RIPOSO_IND
     on RIPOSO (codicePersonale, data, ora);

create unique index ID_scalo_IND
     on scalo (codiceAeroporto, codiceVolo);

create index FKsca_VOL_IND
     on scalo (codiceVolo);

create unique index ID_VELIVOLO_IND
     on VELIVOLO (idVelivolo);

create unique index ID_VOLO_IND
     on VOLO (codiceVolo);

create unique index SID_VOLO_IND
     on VOLO (idVelivolo, data, ora);

create index FKorigine_IND
     on VOLO (codiceAeroportoOrigine);

create index FKdestinazione_IND
     on VOLO (codiceAeroportoDest);


