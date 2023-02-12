<?php

/**
 * Main OOP Concepts
 * Inheritance (*)
 * Abstraction
 * Encapsulation
 * Polymorphism
 */

/**
 * Inheritance is the mechanism to move all public/protected attributes & methods from `Parent Class` to `Child Class`.
 * in another meaning the `Child Class` inherit all public/protected attributes & methods of `Parent Class`.
 * `Child Class` derives from `Parent Class`.
 * `Child Class` is a superclass for `Parent Class` (think about this point more)
 * We make inheritance by `extends` keyword.
 *
 * + PHP doesn't support multi inheritance
 *
 * Encapsulation
    * is encapsulating some logic by the possible mechanisms that PHP provided
    * like when you have a property that should write a validation logic to protect it
    * then we make it as private, then encapsulate the validation & the assign value logic in some public method.
 *
 * Override & overloading
 */
class Person {
    protected $id;
    protected $name;
    protected $age;

    public function __construct($id = null, $name = null, $age = null)
    {
        if ($id) {
            $this->setId($id);
        }

        if ($name) {
            $this->setName($name);
        }

        if ($age) {
            $this->setAge($age);
        }
    }

    public function setId($id)
    {
        if (strlen($id) != 6) {
            throw new Exception("The id should be from 6 digits");
        }

        $this->id = $id;
    }

    public function getId($id)
    {
        return $this->id;
    }

    public function setName($full_name)
    {
        $names = explode(' ', $full_name);

        if (sizeof($names) != 4) {
            throw new Exception("Please passing the full name [first name, parent name, grandfather name, family name]");
        }

        $this->name = $full_name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAge($age)
    {
        if ($age < 16 || $age > 65) {
            throw new Exception("Invalid age.");
        }

        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }
}

class Teacher extends Person {
    private $salary;

    public function __construct($salary, $id = null, $name = null, $age = null)
    {
        $this->salary = $salary;
        parent::__construct($id, $name, $age);
    }

    public function setSalary($salary)
    {
        if ($salary < 0) {
            throw new Exception("invalid salary.");
        }

        $this->salary = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }
}

class Student extends Person {
    private $gpa;

    public function __construct($gpa, $id = null, $name = null, $age = null)
    {
        $this->gpa = $gpa;
        parent::__construct($id, $name, $age);
    }

    public function setGpa($gpa)
    {
        if ($gpa <= 60 && $gpa > 100) {
            throw new Exception("Invalid gpa");
        }

        $this->gpa = $gpa;
    }

    public function getGpa()
    {
        return $this->gpa;
    }
}

$std01 = new Student(85.9, "909010", "Ahmad Subhi Rabea Jeburini");
$teacher01 = new Teacher(3250, "304012", "Fadi Mohammed Hussan Hijazi");

echo "Student name: ", $std01->getName(), ", gpa: ", $std01->getGpa(), "\n";
echo "Teacher name: ", $teacher01->getName(), ", salary: ", $teacher01->getSalary(), "\n";


/**
 * Polymorphism is the ability of an object to take many forms,
 * more specifically, `Parent class` can be assigned  as one of its `Child classes`.
 */
if ($std01 instanceof Person) {

    echo "Is instance of Person!", "\n";
}
if ($std01 instanceof Teacher) {

    echo "Is instance of Teacher!", "\n";
}
if ($std01 instanceof Student) {

    echo "Is instance of Student!", "\n";
}
