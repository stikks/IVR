<?php

require "condition.php";

/**
* The elements of the $Data array use this coding convention:
*
* +cancer – patient has cancer
* -cancer – patient does not have cancer
* +test   – patient tested positive on cancer test
* -test   – patient tested negative on cancer test
*/

$Data[0] = array("+cancer", "+test");
$Data[1] = array("-cancer", "-test");
$Data[2] = array("+cancer", "+test");
$Data[3] = array("-cancer", "-test");

// specify query variable $A and conditioning variable $B
$A = "+cancer";
$B = "test";

// compute the conditional probability of having cancer given 1) 
// a positive test and 2) a sample of covariation data
$probability = getConditionalProbabilty($A, $B, $Data);

echo "P($A|$B) = $probability";

// P(+cancer|+test) = 0.66666666666667

?>
