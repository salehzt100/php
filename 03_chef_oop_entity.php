<?php

/**
 * 04 Lets convert all `02_chef_procedural_entity` into OOP logic
 * You will learn (how to):
     * Write `Class` in PHP
     * Make a `Constructor`
        * `Constructor` is a special method in a class (magic method)
        * the PHP Compiler calling it to know how to make an instance (copy) of a class
        * in case the `Constructor` isn't defined, PHP will define a default one.
     * Write `Attributes` (variables inside a class)
     * Using `this` keyword
     * Write `Behaviors`/`Actions` (function inside a class)
     * Modifiers (public/protected/private)
        * determine the accessibility of attributes/methods
 * Note: Attributes & methods are case-insensitive
 */
class Chef {
    /** Chef class is the blueprint of all intended objects to be created. (هو المخطط لكل الكائنات التي ننوي انشائها لاحقا) */
    /**
     * attributes (all defined as private modifier, private means we can't access them from anywhere outside of class)
     */
    private $firstName;
    private $lastName;
    private $salary;
    private $alerts;
    private $is_active;

    /**
     * constructor (here we make the logic that the PHP Compiler will make the objects of `Chef Class`
     */
    public function __construct($first_name, $last_name, $salary_amount, $salary_currency)
    {
        $this->firstName = $first_name;
        $this->lastName = $last_name;
        $this->is_active = true;
        $this->salary = [
            'amount' => $salary_amount,
            'currency' => $salary_currency
        ];
        $this->alerts = [
            'alert1' => false,
            'alert2' => false,
            'alert3' => false
        ];
    }

    /**
     * Behaviors
     * all defined as public modifier (public means we can access attributes/methods from anywhere including outside of class)
     */
    public function assignNewAlert()
    {
        $alerts = ['alert1', 'alert2', 'alert3'];

        foreach ($alerts as $alert) {

            if ($this->alerts[$alert] === false) {

                $this->alerts[$alert] = true;
                $this->salary['amount'] -= 500;
                break;
            }
        }

        if ($this->alerts['alert3'] === true) {

            $this->is_active = false;
        }

    }

    public function yearlySalaryRaise($rate) {
        switch ($rate) {
            case 'A':
                $raise = 500;
                break;
            case 'B':
                $raise = 300;
                break;
            case 'C':
                $raise = 100;
                break;
            default:
                $raise = 0;
        }

        $this->salary['amount'] += $raise;

        return $raise;
    }

    public function getSalaryAmount()
    {
        return $this->salary['amount'];
    }
}

/** 05 Lets make objects & fill data  */
$chef01 = new Chef("Foo", "Bar", 3500, '$');
$chef02 = new Chef("Ket", "Foo", 4000, '$');

/** 06 Lets make changes */
echo "Chef 01 salary: ", $chef01->getSalaryAmount(), "\n";;
echo "Chef 02 salary: ", $chef02->getSalaryAmount(), "\n";;

$chef01->yearlySalaryRaise('B');
$chef02->yearlySalaryRaise('A');

echo "Chef 01 salary after raise: ", $chef01->getSalaryAmount(), "\n";;
echo "Chef 02 salary after raise: ", $chef02->getSalaryAmount(), "\n";;

$chef01->assignNewAlert();
echo "Chef 01 salary after alert #1: ", $chef01->getSalaryAmount(), "\n";


