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
        $incomeSource = ReceiveAlphabaticValue('Enter Income Source');

        if ($data['income'][$incomeSource] = $incomeAmount) {
            $fileSystem->WriteData($data, $type = 'income');
            $fileSystem->RunTotalCalculation();
            echo 'Income Added Successfully' . "\n";
            echo SEPARATOR . "\n\n";
        }
    } elseif ('2' === $menuInput) {
        $expenseAmount = ReceiveNumericValue('Enter The Amount');
        $expenseSource = ReceiveAlphabaticValue('Enter Expense Source');

        if ($data['expense'][$expenseSource] = $expenseAmount) {
            $fileSystem->WriteData($data, $type = 'expense');
            $fileSystem->RunTotalCalculation();
            echo 'Expense Added Successfully' . "\n";
            echo SEPARATOR . "\n\n";
        }
    } elseif ('3' === $menuInput) {
        $income = $fileSystem->ReadData()['income'];

        echo SEPARATOR;
        echo "List Of Your Income \n";
        echo SEPARATOR;

        $n = 0;
        foreach ($income as $source => $amount) {
            $n++;
            echo "{$n}. {$source} = {$amount} \n";
        }
    } elseif ('4' === $menuInput) {
        $expense = $fileSystem->ReadData()['expense'];

        echo SEPARATOR;
        echo "List Of Your Expense \n";
        echo SEPARATOR;

        $n = 0;
        foreach ($expense as $source => $amount) {
            $n++;
            echo "{$n}. {$source} = {$amount} \n";
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
    } elseif ('6' === $menuInput) {
        $expense = $fileSystem->ReadData()['expense'];
        $income = $fileSystem->ReadData()['income'];

        echo "\n";
        echo SEPARATOR ;
        echo "List Of Your Income Sources \n";
        echo SEPARATOR;

        $incomeSources = array_keys($income);
        foreach ($incomeSources as $index => $sourceName){
            echo $index+1 . ". {$sourceName} \n";
        }

        echo "\n\n";

        echo SEPARATOR;
        echo "List Of Your Expense Sources \n";
        echo SEPARATOR;

        $expensSources = array_keys($expense);
        foreach ($expensSources as $index => $sourceName) {
            echo $index + 1 . ". {$sourceName} \n";
        }
        
    }

    echo "\n\n";
    $viewMenu = ReceiveYesOrNoValue('Go To Menu ? (y/n)');
    if ('n' == $viewMenu) {
        break;
    } else {
        continue;
    }
}
