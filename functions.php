<?php

define('SEPARATOR', "---------------------\n");

/**
 * Expense Tracker File System -> ET
 */
class ET_FileSystem extends Calculator
{
    private $file_name = '/Users/mdabutalhatonmoy/Laravel Career Path/week 1/expense-cli-app/data/data.txt';

    public function ReadData()
    {
        $data = unserialize(file_get_contents($this->file_name));
        return $data;
    }


    public function WriteData($new_data, $type = 'income')
    {

        $existing_data = $this->ReadData();

        if (!$existing_data) {
            file_put_contents($this->file_name, serialize($new_data));
        } else {
            // $existing_data[$type] = $new_data[$type];
            $total = array_merge($existing_data[$type], $new_data[$type]);
            $existing_data[$type] = $total;
            file_put_contents($this->file_name, serialize($existing_data));
        }
    }

    public function RunTotalCalculation()
    {
        $existing_data = $this->ReadData();

        if ($existing_data) {
            $totalIncome = $this->add($existing_data['income']);
            $totalExpense = $this->add($existing_data['expense']);

            $net = $totalIncome - $totalExpense;

            $existing_data['total'] = $net;
            file_put_contents($this->file_name, serialize($existing_data));
        }
    }
}


/**
 * Calculator
 */

class Calculator
{

    public function add(array $amounts): int
    {
        $total = 0;

        foreach ($amounts as $key =>  $amount) {
            $total +=  intval($amount);
        }
        return $total;
    }
}



function RunMenu()
{
    $menuItems = [
        '1' => 'Add income',
        '2' => 'Add Expense',
        '3' => 'View income',
        '4' => 'View expense',
        '5' => 'View total',
        '6' => 'View categories'
    ];
    echo SEPARATOR;
    echo "What Do You Want? \n";
    echo SEPARATOR;

    foreach ($menuItems as $key => $item) {
        echo $key . ". " . $item . " \n";
    }

    echo SEPARATOR;
    return $userInput = readline('Enter Your Option Number: ');
    echo SEPARATOR . "\n\n";
}



function ReceiveNumericValue($promt)
{
    while (true) {
        $amount = readline("{$promt}: ");
        // echo SEPARATOR;
        if (!is_numeric($amount)) {
            echo 'Please Input A Numeric Data' . "\n";
            echo SEPARATOR;
        } else {
            break;
        }
    }

    return $amount;
}

function ReceiveYesOrNoValue($promt)
{
    while (true) {
        $inputValue = readline("{$promt}: ");
        echo SEPARATOR;
        if (!preg_match('/^[yn]$/', $inputValue)) {
            echo 'Please Input A Valid Option Parameter ( y/n )' . "\n";
            echo SEPARATOR;
        } else {
            break;
        }
    }

    return $inputValue;
}


function ReceiveAlphabaticValue($promt)
{
    while (true) {
        $inputValue = readline("{$promt}: ");
        echo SEPARATOR;
        $pattern = '/^[a-zA-Z0-9\s]+$/';

        if (!preg_match($pattern, $inputValue)) {
            echo 'Please Input A Valid Source' . "\n";
            echo SEPARATOR;
        } else {
            break;
        }
    }

    return $inputValue;
}
