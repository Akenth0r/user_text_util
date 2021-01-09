<?php

# Generator for people.csv reading
function getUsersFromCSV($handle, $delimiter)
{
    while ($user = fgetcsv($handle, 0, $delimiter))
    {
        // If column count is not 2, then wrong file or wrong delimiter used
        if (count($user) != PEOPLE_COLUMN_COUNT)
        {
            outError();
            exit(-1);
        }
        if ($user[0] == null)
            continue;
        yield $user;
    }
}


# Getting files from $dirpath which match regex pattern with user id
function getUserDirFiles($dirpath, $userID)
{
    $files = scandir($dirpath);
    return preg_grep("/{$userID}-\d{1,4}.txt$/", $files);
}