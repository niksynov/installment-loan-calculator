<?php

namespace NikSynov\InstallmentLoanCalculator;

class Payment
{
    /**
     * @var int
     */
    public $month;

    /**
     * @var float
     */
    public $beginningBalance;

    /**
     * @var float
     */
    public $interest;

    /**
     * @var float
     */
    public $principalRepayment;

    /**
     * @var float
     */
    public $emi;

    /**
     * @var float
     */
    public $endingBalance;

    public static function create($month, $beginningBalance, $interest, $principalRepayment, $emi, $endingBalance)
    {
        $payment = new self();

        $payment->month = $month;
        $payment->beginningBalance = $beginningBalance;
        $payment->interest = $interest;
        $payment->principalRepayment = $principalRepayment;
        $payment->emi = $emi;
        $payment->endingBalance = $endingBalance;

        return $payment;
    }
}
