 
DROP TABLE IF EXISTS receiver;
DROP TABLE IF EXISTS patient;
DROP TABLE IF EXISTS hospital;
DROP TABLE IF EXISTS compatible;
DROP TABLE IF EXISTS stock;
DROP TABLE IF EXISTS blood;
DROP TABLE IF EXISTS health;
DROP TABLE IF EXISTS donar;
DROP TABLE IF EXISTS employee;



create table employee(emp_id VARCHAR(5) PRIMARY KEY ,e_name VARCHAR(15) ,address VARCHAR(30),phone_no BIGINT,email_id VARCHAR(20) UNIQUE NOT NULL);

create table donar(donar_id VARCHAR(5) PRIMARY KEY , donar_name VARCHAR(15) ,address VARCHAR(30),phone_no BIGINT NOT NULL UNIQUE,email_id VARCHAR(20) NOT NULL UNIQUE ,age INT NOT NULL,CHECK (age>=18),height FLOAT NOT NULL,weight FLOAT NOT NULL,emp_id VARCHAR(5),
FOREIGN KEY (emp_id) REFERENCES employee(emp_id) ON DELETE SET NULL,blood_group VARCHAR(3) NOT NULL);

create table health(donar_id VARCHAR(5), FOREIGN KEY (donar_id) REFERENCES donar(donar_id) on DELETE cascade,smoking INT ,CHECK (smoking=0 or smoking=1), alcohol  INT  ,CHECK ( alcohol=0 or  alcohol=1),cancer INT ,
CHECK (cancer=0 or cancer=1),anemia  INT  ,CHECK (anemia=0 or anemia=1),surgery INT  ,CHECK (surgery=0 or surgery=1),last_donated DATE, CHECK (last_donated<=NOW()),PRIMARY KEY(donar_id) );

create table blood(donar_id VARCHAR(5), FOREIGN KEY (donar_id) REFERENCES donar(donar_id) on DELETE set NULL,
blood_group VARCHAR(3),FOREIGN KEY (blood_group) REFERENCES donar(blood_group) ,CHECK (blood_group in ('A+','A-','B+','B-','O+','O-','AB+','AB-')),volume INT  NOT NULL,donated_date DATE NOT NULL);

create table stock(id INT PRIMARY KEY AUTO INCREMENT,blood_group VARCHAR(3) ,CHECK (blood_group in ("A+","A-","B+","B-","O+","O-","AB+","AB-")),volume INT,PRIMARY KEY(blood_group,volume),
refill INT ,CHECK(refill=0 or refill=1),cost FLOAT);

create table compatible(blood_group VARCHAR(3),FOREIGN KEY (blood_group) REFERENCES stock(blood_group),c VARCHAR(3),PRIMARY KEY(blood_group,c));

create table hospital(hospital_id VARCHAR(8) PRIMARY KEY ,h_name VARCHAR(30),location VARCHAR(30) NOT NULL,phone_no BIGINT NOT NULL UNIQUE);

create table patient(patient_id VARCHAR(8), hospital_id VARCHAR(8) NOT NULL,FOREIGN KEY (hospital_id) REFERENCES hospital(hospital_id),h_pid VARCHAR(10) UNIQUE NOT NULL,name VARCHAR(15),reason varchar(50),blood_group VARCHAR(3) ,CHECK (blood_group in ('A+','A-','B+','B-','O+','O-','AB+','AB-')),bottles INT,date DATE NOT NULL,PRIMARY KEY(patient_id,h_pid));

create table receiver(rec_id VARCHAR(5) NOT NULL ,FOREIGN KEY (rec_id) REFERENCES donar(donar_id) , patient_id VARCHAR(8) NOT NULL,FOREIGN KEY (patient_id) REFERENCES patient(patient_id) on DELETE cascade,payment VARCHAR(15), received_on DATE ,CHECK (received_on<=NOW()),emp_id VARCHAR(5), FOREIGN KEY(emp_id) references employee(emp_id)on delete set null,PRIMARY KEY(rec_id,patient_id));

create TABLE cost(rec_id VARCHAR(5) NOT NULL,FOREIGN KEY(rec_id) REFERENCES receiver(rec_id),patient_id VARCHAR(8) NOT NULL,FOREIGN KEY (patient_id) REFERENCES receiver(patient_id) on DELETE cascade,cost FLOAT DEFAULT 0);




 
 