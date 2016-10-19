<?php

/**
* Returns conditional probability of $A given $B and $Data.
* $Data is an indexed array.  Each element of the $Data array 
* consists of an A measurement and B measurment on a sample 
* item.
*/
function getConditionalProbabilty($A, $B, $Data) {
  $NumAB   = 0;
  $NumB    = 0;
  $NumData = count($Data);
  for ($i=0; $i < $NumData; $i++) {
    if (in_array($B, $Data[$i])) {
      $NumB++;
      if (in_array($A, $Data[$i])) {
        $NumAB++;
      }
    }
  }
  return $NumAB / $NumB;
}

?>
