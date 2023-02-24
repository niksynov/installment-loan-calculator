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
    public $principal;

    /**
     * @var float
     */
    public $emi;

    /**
     * @var float
     */
    public $endingBalance;

    public static function create($month, $beginningBalance, $interest, $principal, $emi, $endingBalance)
    {
        $payment = new self();

        $payment->month = $month;
        $payment->beginningBalance = $beginningBalance;
        $payment->interest = $interest;
        $payment->principal = $principal;
        $payment->emi = $emi;
        $payment->endingBalance = $endingBalance;

        return $payment;
    }
}
