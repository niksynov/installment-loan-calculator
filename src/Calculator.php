<?php

namespace NikSynov\InstallmentLoanCalculator;

use InvalidArgumentException;

class Calculator
{
    /**
     * @param float $loanAmount
     * @param float $monthlyInterestRate
     * @param int $numberOfPayments
     *
     * @return array|Payment[]
     */
    public static function calculate($loanAmount, $monthlyInterestRate, $numberOfPayments)
    {
        if (!is_numeric($loanAmount) || !is_numeric($monthlyInterestRate) || !is_int($numberOfPayments)) {
            throw new InvalidArgumentException('Invalid type of method argument');
        }

        $loanAmount = floatval($loanAmount);
        $monthlyInterestRate = floatval($monthlyInterestRate);

        if (0 >= $monthlyInterestRate) {
            throw new InvalidArgumentException('Interest rate must be greater than 0');
        }

        if (0 >= $loanAmount) {
            throw new InvalidArgumentException('Total amount must be greater than 0');
        }

        if (0 >= $numberOfPayments) {
            throw new InvalidArgumentException('Number of payments must be greater than 0');
        }

        $monthlyInterestRate = $monthlyInterestRate / 100;

        $emi = $loanAmount * ((pow(1 + $monthlyInterestRate, $numberOfPayments) * $monthlyInterestRate) / (pow(1 + $monthlyInterestRate, $numberOfPayments) - 1));

        $interest = $loanAmount * $monthlyInterestRate;

        $principalRepayment = $emi - $interest;

        $beginningBalance = $loanAmount;

        $endingBalance = $beginningBalance - $principalRepayment;

        $payments = [];

        $month = 1;

        $payments[] = Payment::create(
            $month,
            self::floatNumber($beginningBalance),
            self::floatNumber($interest),
            self::floatNumber($principalRepayment),
            self::floatNumber($emi),
            self::floatNumber($endingBalance)
        );

        for ($i = 1; $i < $numberOfPayments; $i++) {
            $month++;
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
        }

        return $payments;
    }

    /**
     * @param $number
     *
     * @return float
     */
    private static function floatNumber($number)
    {
        return (float)number_format((float)$number, 2, '.', '');
    }
}
