<?php
require_once "./src/filesystem.php";

# Tasks
function countAverageLineCount($handle, $delimiter)
{
    $users = getUsersFromCSV($handle, $delimiter);
    foreach ($users as $user)
    {
        # Getting file list
        $userFiles = getUserDirFiles(TEXTS_DIRPATH, $user[0]);

        $lineCount = 0;
        $fileCount = count($userFiles);
        # Process each file
        foreach($userFiles as $userFile)
        {
            $fileHandler = fopen(TEXTS_DIRPATH . "/{$userFile}", 'r');
            while (!feof($fileHandler))
            {
                fgets($fileHandler);
                $lineCount++;
            }
            fclose($fileHandler);
        }
        $avg = $lineCount == 0 || $fileCount == 0 ? 0 : $lineCount / $fileCount;
        print("$user[1] : avg is $avg lines\n");
    }
}


function replaceDates($handle, $delimiter)
{
    $users = getUsersFromCSV($handle, $delimiter);
    foreach ($users as $user)
    {
        $userFiles = getUserDirFiles(TEXTS_DIRPATH, $user[0]);
        foreach ($userFiles as $userFile)
        {
            # Open files
            $inputFile = fopen(TEXTS_DIRPATH . "/$userFile", 'r');
            $outputFile = fopen( OUTPUT_TEXTS_DIRPATH . "/$userFile", 'w+');
            $replaceCount = 0;

            # Process
            while (!feof($inputFile))
            {
                $line = fgets($inputFile);
                $matches = array();
                if (preg_match('/\d{2}\/\d{2}\/\d{2}/', $line, $matches,PREG_OFFSET_CAPTURE))
                {
                    $replaceCount += count($matches);
                    foreach ($matches as $match)
                    {
                        # Reformat
                        $match[0] = implode('-', explode('/', $match[0]));
                        # Replace
                        $line = substr_replace($line, $match[0], $match[1], strlen($match[0]));
                    }
                }
                fputs($outputFile, $line);
            }


            # Close files
            fclose($inputFile);
            fclose($outputFile);
        }
        print("$user[1] : $replaceCount replaces\n");
    }
}
