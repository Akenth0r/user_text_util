<?php
require_once "./constants.php";
require_once "./src/tasks.php";
require_once "./src/filesystem.php";
require_once "./src/output.php";

# Handle input
# Arg count
if ($argc < 3)
{
    outHelp();
    exit();
}

# Get input values
$delimiter = $argv[1];
$task = $argv[2];

# Check for a delimiter existence
if (!array_key_exists($delimiter, DELIMITERS))
{
    outHelp();
    exit();
}
# Check for a task existence
if (!in_array($task, TASKS))
{
    outHelp();
    exit();
}

# Open csv
$csv = fopen(PEOPLE_FILEPATH, 'r');

# Calling task function
call_user_func(TASKS[$task], $csv, DELIMITERS[$delimiter]);

# Close csv
fclose($csv);

