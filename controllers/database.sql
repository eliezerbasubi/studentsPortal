CREATE TABLE bit (bitID int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	courseUnit varchar(120) NOT NULL, bit_sem varchar(5), 
	bit_year varchar(5), bit_fac varchar(5));

CREATE TABLE fst_compt (bitID int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	courseUnit varchar(120) NOT NULL, course_code varchar(15) NOT NULL,
    bit_fac varchar(5), CONSTRAINT fk_bit_fac FOREIGN KEY (bit_fac) REFERENCES faculty(facId), bit_sem varchar(5) NOT NULL, bit_year varchar(5));

ALTER TABLE fst_bit ADD FOREIGN KEY (`bit_year`) REFERENCES c_years(yearID)

ALTER TABLE fst_bit ADD COLUMN bit_year VARCHAR(5) , ADD FOREIGN KEY (bit_year) REFERENCES c_years(yearID);

ALTER TABLE fst_bit ADD COLUMN (bit_sem VARCHAR(5) , bit_year varchar(5))

INSERT INTO `fst_bit` (`bitID`, `courseUnit`, `course_code`, `bit_fac`, `bit_sem`, `bit_year`) VALUES 
('4', 'Communication Skills', 'BIT 1104', '1', '1', '1'), ('5', 'Enterpreneurship ', 'BIT 1105', '1', '1', '1'),
('6', 'Problem Solving and Algorithms', 'BIT 1106', '1', '1', '1'), 
('7', 'Computer Systems ', 'BIT 1107', '1', '1', '1');

INSERT INTO `fst_bit` (`bitID`, `courseUnit`, `course_code`, `bit_fac`, `bit_sem`, `bit_year`) 
VALUES (NULL, 'System Analysis and Design', 'BIT 1201', '1', '2', '1'),
 (NULL, 'Object-Oriented Programming II', 'BIT 1202', '1', '2', '1'), (NULL, 'Web Design II', 'BIT 1203', '1', '2', '1'), (NULL, 'Network design and Implementation I', 'BIT 1204', '1', '2', '1'), (NULL, 'Basics of Statistics', 'BIT 1205', '1', '2', '1'), 
(NULL, 'Operating Systems', 'BIT 1206', '1', '2', '1'), (NULL, 'Research Methods I', 'BIT 1207', '1', '2', '1');


CREATE TABLE results_bit (resultID int(11) PRIMARY KEY AUTO_INCREMENT,
 regno varchar(25) NOT NULL, CONSTRAINT regno_fk FOREIGN KEY regno REFERENCES students(`stud_regno`), 
 course_name varchar(255) NOT NULL, CONSTRAINT course_name_fk FOREIGN KEY course_name REFERENCES fst_bit(`courseUnit`),
 semester varchar(5) NOT NULL, CONSTRAINT semester_fk FOREIGN KEY semester REFERENCES semesters (`semName`), yearOfStudy varchar(5) NOT NULL, 
CONSTRAINT years_fk FOREIGN KEY yearOfStudy REFERENCES c_years(`years`))


INSERT INTO `results_bit` (`resultID`, `regno`, `cu_name`, `semester`, `yearOfStudy`, `test_marks`, `exam_marks`, `gpa`) VALUES 
(NULL, '16/082/BIT-J', 'Object-Oriented Programming I', '1', '1', '59', '97', '4.3'), 
(NULL, '16/082/BIT-J', 'Computer Applications', '1', '1', '55', '87', '3.6'), 
(NULL, '16/082/BIT-J', 'Web Design I', '1', '1', '79', '90', '4.8'), 
(NULL, '16/082/BIT-J', 'Mathematics for IT', '1', '1', '35', '67', '3.2'), 
(NULL, '16/082/BIT-J', 'Communication Skills', '1', '1', '80', '89', '5.0'), 
(NULL, '16/082/BIT-J', 'Enterpreneurship ', '1', '1', '25', '73', '2.6'), 
(NULL, '16/082/BIT-J', 'Problem Solving and Algorithms', '1', '1', '64', '79', '4.0'),
 (NULL, '16/082/BIT-J', 'Computer Systems ', '1', '1', '72', '67', '3.4');


 INSERT INTO `results_bit` (`resultID`, `regno`, `cu_name`, `semester`, `yearOfStudy`, `test_marks`, `exam_marks`, `gpa`) VALUES 
(NULL, '16/082/BIT-J', 'Operating Systems', '2', '1', '54', '90', '4.0'), 
(NULL, '16/082/BIT-J', 'Web Design II', '2', '1', '59', '60', '3.3'), 
(NULL, '16/082/BIT-J', 'Network design and Implementation I', '2', '1', '89', '80', '4.0'), 
(NULL, '16/082/BIT-J', 'Object-Oriented Programming II', '2', '1', '55', '67', '3.2'), 
(NULL, '16/082/BIT-J', 'Research Methods I', '2', '1', '80', '69', '4.2'), 
(NULL, '16/082/BIT-J', 'Problem Solving and Algorithms', '2', '1', '68', '79', '3.0'),
 (NULL, '16/082/BIT-J', 'System Analysis and Design ', '2', '1', '62', '68', '3.4');


 --Insert users into students table
 INSERT INTO `students` 
 (`stud_regno`, `stud_name`, `stud_midname`, `stud_lname`, `course_code`, `stud_intake`, `stud_year`, `stud_semester`, `stud_fac`, `stud_depart`)
  VALUES ('16/134/BSCS-J', 'Mushagalusa', 'Kagayo', 'Joffrey', NULL, '1', '1', '1', '1', '2'),
  ('17/876/BSCS-S', 'Mwela', 'Mugisho', 'Jackson', NULL, '3', '1', '2', '1', '2');

  -- Insert course units
  INSERT INTO `fst_compt` (`bitID`, `courseUnit`, `course_code`, `bit_fac`, `bit_sem`, `bit_year`) VALUES 
  (NULL, 'Object-Oriented Programming I', 'BIT 1101', '1', '1', '1'), 
  (NULL, 'Computer Applications', 'BIT 1102', '1', '1', '1'),
   (NULL, 'Web Design I', 'BIT1103', '1', '1', '1'), 
   (NULL, 'Discrete Mathematics', 'BIT1104', '1', '1', '1'), 
   (NULL, 'Communication Skills', 'BIT 1105', '1', '1', '1'), 
   (NULL, 'Enterpreneurship ', 'BIT1106', '1', '1', '1'), 
   (NULL, 'Problem Solving and Algorithms', 'BIT1107', '1', '1', '1'),
   (NULL, 'Computer Systems ', 'BIT1108', '1', '1', '1');


-- Insert semester two
	INSERT INTO `fst_compt` (`bitID`, `courseUnit`, `course_code`, `bit_fac`, `bit_sem`, `bit_year`) VALUES 
  (NULL, 'Object-Oriented Programming II', 'BIT 1201', '1', '2', '1'), 
  (NULL, 'System Analysis and Design', 'BIT 1202', '1', '2', '1'),
   (NULL, 'Web Design II', 'BIT1203', '1', '2', '1'), 
   (NULL, 'Numerical Methods', 'BIT1204', '1', '2', '1'),  
   (NULL, 'Network design and Implementation I ', 'BIT1205', '1', '2', '1'), 
   (NULL, 'Operating Systems', 'BIT1206', '1', '1', '1'),
   (NULL, 'Research Methods I ', 'BIT1207', '1', '2', '1');