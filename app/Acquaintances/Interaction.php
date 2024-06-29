<?php

namespace App\Acquaintances;

use Multicaret\Acquaintances\Interaction as BaseInteraction;

class Interaction extends BaseInteraction
{
    public static function numberToReadable($number, $precision = 1, $divisors = null, $base = 10000): string
    {
        $shorthand = '';
        $divisor = pow($base, 0);

        if (!isset($divisors)) {
            $divisors = [
                $divisor => $shorthand,
                pow($base, 0) => '',
                pow($base, 1) => '萬',
                pow($base, 2) => '億',
                pow($base, 3) => '兆',
                pow($base, 4) => '京',
            ];
        }

        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * $base)) {
                break;
            }
        }

        if (1 === $divisor) {
            $precision = 0;
        }

        return number_format($number / $divisor, $precision) . $shorthand;
    }
}
