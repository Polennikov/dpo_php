<?php
function callback($Row)
{
    preg_match('/[0-9]+/',$Row[0],$outRow);
    return '\''. ($outRow[0]*2). '\'';
}
$file_name='input.txt';
$Row = file_get_contents($file_name);
$pattern='/\'[0-9]+\'/';
$Row_result = preg_replace_callback($pattern, callback, $Row);
echo $Row_result;