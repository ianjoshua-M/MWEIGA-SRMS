-- Create the Student table
CREATE TABLE Student (
    StudentID INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    Name VARCHAR(255) NOT NULL,
    RegistrationNumber VARCHAR(255) NOT NULL,
    Class VARCHAR(255) NOT NULL,
    Gender VARCHAR(255) NOT NULL
);

-- Create the Teacher table
CREATE TABLE Teacher (
    TeacherID INT IDENTITY(1,1) PRIMARY KEY,
    Password VARCHAR(255) NOT NULL
);

-- Create the Administrator table
CREATE TABLE Administrator (
    AdminID INT IDENTITY(1,1) PRIMARY KEY,
    Password VARCHAR(255) NOT NULL
);


-- Create the Result table
CREATE TABLE Result (
    ResultID INT IDENTITY(1,1) PRIMARY KEY,
    StudentID INT,
    Subject VARCHAR(255) NOT NULL,
    s1 INT,
	s2 INT,
	s3 INT,
	s4 INT,
	s5 INT,
	s6 INT,
	s7 INT, 
	s8 INT,
	TOTALMARK INT,
	FOREIGN KEY (StudentID) REFERENCES Student(StudentID),
    
);


-- Create the Grade table
CREATE TABLE Grade (
    GradeID INT IDENTITY(1,1) PRIMARY KEY,
    StudentID INT,
	ResultID INT,
    Subject VARCHAR(255) NOT NULL,
    s1Grade VARCHAR(255),
    s2Grade VARCHAR(255),
    s3Grade VARCHAR(255),
    s4Grade VARCHAR(255),
    s5Grade VARCHAR(255),
    s6Grade VARCHAR(255),
    s7Grade VARCHAR(255),
    s8Grade VARCHAR(255),
	TOTALMARKGrade VARCHAR(255),
    FOREIGN KEY (StudentID) REFERENCES Student(StudentID),
    FOREIGN KEY (ResultID) REFERENCES Result(ResultID)
);
