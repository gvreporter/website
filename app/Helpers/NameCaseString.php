<?php
namespace App\Helpers;

function name_case_string(string $input) {
    $words = preg_split('/ /', $input);

    foreach($words as $word) {
        $word = ucfirst($word);
    }

    return implode(' ', $words);
}
