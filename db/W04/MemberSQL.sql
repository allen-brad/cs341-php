--Create tables for Member Database
-- ************************************** MemberStatus
--for clean up
DROP TABLE IF EXISTS MemberStatus;

CREATE TABLE MemberStatus
(
 memberStatusID  integer NOT NULL GENERATED ALWAYS AS IDENTITY,
 memberStatusType varchar(50) NOT NULL,
 CONSTRAINT PK_MemberStatus PRIMARY KEY ( memberStatusID )
);


-- ************************************** Member
--for clean up
DROP TABLE IF EXISTS Member;
CREATE TABLE Member
(
 memberID       integer NOT NULL GENERATED ALWAYS AS IDENTITY (
 start 1000
 ),
 lastName       varchar(50) NOT NULL,
 fisrtName      varchar(50) NOT NULL,
 middleName     varchar(50) NULL,
 preferredName  varchar(25) NOT NULL,
 callSign       varchar(10) NOT NULL,
 dob            date NOT NULL,
 sarEmail       varchar(50) NOT NULL,
 personalEmail  varchar(50) NOT NULL,
 dlNuber        varchar(20) NOT NULL,
 dlState        varchar(2) NOT NULL,
 ssnLastFour    integer NOT NULL,
 createdDate    time with time zone NOT NULL,
 lastUpdate     time with time zone NOT NULL,
 memberStatusID integer NOT NULL,
 CONSTRAINT PK_Member PRIMARY KEY ( memberID ),
 CONSTRAINT FK_236 FOREIGN KEY ( memberStatusID ) REFERENCES MemberStatus ( memberStatusID )
);

CREATE INDEX ON Member
(
 memberStatusID
);

-- ************************************** MemberTenure
--for clean up
DROP TABLE IF EXISTS MemberTenure;

CREATE TABLE MemberTenure
(
 memberTenureID integer NOT NULL GENERATED ALWAYS AS IDENTITY,
 startDate      date NOT NULL,
 endDate        date NOT NULL,
 createdDate    time with time zone NOT NULL,
 lastUpdate     time with time zone NOT NULL,
 memberID       integer NOT NULL,
 createdBy      integer NOT NULL,
 lastUpdateBy   integer NOT NULL,
 CONSTRAINT PK_MemberTenure PRIMARY KEY ( memberTenureID ),
 CONSTRAINT FK_283 FOREIGN KEY ( memberID ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_286 FOREIGN KEY ( createdBy ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_289 FOREIGN KEY ( lastUpdateBy ) REFERENCES Member ( memberID )
);

CREATE INDEX ON MemberTenure
(
 memberID
);

CREATE INDEX ON MemberTenure
(
 createdBy
);

CREATE INDEX ON MemberTenure
(
 lastUpdateBy
);

-- ************************************** MemberAddress
--for clean up
DROP TABLE IF EXISTS MemberAddress;

CREATE TABLE MemberAddress
(
 memberAddressID integer NOT NULL GENERATED ALWAYS AS IDENTITY (
 start 1000
 ),
 street1         varchar(50) NOT NULL,
 street2         varchar(50) NULL,
 street3         varchar(50) NULL,
 city            varchar(50) NOT NULL,
 state           varchar(50) NOT NULL,
 zip             varchar(10) NOT NULL,
 createdDate     time with time zone NOT NULL,
 lastUpdate      time with time zone NOT NULL,
 memberID        integer NOT NULL,
 createdBy       integer NOT NULL,
 lastUpdateBy    integer NOT NULL,
 CONSTRAINT PK_MemberAddress PRIMARY KEY ( memberAddressID ),
 CONSTRAINT FK_249 FOREIGN KEY ( memberID ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_252 FOREIGN KEY ( createdBy ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_255 FOREIGN KEY ( lastUpdateBy ) REFERENCES Member ( memberID )
);

CREATE INDEX ON MemberAddress
(
 memberID
);

CREATE INDEX ON MemberAddress
(
 createdBy
);

CREATE INDEX ON MemberAddress
(
 lastUpdateBy
);

-- ************************************** MemberEmergencyContact
--for clean up
DROP TABLE IF EXISTS MemberEmergencyContact;

CREATE TABLE MemberEmergencyContact
(
 memberEmergencyContactID integer NOT NULL GENERATED ALWAYS AS IDENTITY (
 start 1000
 ),
 contactFullName          varchar(100) NOT NULL,
 contactCellPhone         varchar(50) NOT NULL,
 contactHomePhone         varchar(50) NOT NULL,
 createdDate              time with time zone NOT NULL,
 lastUpdate               time with time zone NOT NULL,
 memberID                 integer NOT NULL,
 createdBy                integer NOT NULL,
 lastUpdateBy             integer NOT NULL,
 CONSTRAINT PK_MemberEmergencyContact PRIMARY KEY ( memberEmergencyContactID ),
 CONSTRAINT FK_267 FOREIGN KEY ( memberID ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_270 FOREIGN KEY ( createdBy ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_273 FOREIGN KEY ( lastUpdateBy ) REFERENCES Member ( memberID )
);

CREATE INDEX ON MemberEmergencyContact
(
 memberID
);

CREATE INDEX ON MemberEmergencyContact
(
 createdBy
);

CREATE INDEX ON MemberEmergencyContact
(
 lastUpdateBy
);

-- ************************************** MemberPhone
--for cleanup
DROP TABLE IF EXISTS MemberPhone;

CREATE TABLE MemberPhone
(
 memberPhoneID integer NOT NULL GENERATED ALWAYS AS IDENTITY (
 start 1000
 ),
 phoneType     varchar(50) NOT NULL,
 phoneNumber   varchar(50) NOT NULL,
 isPrimary     boolean NOT NULL,
 createdDate   time with time zone NOT NULL,
 lastUpdate    time with time zone NOT NULL,
 memberID      integer NOT NULL,
 createdBy     integer NOT NULL,
 lastUpdateBy  integer NOT NULL,
 CONSTRAINT PK_MemberPhone PRIMARY KEY ( memberPhoneID ),
 CONSTRAINT FK_223 FOREIGN KEY ( memberID ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_230 FOREIGN KEY ( createdBy ) REFERENCES Member ( memberID ),
 CONSTRAINT FK_233 FOREIGN KEY ( lastUpdateBy ) REFERENCES Member ( memberID )
);

CREATE INDEX  ON MemberPhone
(
 memberID
);

CREATE INDEX  ON MemberPhone
(
 createdBy
);

CREATE INDEX  ON MemberPhone
(
 lastUpdateBy
);
