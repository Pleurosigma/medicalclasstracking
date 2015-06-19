# Introduction #

Use the following query to create our database in a mysql server.


# Details #

```
CREATE SCHEMA `CapstoneDB` ;

CREATE  TABLE `CapstoneDB`.`Classes` (
  `ClassCode` VARCHAR(9) NOT NULL ,
  `ClassName` VARCHAR(200) NOT NULL ,
  `StartTime` DATETIME NOT NULL ,
  `EndTime` DATETIME NOT NULL ,
  `CreditHrs` DECIMAL(3,2) NOT NULL ,
  `Faculty` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`ClassCode`) ,
  UNIQUE INDEX `ClassCode_UNIQUE` (`ClassCode` ASC) )
ENGINE = MyISAM;

CREATE  TABLE `CapstoneDB`.`StudentClasses` (
  `idStudentClasses` BIGINT NOT NULL AUTO_INCREMENT ,
  `ONYEN` VARCHAR(45) NOT NULL ,
  `ClassCode` VARCHAR(9) NOT NULL ,
  PRIMARY KEY (`idStudentClasses`) ,
  UNIQUE INDEX `idStudentClasses_UNIQUE` (`idStudentClasses` ASC) )
ENGINE = MyISAM;

CREATE  TABLE `CapstoneDB`.`Admins` (
  `Admins` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`Admins`) ,
  UNIQUE INDEX `Admins_UNIQUE` (`Admins` ASC) )
ENGINE = MyISAM;
```