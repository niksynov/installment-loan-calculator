<?php

namespace NikSynov\InstallmentLoanCalculator;

use InvalidArgumentException;

class Calculator
{
    /**
     * @param float $principalAmountBorrowed
     * @param float $monthlyInterestRate
     * @param int $numberOfPayments
     *
     * @return array|Payment[]
     */
    public static function calculate($principalAmountBorrowed, $monthlyInterestRate, $numberOfPayments)
    {
        if (!is_numeric($principalAmountBorrowed) || !is_numeric($monthlyInterestRate) || !is_int($numberOfPayments)) {
            throw new InvalidArgumentException('Invalid type of method argument');
        }

        $principalAmountBorrowed = floatval($principalAmountBorrowed);
        $monthlyInterestRate = floatval($monthlyInterestRate);

        if (0 >= $monthlyInterestRate) {
            throw new InvalidArgumentException('Interest rate must be greater than 0');
        }

        $monthlyInterestRate = $monthlyInterestRate / 100;

        $emi = $principalAmountBorrowed * ((pow(1 + $monthlyInterestRate, $numberOfPayments) * $monthlyInterestRate) / (pow(1 + $monthlyInterestRate, $numberOfPayments) - 1));

        $interest = $principalAmountBorrowed * $monthlyInterestRate;

        $principalRepayment = $emi - $interest;

        $beginningBalance = $principalAmountBorrowed;

        $endingBalance = $beginningBalance - $principalRepayment;

        $payments = [];

        $payments[] = Payment::create(
            1,
            self::floatNumber($beginningBalance),
            self::floatNumber($interest),
            self::floatNumber($principalRepayment),
            self::floatNumber($emi),
            self::floatNumber($endingBalance)
        );

        $month = 2;

        for ($i = 1; $i < $numberOfPayments; $i++) {
            $beginningBalance = $endingBalance;
            $interest = $beginningBalance * $monthlyInterestRate;
            $principalRepayment = $emi - $interest;
            $endingBalance = $beginningBalance - $principalRepayment;

            $payments[$i] = Payment::create(
                $month,
                self::floatNumber($beginningBalance),
                self::floatNumber($interest),
                self::floatNumber($principalRepayment),
                self::floatNumber($emi),
                self::floatNumber($endingBalance)
            );

            $month++;
        }

        return $payments;
    }

    private static function floatNumber($number)
    {
        return (float)number_format((float)$number, 2, '.', '');
    }
}
