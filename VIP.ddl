-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.1              
-- * Generator date: Dec  4 2018              
-- * Generation date: Wed Dec  1 17:25:40 2021 
-- * LUN file: C:\Users\tbrin\Desktop\ProgettoTW\VIP\VIP.lun 
-- * Schema: VIP/R 
-- ********************************************* 


-- Database Section
-- ________________ 

create database VIP;
use VIP;


-- Tables Section
-- _____________ 

create table ASTA (
     Data varchar(10) not null,
     IdAsta int not null auto_increment,
     CodProdotto int not null,
     Stato varchar(5) not null,
     OraInizio int not null,
     OraFine int not null,
     DataFine varchar(10) not null,
     CodVincitore varchar(20),
     constraint ID_ASTA_ID primary key (IdAsta));

create table ORDINE (
     IdOrdine int not null auto_increment,
     Pagato boolean not null,
     Data varchar(10) not null,
     CodCliente varchar(20) not null,
     constraint ID_ORDINE_ID primary key (IdOrdine));

create table PRODOTTO (
     Nome varchar(50) not null,
     Descrizione varchar(250) not null,
     Prezzo int not null,
     IDProdotto int not null auto_increment,
     Base_asta int,
     Disponibilita int,
     TimeStamp int not null,
     Immagine longblob not null,
     constraint ID_PRODOTTO_ID primary key (IDProdotto));

create table PUNTATA (
     quantita int not null,
     IdPuntata int not null auto_increment,
     IdAsta int not null,
     CodCliente varchar(20) not null,
     constraint ID_PUNTATA_ID primary key (IdPuntata));

create table RIGA (
     CodOrdine int not null,
     Quantita int not null,
     IdRiga int not null auto_increment,
     CodProdotto int not null,
     constraint ID_RIGA_ID primary key (IdRiga));

create table USER (
     Email varchar(50) not null,
     Password varchar(20) not null,
     IdVenditore boolean default False not null,
     constraint ID_USER_ID primary key (Email));


-- Constraints Section
-- ___________________ 

alter table ASTA add constraint EQU_ASTA_PRODO_FK
     foreign key (CodProdotto)
     references PRODOTTO (IDProdotto);

alter table ASTA add constraint REF_ASTA_USER_FK
     foreign key (CodVincitore)
     references USER (Email);

alter table ORDINE add constraint REF_ORDIN_USER_FK
     foreign key (CodCliente)
     references USER (Email);

-- Not implemented
-- alter table PRODOTTO add constraint ID_PRODOTTO_CHK
--     check(exists(select * from ASTA
--                  where ASTA.CodProdotto = IDProdotto)); 

alter table PRODOTTO add constraint EXTONE_PRODOTTO
     check((Base_asta is not null and Disponibilita is null)
           or (Base_asta is null and Disponibilita is not null)); 

alter table PUNTATA add constraint REF_PUNTA_ASTA_FK
     foreign key (IdAsta)
     references ASTA (IdAsta);

alter table PUNTATA add constraint REF_PUNTA_USER_FK
     foreign key (CodCliente)
     references USER (Email);

alter table RIGA add constraint REF_RIGA_PRODO_FK
     foreign key (CodProdotto)
     references PRODOTTO (IDProdotto);

alter table RIGA add constraint REF_RIGA_ORDIN
     foreign key (CodOrdine)
     references ORDINE (IdOrdine);


-- Index Section
-- _____________ 

create unique index ID_ASTA_IND
     on ASTA (IdAsta);

create index EQU_ASTA_PRODO_IND
     on ASTA (CodProdotto);

create index REF_ASTA_USER_IND
     on ASTA (CodVincitore);

create unique index ID_ORDINE_IND
     on ORDINE (IdOrdine);

create index REF_ORDIN_USER_IND
     on ORDINE (CodCliente);

create unique index ID_PRODOTTO_IND
     on PRODOTTO (IDProdotto);

create index REF_PUNTA_ASTA_IND
     on PUNTATA (IdAsta);

create index REF_PUNTA_USER_IND
     on PUNTATA (CodCliente);

create unique index ID_PUNTATA_IND
     on PUNTATA (IdPuntata);

create unique index ID_RIGA_IND
     on RIGA (CodOrdine, IdRiga);

create index REF_RIGA_PRODO_IND
     on RIGA (CodProdotto);

create unique index ID_USER_IND
     on USER (Email);

