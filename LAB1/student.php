php
<?php
// Define Student class
class Student {
    // Define some attribute for Student class.
    public $name;
    public $studentId;
    public $department;

    // Define constructor function for class.
    function __construct($name, $studentId, $department) {
        $this->name = $name;
        $this->studentId = $studentId;
        $this->department = $department;
    }

    // Define sayHello Function for print a message.
    function sayHello() {
        echo "Hello! I am a student.<br>";
    }

    // Define showInfo function for print class attributs values
    function showInfo() {
        echo "Name: " . $this->name . "<br>";
        echo "Student ID: " . $this->studentId . "<br>";
        echo "Department: " . $this->department . "<br>";
    }
}

// Create an object of class with assigning values to their attributs.
$student1 = new Student("Ahmad", 1001, "Computer Science");

// Call showInfo Function
$student1->showInfo();
?>
