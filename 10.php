<?php
function print_pattern($symbol = '*', $row = 5)
{
    $pattern = '';
    for ($i = $row; $i >= 1; $i--) {
        for ($j = 1; $j <= $i; $j++) {
            $pattern .= $symbol;
        }
        $pattern .= " \n";
    }
    echo $pattern;
}

print_pattern('@', 10);
