<?php
/*
Web Development | Lab Assignment 02
Inheritance and Access Modifiers
Student Name: Farhad Ahmadi
*/

// ================= Task 1 - Access Modifiers =================

class StudentAccount
{
    public $name;
    private $studentId;
    protected $department;

    function __construct($name, $studentId, $department)
    {
        $this->name = $name;
        $this->studentId = $studentId;
        $this->department = $department;
    }

    function showInfo()
    {
        echo "Name: " . $this->name . "\n";
        echo "Student ID: " . $this->studentId . "\n";
        echo "Department: " . $this->department . "\n";
    }

    function getStudentId()
    {
        return $this->studentId;
    }
}

$student1 = new StudentAccount("Ahmad", 1001, "Computer Science");

$student1->showInfo();
echo "Student ID from method: " . $student1->getStudentId() . "\n";

/*
Experiment: accessing the properties from outside the class

echo $student1->name;       -> Works. It is public.
echo $student1->studentId;  -> Fatal error. It is private.
echo $student1->department; -> Fatal error. It is protected.

Property      | Works outside class? | Reason
$name         | Yes                  | Public properties can be accessed from anywhere.
$studentId    | No                   | Private properties can only be used inside their own class.
$department   | No                   | Protected properties can only be used inside the class and its child classes.
*/

// ================= Task 2 - Simple Inheritance =================

class Person
{
    protected $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function introduce()
    {
        echo "My name is " . $this->name . "\n";
    }
}

class Student extends Person
{
    function study()
    {
        echo $this->name . " is studying.\n";
    }
}

$student2 = new Student("Sara");

$student2->introduce();
$student2->study();

/*
Think about it:
The Student object can use $name and introduce() because Student extends Person,
so it inherits all the properties and methods of the parent class (protected and public ones).
*/

// ================= Task 3 - Combine Inheritance and Access Modifiers =================

class Employee
{
    public $company;
    protected $name;
    private $salary;

    function __construct($name, $company, $salary)
    {
        $this->name = $name;
        $this->company = $company;
        $this->salary = $salary;
    }

    function showEmployee()
    {
        echo "Name: " . $this->name . "\n";
        echo "Company: " . $this->company . "\n";
        echo "Salary: " . $this->salary . "\n";
    }

    function getSalary()
    {
        return $this->salary;
    }
}

class Manager extends Employee
{
    function manageTeam()
    {
        echo $this->name . " is managing the team.\n";
    }
}

$manager1 = new Manager("Ali", "Kabul Tech", 30000);

$manager1->showEmployee();
echo "Salary from method: " . $manager1->getSalary() . "\n";
$manager1->manageTeam();

/*
==================== Short Questions ====================

1. What does public mean?
   The property or method can be accessed from anywhere, inside the class,
   from child classes, and outside the class.

2. What does private mean?
   The property or method can only be accessed inside the same class where it is defined.

3. What does protected mean?
   The property or method can be accessed inside the class where it is defined
   and inside child classes that extend it, but not from outside.

4. What is the purpose of extends?
   It creates a child class that inherits all public and protected properties
   and methods of a parent class.

5. Which class is called the parent class?
   The class that is being extended, the one that gives its properties and methods away.

6. Which class is called the child class?
   The class that uses extends to inherit from another class.

7. Why is protected useful in inheritance?
   Because it hides data from the outside world but still lets child classes
   use and build on the parent's properties and methods.
*/
?>
