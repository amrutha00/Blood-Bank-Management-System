DELIMITER $$
CREATE TRIGGER `check_bg` BEFORE INSERT ON `patient` FOR EACH ROW BEGIN
	
    IF new.h_pid in (SELECT h_pid FROM patient WHERE h_pid=new.h_pid) 
 	 THEN UPDATE patient SET reason=new.reason,bottles=new.bottles,date=new.date 
  WHERE h_pid=new.h_pid;
 	
   ELSE
      IF new.blood_group not IN ("A+","A-","B+","B-","O+","O-","AB+","AB-") 
        THEN SIGNAL sqlstate '45000' SET MESSAGE_TEXT = 'Warning: Enter the right blood group';
  END IF;
   	
  END IF;
    
END
$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER `check_date` BEFORE UPDATE ON `health` FOR EACH ROW BEGIN
   If new.last_donated >DATE(NOW())
  THEN SIGNAL sqlstate '45000' SET MESSAGE_TEXT = 'Warning: Enter the right date';
  END IF;
    
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `check_last_donated` BEFORE INSERT ON `health` FOR EACH ROW BEGIN
   IF new.last_donated >DATE(NOW())
        THEN SIGNAL sqlstate '45000' SET MESSAGE_TEXT = 'Warning: Enter the right date';
  END IF;
    
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER ` check_bloodgrp` BEFORE INSERT ON `blood` FOR EACH ROW BEGIN
    IF new.blood_group not IN ("A+","A-","B+","B-","O+","O-","AB+","AB-") 
        THEN SIGNAL sqlstate '45000' SET MESSAGE_TEXT = 'Warning: Enter the right blood group';
    END IF;

   IF new.donated_date < (SELECT last_donated from health where health.donar_id=new.donar_id) 
        THEN SIGNAL sqlstate '45000' SET MESSAGE_TEXT = 'Warning: You cannot donate!';
   END IF;
    
END
$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER `update_stockvolume` AFTER INSERT ON `blood` FOR EACH ROW BEGIN
  
   UPDATE stock,blood SET  stock.volume=stock.volume+new.volume WHERE stock.blood_group=new.blood_group;
   
    UPDATE stock,blood SET  stock.refill=0 WHERE stock.blood_group=new.blood_group and stock.volume>=500;
     
    UPDATE stock,blood SET  stock.refill=1 WHERE stock.blood_group=new.blood_group and stock.volume<500;
    
    UPDATE health set health.last_donated=new.donated_date WHERE health.donar_id=new.donar_id;
     
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `check_blood_group` BEFORE INSERT ON `compatible` FOR EACH ROW BEGIN
    IF new.blood_group not IN ("A+","A-","B+","B-","O+","O-","AB+","AB-") or 
    new.c not in ("A+","A-","B+","B-","O+","O-","AB+","AB-")
        THEN SIGNAL sqlstate '45000' SET MESSAGE_TEXT = 'Warning: Enter the right blood group';
    END IF;
    
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `check_age` BEFORE INSERT ON `donar` FOR EACH ROW BEGIN
    IF new.age <=18
  THEN SIGNAL sqlstate '45000' SET MESSAGE_TEXT = 'Warning: Age must be greater than 18';
  END IF;
     IF new.blood_group not IN ("A+","A-","B+","B-","O+","O-","AB+","AB-") 
  THEN SIGNAL sqlstate '45000' SET MESSAGE_TEXT = 'Warning: Enter the right blood group';
  END IF;
   
END
$$
DELIMITER ;

