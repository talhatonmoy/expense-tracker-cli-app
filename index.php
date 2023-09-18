#!/usr/bin/env php
<?php

require_once './functions.php';

$data = [
    'income' => [],
    'expense' => [],
    'total' => ''
];



$fileSystem = new ET_FileSystem();
while (true) {
    $menuInput = RunMenu();


    if ('1' === $menuInput) {

        $incomeAmount = ReceiveNumericValue('Enter The Amount');

        if (array_push($data['income'], $incomeAmount)) {
            $fileSystem->WriteData($data, $type = 'income');
            $fileSystem->RunTotalCalculation();
            echo 'Income Added Successfully' . "\n";
            $data['income'] = [];
            echo SEPARATOR . "\n\n";
        }
    } elseif ('2' === $menuInput) {
        $expenseAmount = ReceiveNumericValue('Enter The Amount');

        if (array_push($data['expense'], $expenseAmount)) {
            $fileSystem->WriteData($data, $type = 'expense');
            $fileSystem->RunTotalCalculation();
            echo 'Expense Added Successfully' . "\n";
            $data['expense'] = [];
            echo SEPARATOR . "\n\n";
        }
    } elseif ('3' === $menuInput) {
        $income = $fileSystem->ReadData()['income'];

        echo SEPARATOR;
        echo "List Of Your Income \n";
        echo SEPARATOR;

        foreach ($income as $key => $value) {
            echo $key + 1 . " " . $value . "\n";
        }
    } elseif ('4' === $menuInput) {
        $expense = $fileSystem->ReadData()['expense'];

        echo SEPARATOR;
        echo "List Of Your Expense \n";
        echo SEPARATOR;

        foreach ($expense as $key => $value) {
            echo $key + 1 . " " . $value . "\n";
        }
    } elseif ('5' === $menuInput) {
        $calculate = new Calculator();

        $expense = $fileSystem->ReadData()['expense'];
        $totalExpense = $calculate->add($expense);

        $income = $fileSystem->ReadData()['income'];
        $totalIncome = $calculate->add($income);

        $net = $fileSystem->ReadData()['total'];

        echo SEPARATOR;
        echo "Summery \n";
        echo SEPARATOR;

        echo "01 Your Total Income  = {$totalIncome} \n";
        echo "02 Your Total Expense = {$totalExpense} \n";
        echo "03 Net                = {$net}\n";
    }

    echo SEPARATOR . "\n\n";
    // $viewMenu = readline('Go To Menu ? (y/n) :');
    $viewMenu = ReceiveYesOrNoValue('Go To Menu ? (y/n)');
    if ('n' == $viewMenu) {
        break;
    } else {
        continue;
    }
}
