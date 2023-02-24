# installment-loan-calculator
PHP package for installment loan calculation

## Installation:

`composer require niksynov/installment-loan-calculator`

## Usage:

Given total amount is `100000`, interest rate per month is `0.5%` and number of payments is `36`
````
use NikSynov\InstallmentLoanCalculator\Calculator;

$payments = Calculator::calculate(100000, 0.5, 36)
````

Method will return array of 36 monthly payments with `month`, `beginningBalance`, `interest`, `principal`, `emi` and `endingBalance`:
````
array(36) {
  [0]=>
  object(NikSynov\InstallmentLoanCalculator\Payment)#4 (6) {
    ["month"]=>
    int(1)
    ["beginningBalance"]=>
    loat(100000)
    ["interest"]=>
    float(500)
    ["principal"]=>
    float(2542.19)
    ["emi"]=>
    float(3042.19)
    ["endingBalance"]=>
    float(97457.81)
  }
...
  [35]=>
    object(NikSynov\InstallmentLoanCalculator\Payment)#38 (6) {
      ["month"]=>
      int(36)
      ["beginningBalance"]=>
      float(3027.06)
      ["interest"]=>
      float(15.14)
      ["principal"]=>
      float(3027.06)
      ["emi"]=>
      float(3042.19)
      ["endingBalance"]=>
      float(0)
  }
}
````

## Useful links
- [How EMI is calculated](https://corporatefinanceinstitute.com/resources/commercial-lending/equated-monthly-installment-emi/)
