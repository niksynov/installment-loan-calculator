# installment-loan-calculator
PHP package for installment loan calculation

## Installation:

`composer require niksynov/installment-loan-calculator`

## Usage:

Given total amount is `5000`, interest rate per month `9.63%` and number of payments is `36`
````
use NikSynov\InstallmentLoanCalculator\Calculator;

$payments = Calculator::calculate(5000, 9.63, 36)
````

Method will return array of 36 monthly payments with `month`, `beginningBalance`, `interest`, `principalRepayment`, `emi` and `endingBalance`:
````
array(36) {
  [0]=>
  object(NikSynov\InstallmentLoanCalculator\Payment)#4 (6) {
    ["month"]=>
    int(1)
    ["beginningBalance"]=>
    float(5000)
    ["interest"]=>
    float(481.5)
    ["principalRepayment"]=>
    float(18.25)
    ["emi"]=>
    float(499.75)
    ["endingBalance"]=>
    float(4981.75)
  }
...
  [35]=>
    object(NikSynov\InstallmentLoanCalculator\Payment)#38 (6) {
      ["month"]=>
      int(36)
      ["beginningBalance"]=>
      float(455.85)
      ["interest"]=>
      float(43.9)
      ["principalRepayment"]=>
      float(455.85)
      ["emi"]=>
      float(499.75)
      ["endingBalance"]=>
      float(0)
  }
}
````
