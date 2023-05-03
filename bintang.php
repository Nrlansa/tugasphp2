<?php
function print_pattern($symbol = '*', $row = 5)
{
    $pattern = '';
    for ($i = 1; $i <= $row; $i++) {
        // Cetak spasi sebanyak $row - $i
        for ($j = 1; $j <= $row - $i; $j++) {
            $pattern .= ' ';
        }
        // Cetak symbol sebanyak $i
        for ($j = 1; $j <= $i; $j++) {
            $pattern .= $symbol;
        }
        $pattern .= "\n";
    }
    echo $pattern;
}

// Contoh pemanggilan fungsi
print_pattern();
print_pattern('#', 3);
print_pattern('$', 7);
