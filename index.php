<?php

$x = 96 ;
$x = 69;

const Hi ='Hello';

define('Paid', 'paid');
echo "Hello World <br/>";
echo Hi.' I '.Paid." $x <br/>";

function sum($x, $y){
    return $x + $y;
}

echo "Sum:".sum(69,88)."<br/>";

$Add = sum(60,9)."<br/>";

echo $Add;

$isComplete = 0;

if ($isComplete){
    echo "TRUE";
}
else{
    echo "FALSE";
}

?>


