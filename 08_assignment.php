<?php

/**
 * simulate restaurant system
 */
class CounterHelper {
    private static $counter = 0;

    public static function regester()
    {
        return ++self::$counter;
    }
}
//quot

class Meal {

    public $name;
    public $price;


    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}

class Customer {

    private $id;

    public $firstName;
    public $surname;

    public function __construct($first_name, $surname)
    {
        $this->id = "CTM-" .  CounterHelper::getNextCount();
        $this->firstName = $first_name;
        $this->surname = $surname;
    }

    public function getId() {
        return $this->id;
    }
}

class Order {

    private $tableNumber;
    private $customer;
    private $meals;
    private $status;

    public function __construct($table_number, $customer)
    {
        $this->tableNumber = $table_number;

        if (! $customer instanceof Customer) {
            throw new Exception("`customer` argument should be instance of Customer");
        }

        $this->customer = $customer;
        $this->status = Status::PROCESSING;
        $this->meals = [];
    }

    public function addItemToOrder($meal) {

        if (! $meal instanceof Meal) {
            throw new Exception("`meal` argument should be instance of Meal");
        }

        $this->meals[] = $meal;
    }

    public function processOrder() {
        $this->status = Status::RECEIVED;
    }

    public function deliverOrder() {
        $this->status = Status::DELIVERED;
    }

    public function showTheBill() {
        $items = [];
        $total = 0;

        $customerId = $this->customer->getId();
        $customer_surname = $this->customer->surname;
        echo "Mr.{$customer_surname} ({$customerId}) bill, The items are:", "\n";

        foreach ($this->meals as $meal) {

            echo "- ", $meal->name, "\n";
            $total += $meal->price;
        }

        echo "Total are ", $total, "\n";
    }

    public function paidOrder()
    {
        $this->status = Status::PAID;
    }
}

class Status {
    CONST PROCESSING = 'processing';
    CONST RECEIVED = 'received';
    CONST DELIVERED = 'delivered';
    CONST PAID = 'paid';
}


$burger = new Meal('Burger', 50);
$crispy = new Meal("Crispy", 100);

$fadi = new Customer("Fadi", "Hijazi");
$ahmad = new Customer("Ahmad", "Shami");

$order01 = new Order(1, $fadi);

$order01->addItemToOrder($burger);
$order01->paidOrder();

$order02 = new Order(2, $ahmad);

$order02->addItemToOrder($burger);
$order02->addItemToOrder($crispy);
$order02->paidOrder();

$order01->showTheBill();
$order02->showTheBill(); //version