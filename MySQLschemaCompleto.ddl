-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Aug 11 11:49:01 2023 
-- * LUN file: C:\Users\sando\OneDrive\Desktop\EsameDB\ESAMEDB.lun 
-- * Schema: COMPLETO/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database COMPLETO;
use COMPLETO;


-- Tables Section
-- _____________ 

create table AEROPORTO (
     codice aeroporto char(1) not null,
     nome char(1) not null,
     località char(1) not null,
     constraint IDAEROPORTO primary key (codice aeroporto));

create table ASSISTENTE DI VOLO (
     id assistente char(1) not null,
     constraint IDASSISTENTE DI VOLO primary key (id assistente));

create table BIGLIETTO (
     codice biglietto char(1) not null,
     prezzo char(1) not null,
     constraint IDBIGLIETTO_1 unique (, codice biglietto),
     constraint IDBIGLIETTO_2 unique (, codice biglietto),
     constraint IDBIGLIETTO primary key (codice biglietto));

create table CLIENTE (
);

create table CONTROLLO (
     codice controllo char(1) not null,
     specifiche char(1) not null,
     durata char(1) not null,
     data inizio char(1) not null,
     data fine char(1) not null,
     note char(1),
     constraint IDCONTROLLO primary key (, codice controllo));

create table PERSONA (
     nome char(1) not null,
     cognome char(1) not null,
     data di nascita char(1) not null,
     codice fiscale char(1) not null,
     telefono char(1) not null,
     constraint IDPERSONA primary key (codice fiscale));

create table PERSONALE (
     data assunzione char(1) not null,
     stato char(1) not null,
     ore accumulate char(1) not null);

create table PILOTA (
     id pilota char(1) not null,
     ore di volo char(1) not null,
     constraint IDPILOTA primary key (id pilota));

create table RIPOSO (
     data char(1) not null,
     ora char(1) not null,
     constraint IDRIPOSO primary key (, data, ora));

create table VELIVOLO (
     id velivolo char(1) not null,
     modello char(1) not null,
     posti char(1) not null,
     ore di volo char(1) not null,
     età char(1) not null,
     data acquisizione char(1) not null,
     stato char(1) not null,
     constraint IDVELIVOLO primary key (id velivolo));

create table VOLO (
     codice volo char(1) not null,
     durata char(1) not null,
     data char(1) not null,
     ora char(1) not null,
     constraint IDVOLO primary key (codice volo),
     constraint IDVOLO_1 unique (, data, ora));


-- Constraints Section
-- ___________________ 


-- Index Section
-- _____________ 

