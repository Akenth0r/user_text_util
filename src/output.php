<?php

function outHelp()
{
    print("\nUse: php process_text.php {comma|semicolon} {task_name}\n");
    print("Task names:\n");
    foreach (TASKS as $task_name => $func_name)
    {
        print("{$task_name}\n");
    }
}

function outError()
{
    print("\nError: " . PEOPLE_FILEPATH . " is wrong or wrong delimiter was selected.\n");
}