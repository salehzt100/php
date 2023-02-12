<?php

/** 01. Let's build a Chef attributes in procedural approach */
$chef01 = [
    'first_name' => 'Foo',
    'last_name' => 'Bar',
    'salary' => [
        'amount' => 3500,
        'currency' => '$'
    ],
    'is_active' => true,
    'alerts' => [
        'alert1' => false,
        'alert2' => false,
        'alert3' => false
    ]
];

$chef02 = [
    'first_name' => 'Ket',
    'last_name' => 'Foo',
    'salary' => [
        'amount' => 4000,
        'currency' => '$'
    ],
    'is_active' => true,
    'alerts' => [
        'alert1' => false,
        'alert2' => false,
        'alert3' => false
    ]
];

/** 02 Let's build a Chef behaviors/actions in procedural approach */
function assignNewAlert(& $chef)
{
    $alerts = ['alert1', 'alert2', 'alert3'];

    foreach ($alerts as $alert) {

        if ($chef['alerts'][$alert] === false) {

            $chef['alerts'][$alert] = true;
            $chef['salary']['amount'] -= 500;
            break;
        }
    }

    if ($chef['alerts']['alert3'] === true) {

        $chef['is_active'] = false;
    }

}

function yearlySalaryRaise(& $chef, $rate)
{
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

    $chef['salary']['amount'] += $raise;

    return $raise;
}

/** 03 Lets make changes on data based on behaviors in procedural approach */
echo "Chef 01 salary: ", $chef01['salary']['amount'], "\n";;
echo "Chef 02 salary: ", $chef02['salary']['amount'], "\n";;

yearlySalaryRaise($chef01, 'B');
yearlySalaryRaise($chef02, 'A');

echo "Chef 01 salary after raise: ", $chef01['salary']['amount'], "\n";;
echo "Chef 02 salary after raise: ", $chef02['salary']['amount'], "\n";;

assignNewAlert($chef01);
echo "Chef 01 salary after alert #1: ", $chef01['salary']['amount'], "\n";
