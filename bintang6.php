<?php
function print_pattern($symbol = '*', $row = 5)
{
    for ($i = $row; $i >= 1; $i--) {
        if ($i === 1) {
            continue;
        }
        for ($j = $row; $j > $i; $j--) {
            echo '  ';
        }
        for ($k = 1; $k <= $i; $k++) {
            echo $symbol . ' ';
        }
        echo PHP_EOL;
    }
}


print_pattern('*', 6);
