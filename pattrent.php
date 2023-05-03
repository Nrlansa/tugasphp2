<?php
function print_pattern($symbol = '*', $row = 5)
{
    $pattern = '';
    for ($i = 1; $i <= $row; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            $pattern .= $symbol;
        }
        $pattern .= "\n";
    }
    echo $pattern;
}

print_pattern('$', 6);
