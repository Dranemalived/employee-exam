<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Multiples extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function getSumOfMultiples()
    {
        $answer = 0;

        for ($i = 1; $i < 1000; $i++) {
            if ($i % 3 == 0 || $i % 5 == 0) {
                $answer += $i;
            }
        }

        echo $answer;
    }

    public function getFibonacciSumOfEvenValues()
    {
        $num1 = 1;
        $num2 = 2;
        $num3 = 0;
        $even = [$num2];

        do {
            $num3 = $num2 + $num1;

            if ($num3 % 2 == 0) {
                array_push($even, $num3);
            }
            $num1 = $num2;
            $num2 = $num3;
        } while (($num3) < 4000000);

        echo "<pre>";
        var_dump($even);
        echo "</pre>";

        $sum = 0;
        for ($i = 0; $i < count($even); $i++) {
            $sum += $even[$i];
        }

        echo $sum;
    }
}
