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

-- Table Section
-- _____________

create table asta (
     IdAsta int not null auto_increment,
     CodProdotto int not null,
     AnnoInizio int not null,
     MeseInizio int not null,
     GiornoInizio int not null,
     OraInizio varchar(10) not null,
     AnnoFine int not null,
     MeseFine int not null,
     GiornoFine int not null,
     OraFine varchar(10) not null,
     CodVincitore varchar(50),
     constraint ID_ASTA_ID primary key (IdAsta));

create table notifica (
     Email varchar(50) not null,
     Text varchar(140) not null,
     IdNotifica int(1) not null auto_increment,
     IdAsta int,
     IdOrdine int,
     TotaleOrdine int,
     IDProdotto int,
     TimeStamp varchar(30) not null,
     Visualizzata boolean not null,
     constraint IDNOTIFICA primary key (IdNotifica));


create table ordine (
     IdOrdine int not null auto_increment,
     Pagato boolean not null,
     Data varchar(30) not null,
     CodCliente varchar(50) not null,
     constraint ID_ORDINE_ID primary key (IdOrdine));

create table prodotto (
     Nome varchar(50) not null,
     Descrizione varchar(1000) not null,
     DescrizioneBreve varchar(150) not null,
     Prezzo int not null,
     IDProdotto int not null auto_increment,
     Base_asta int,
     Disponibilita int,
     Immagine varchar(100) not null,
     constraint ID_PRODOTTO_ID primary key (IDProdotto));

create table puntata (
     quantita int not null,
     TimeStamp varchar(30) not null,
     Notifica varchar(140) not null,
     IdPuntata int not null auto_increment,
     IdAsta int not null,
     CodCliente varchar(50) not null,
     constraint ID_PUNTATA_ID primary key (IdPuntata));

create table riga (
     CodOrdine int not null,
     Quantita int not null,
     IdRiga int not null auto_increment,
     CodProdotto int not null,
     constraint ID_RIGA_ID primary key (IdRiga));

create table user (
     email varchar(50) not null,
     password varchar(65) not null,
     idvenditore boolean default False not null,
     constraint ID_USER_ID primary key (email));


-- Constraints Section
-- ___________________ 

alter table asta add constraint EQU_ASTA_PRODO_FK
     foreign key (CodProdotto)
     references prodotto (IDProdotto);

alter table asta add constraint REF_ASTA_USER_FK
     foreign key (CodVincitore)
     references user (email);

alter table notifica add constraint FKriceve_FK
     foreign key (Email)
     references user (email);

alter table notifica add constraint FKriferito
     foreign key (IdOrdine)
     references ordine (IdOrdine);

alter table notifica add constraint FKriferito1
     foreign key (IDProdotto)
     references prodotto (IDProdotto);

alter table notifica add constraint FKriferito2
     foreign key (IdAsta)
     references prodotto (IDProdotto);

alter table notifica add constraint GRNOTIFICA
     check((IdAsta is not null and IdOrdine is null and IDProdotto is null)
           or (IdAsta is null and IdOrdine is not null and IDProdotto is null)
           or (IdAsta is null and IdOrdine is null and IDProdotto is not null)); 


alter table ordine add constraint REF_ORDIN_USER_FK
     foreign key (CodCliente)
     references user (email);

-- Not implemented
-- alter table PRODOTTO add constraint ID_PRODOTTO_CHK
--     check(exists(select * from ASTA
--                  where ASTA.CodProdotto = IDProdotto)); 

alter table prodotto add constraint EXTONE_PRODOTTO
     check((Base_asta is not null and Disponibilita is null)
           or (Base_asta is null and Disponibilita is not null)); 

alter table puntata add constraint REF_PUNTA_ASTA_FK
     foreign key (IdAsta)
     references asta (IdAsta);

alter table puntata add constraint REF_PUNTA_USER_FK
     foreign key (CodCliente)
     references user (email);

alter table riga add constraint REF_RIGA_PRODO_FK
     foreign key (CodProdotto)
     references prodotto (IDProdotto);

alter table riga add constraint REF_RIGA_ORDIN
     foreign key (CodOrdine)
     references ordine (IdOrdine);


-- Index Section
-- _____________ 

create unique index ID_ASTA_IND
     on asta (IdAsta);

create index EQU_ASTA_PRODO_IND
     on asta (CodProdotto);

create index REF_ASTA_USER_IND
     on asta (CodVincitore);

create index FKriceve_IND
     on notifica (Email);

create unique index ID_ORDINE_IND
     on ordine (IdOrdine);

create index REF_ORDIN_USER_IND
     on ordine (CodCliente);

create unique index ID_PRODOTTO_IND
     on prodotto (IDProdotto);

create index REF_PUNTA_ASTA_IND
     on puntata (IdAsta);

create index REF_PUNTA_USER_IND
     on puntata (CodCliente);

create unique index ID_PUNTATA_IND
     on puntata (IdPuntata);

create unique index ID_RIGA_IND
     on riga (CodOrdine, IdRiga);

create index REF_RIGA_PRODO_IND
     on riga (CodProdotto);

create unique index ID_USER_IND
     on user (email);


