<?php

$ukuran = 5;

for ($i = 1; $i <= $ukuran; $i++) {
    for ($j = 1; $j < $i; $j++) {
        echo "  ";
    }
    for ($j = $i; $j <= $ukuran; $j++) {
        echo "* ";
    }
    echo "\n";
}
