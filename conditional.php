<?php
function print_pattern($func_name)
{
    if ($func_name == 'pattern1') {
        echo "nama\nsaya";
    } elseif ($func_name == 'pattern2') {
        echo "nurul\nannisa";
    } elseif ($func_name == 'pattern3') {
        echo "halo";
    } else {
        echo "Pattern tidak ditemukan.";
    }
}

print_pattern('pattern1');
print_pattern('pattern2');
print_pattern('pattern3');
print_pattern('pattern4');
