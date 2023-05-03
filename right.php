<?php

$ukuran = 5;

for ($i = 1; $i <= $ukuran; $i++) {
    for ($j = 1; $j <= $ukuran - $i; $j++) {
        echo "  ";
    }
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "\n";
}
