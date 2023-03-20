
    
    
    INSERT INTO employee VALUES('E1000','Emp1','BSK',1287612345,'emp1@gmail.com');
    INSERT INTO employee VALUES('E2000','Emp2','HSR',1287612344,'emp2@gmail.com');
    INSERT INTO employee VALUES('E3000','Emp3','INR',1287612343,'emp3@gmail.com');
    INSERT INTO employee VALUES('E4000','Emp4','RPC Layout',1227612345,'emp4@gmail.com');
    INSERT INTO employee VALUES('E5000','Emp5','Jalahalli',1281112345,'emp5@gmail.com');
    INSERT INTO employee VALUES('M1000','Emp6','Hebbal',9812345678,'emp6@gmail.com');
    INSERT INTO employee VALUES('E6000','Emp7','Peenya',9812342678,'emp7@gmail.com');
    INSERT INTO employee VALUES('E7000','Emp8','RT Nagar',9812309678,'emp8@gmail.com');
    INSERT INTO employee VALUES('E8000','Emp9','Malleshwaram',9811145678,'emp9@gmail.com');
    INSERT INTO employee VALUES('E9000','Emp10','MG Road',9002135678,'emp10@gmail.com');

      INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('D0001','Donar1','BSK','9156209876','don1@gmail.com','25','5.5','65','E1000','A+');
      INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('D0002','Donar2','INR','9156209856','don2@gmail.com','26','5.6','55','E2000','B+');
      INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('D0003','Donar3','HSR','9156202360','don3@gmail.com','20','5.1','45','E3000','B-');
      INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('D0004','Donar4','CV Raman','9236209876','don4@gmail.com','49','5.4','70','E1000','AB+');
      INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('D0005','Donar5','Vijayanagar','8156209876','don5@gmail.com','34','4.10','50','E1000','O+');
      INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('D0006','Donar6','Rajajinagar','7156209876','don6@gmail.com','21','5.2','52','E2000','A-');
      INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('D0007','Donar7','Basaveshwarnagar','9136209876','don7@gmail.com','25','5.7','55','E2000','O-');
      INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('D0008','Donar8','Hebbar','9156293786','don8@gmail.com','55','5.3','63','E3000','AB-');
      INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('D0009','Donar9','BSK','9156209126','don9@gmail.com','23','5.5','65','E4000','A+');
      INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('D0010','Donar10','BSK','8756209876','don10@gmail.com','45','5.5','65','E5000','B-');

    INSERT INTO health values('D0001',1,0,0,0,0,'2019:05:01');
    INSERT INTO health values('D0002',1,0,1,0,0,'2019:12:02');
    INSERT INTO health values('D0003',0,0,0,0,0,'2019:06:21');
    INSERT INTO health values('D0004',0,0,0,0,0,'2019:07:31');
    INSERT INTO health values('D0005',0,0,0,0,0,'2019:08:10');
    INSERT INTO health values('D0006',0,0,0,0,0,'2018:09:01');
    INSERT INTO health values('D0007',0,0,0,0,1,'2017:01:15');
    INSERT INTO health values('D0008',1,0,0,0,1,'2019:10:13');
    INSERT INTO health values('D0009',1,1,0,0,0,'2019:11:25');
    INSERT INTO health values('D0010',0,0,0,0,0,'2019:02:16');
    
      INSERT INTO blood(donar_id,blood_group,volume,donated_date) VALUES('D0009','A+',250,'2018:11:25');
      INSERT INTO blood(donar_id,blood_group,volume,donated_date) VALUES('D0003','B-',350,'2016:12:25');
      INSERT INTO blood(donar_id,blood_group,volume,donated_date) VALUES('D0010','B-',150,'2019:08:10');
      INSERT INTO blood(donar_id,blood_group,volume,donated_date) VALUES('D0005','O+',250,'2018:11:25');
      INSERT INTO blood(donar_id,blood_group,volume,donated_date) VALUES('D0006','A-',250,'2019:09:01');
      INSERT INTO blood(donar_id,blood_group,volume,donated_date) VALUES('D0009','A+',250,'2019:11:25');
      INSERT INTO blood(donar_id,blood_group,volume,donated_date) VALUES('D0003','AB-',350,'2019:12:25');
      INSERT INTO blood(donar_id,blood_group,volume,donated_date) VALUES('D0004','AB+',150,'2019:08:10');

    INSERT INTO stock VALUES('A+',500,0,700);
    INSERT INTO stock VALUES('A-',250,1,800);
    INSERT INTO stock VALUES('B+',0,1,700);
    INSERT INTO stock VALUES('B-',500,0,800);
    INSERT INTO stock VALUES('AB+',0,1,500);
    INSERT INTO stock VALUES('AB-',350,1,500);
    INSERT INTO stock VALUES('O+',250,1,500);
    INSERT INTO stock VALUES('O-',150,1,1000);


    INSERT INTO hospital VALUES('HOS1000','Aster CMI','Hebbal',23102345);
    INSERT INTO hospital VALUES('HOS2000','Columbia Asia','Hebbal',23105345);
    INSERT INTO hospital VALUES('HOS3000','Columbia Asia','Yeshwanthpur',24102345);
    INSERT INTO hospital VALUES('HOS4000','Apollo','Whitefield',23102245);
    INSERT INTO hospital VALUES('HOS5000','Fortis','Vijayanagar',23652345);
    INSERT INTO hospital VALUES('HOS6000','Panacea','Basaveshwarnagar',23102305);
    INSERT INTO hospital VALUES('HOS7000','Global hospitals','Banashankari',23100045);

    INSERT INTO patient VALUES('P1100000','HOS1000','1234567890','patient1','CABG','A+',7,'2020:01:24');
    INSERT INTO patient VALUES('P1200000','HOS2000','234567890','patient2','Open heart','AB+',10,'2019:07:24');
    INSERT INTO patient VALUES('P1300000','HOS1000','1234567290','patient3','Surgery','A+',5,'2020:01:21');
    INSERT INTO patient VALUES('P1400000','HOS3000','34567890','patient4','Anemia','B+',2,'2019:11:02');
    INSERT INTO patient VALUES('P1500000','HOS4000','ME234567890','patient5','ceaserian','A-',1,'2018:10:12');
    INSERT INTO patient VALUES('P1600000','HOS3000','12347890','patient6','accident','O+',5,'2019:01:14');
    INSERT INTO patient VALUES('P1700000','HOS5000','F234567890','patient7','CABG','O-',4,'2017:01:13');
    INSERT INTO patient VALUES('P1800000','HOS5000','F234567190','patient8','internal bleeding','AB-',3,'2020:09:24');
    INSERT INTO patient VALUES('P1900000','HOS6000','MRN4567890','patient9','accident','B-',2,'2018:06:30');
    INSERT INTO patient VALUES('P2100000','HOS7000','S23456789','patient10','thalasemmia','AB-',5,'2017:05:03');


    INSERT INTO receiver VALUES('D0001','P1100000','REPLACEMENT','2020:01:24');
    INSERT INTO receiver VALUES('D0002','P1200000','PAY','2019:07:24');
    INSERT INTO receiver VALUES('D0003','P1300000','REPLACEMENT','2020:01:21');
    INSERT INTO receiver VALUES('D0004','P1400000','REPLACEMENT','2019:11:02');
    INSERT INTO receiver VALUES('D0005','P1500000','REPLACEMENT','2018:10:12');
    INSERT INTO receiver VALUES('D0006','P1600000','REPLACEMENT','2019:01:14');
    INSERT INTO receiver VALUES('D0007','P1700000','REPLACEMENT','2017:01:13');
    INSERT INTO receiver VALUES('D0008','P1800000','REPLACEMENT','2020:09:24');
    INSERT INTO receiver VALUES('D0009','P1900000','REPLACEMENT','2018:06:30');
    INSERT INTO receiver VALUES('D0010','P2100000','PAY','2017:05:03');
    
   


    INSERT INTO compatible VALUES('A+','A+');
    INSERT INTO compatible VALUES('A+','A-');
    INSERT INTO compatible VALUES('A+','O+');
    INSERT INTO compatible VALUES('A+','O-');
    INSERT INTO compatible VALUES('B+','B+');
    INSERT INTO compatible VALUES('B+','B-');
    INSERT INTO compatible VALUES('B+','O+');
    INSERT INTO compatible VALUES('B+','O-');
    INSERT INTO compatible VALUES('A-','A-');
    INSERT INTO compatible VALUES('A-','O-');
    INSERT INTO compatible VALUES('B-','B-');
    INSERT INTO compatible VALUES('B-','O-');
    INSERT INTO compatible VALUES('O+','O+');
    INSERT INTO compatible VALUES('O+','O-');
    INSERT INTO compatible VALUES('O-','O-');
    INSERT INTO compatible VALUES('AB+','AB+');
    INSERT INTO compatible VALUES('AB+','AB-');
    INSERT INTO compatible VALUES('AB+','A+');
    INSERT INTO compatible VALUES('AB+','B+');
    INSERT INTO compatible VALUES('AB+','O+');
    INSERT INTO compatible VALUES('AB+','A-');
    INSERT INTO compatible VALUES('AB+','B-');
    INSERT INTO compatible VALUES('AB+','O-');
    INSERT INTO compatible VALUES('AB-','AB-');
    INSERT INTO compatible VALUES('AB-','A-');
    INSERT INTO compatible VALUES('AB-','B-');
    INSERT INTO compatible VALUES('AB-','O-');

