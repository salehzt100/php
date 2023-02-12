<?php

/**
 * Static
    * We have two types of `Static`
    * One is `Static Attributes`
    * The other is `Static Methods`
 *
 * `Static Attributes` is the attribute that its value are share between all objects, all objects have the same value of the static attribute
 * & any update of the value from any object, the value of attribute will update for all objects,
 * & we can access it immediately by class without needed to create object.
 *
 * `Static Method` is a method that is shared for all objects,
 * & we can access it immediately by a class,
 * & can't use any none-static attribute inside it.
 */

class System {
    public $foo;
    private static $count;

    public function register($person) {
        // register person logic ..
        self::$count++;
    }

    public static function getCount()
    {
        return self::$count;
    }
}

$system = new System();
$system->register("Foo");
$system->register("Bar");
$system->register("Xyz");

$system2 = new System();
$system2->register("Loo");

echo $system2->getCount(), "\n";
echo System::getCount(), "\n";

/**
 * Constants are set of immutable attributes that their values can not be changed after assigned,
 * We are using constants when we have constant values,
 * Constants means:
    * it cannot be change once its declared
    * constants are case-sensitive
    * the preferred way of naming constants, is naming it in uppercase letters.
 */
class SystemRoles {

    CONST CUSTOMER_ROLE = "customer";
    CONST EMPLOYEE_ROLE = "employee";
    CONST MANAGER_ROLES = "manager";
}


echo SystemRoles::CUSTOMER_ROLE;