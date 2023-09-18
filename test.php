<?php

// $data = [
//     'income' => [],
//     'expense' => [],
//     'total' => ''
// ];


// $data['income']['gift'] = 50;

$Old_data = [
    'income' => [
        'baba' => 700,
        'abbu' => 900,
        'work' => 200
    ],
    'expense' => [],
    'total' => ''
];

$New_data = [
    'income' => [
        'gift' => 50,
        'client' => 300,
    ],
    'expense' => [],
    'total' => ''
];

// $data = array_merge($Old_data['income'], $New_data['income']);
$data = array_merge($New_data['income'], $Old_data['income']);

print_r($data);