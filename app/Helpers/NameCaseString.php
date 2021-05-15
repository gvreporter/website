<?php
namespace App\Helpers;

function name_case_string(string $input) {
    $words = preg_split('/ /', $input);

    for($i = 0; $i < count($words); $i++) {
        $words[$i] = ucfirst(strtolower($words[$i]));
    }

    return implode(' ', $words);
}
