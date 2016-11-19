DROP TABLE IF EXISTS `Account`;
CREATE TABLE `Account`(
 `AccountID` int(11) NOT NULL AUTO_INCREMENT,
 `UserName` varchar(255) NOT NULL,
 `FirstName` varchar(255) NOT NULL,
 `LastName` varchar(255) NOT NULL,
 `Educator` int NOT NULL DEFAULT 0,
 check(`Educator` == 0 OR `Educator` == 1),
 `Password` varchar(255) NOT NULL,
 /* Passwords can be 6-18 char long*/
 check(LEN(`Password`) >= 6 AND LEN(`Password`) <= 18),
 PRIMARY KEY (`Password`),
 UNIQUE KEY (`UserName`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `Community`;
CREATE TABLE `Community` (
  `CommunityID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `State` varchar(255),
  `Country` varchar (255) NOT NULL,
  `SkillNeeded` varchar(255) NOT NULL,
  `UserComments` varchar(255),
  PRIMARY KEY (`ProfessID`),
  UNIQUE KEY (`Name`),
  UNIQUE KEY (`SkillNeeded`)
) ENGINE=InnoDB;

/* Change these skills as you would like */
INSERT INTO `Community` (`Name`, `State`, `Country`, `SkillNeeded`) VALUES
("Blackwater", "Arizona", "United States", "Automotive Mechanic"),
("Athens", "Ohio", "United States", "Locomotive Mechanic"),
("Cité Soleil", NULL, "Haiti", "Aircraft Mechanic"),
("Cidade de Deus", NULL, "Brazil", "Welding");
