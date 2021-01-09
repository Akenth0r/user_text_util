<?php
$DELIMITERS = [
    'comma' => ',',
    'semicolon' => ';',
];

define('DELIMITERS', $DELIMITERS);
define('PEOPLE_FILEPATH', 'people.csv');
define('TEXTS_DIRPATH', 'texts');
define('OUTPUT_TEXTS_DIRPATH', 'output_texts');
define('PEOPLE_COLUMN_COUNT', 2);

$TASKS = [
    'countAverageLineCount' => 'countAverageLineCount',
    'replaceDates' => 'replaceDates',
];
define("TASKS", $TASKS);
