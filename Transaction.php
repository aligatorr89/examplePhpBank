<?php

require_once("./Randomize.php");

/**
 * @property int $user_id
 * @property string $date
 * @property float $deposit
 * @property float $withdraw
 */

interface ITransaction {

}

class Transaction implements ITransaction {

  public function __construct($id = "", $user_id = "", $date = "", $deposit = "", $withdraw = "") {
		$this->id = $id;
		$this->user_id = $user_id;
		$this->date = $date;
		$this->deposit = $deposit;
		$this->withdraw = $withdraw;
	}

  public function randomizeDeposit($min, $max) {
    $min = $min < 0 ? 0 : $min;
    $max = $max < 0 ? 0 : $max;
    $this->deposit = Randomize::floatFromTo($min, $max, 2);
  }

  public function randomizeWithdraw($min, $max) {
    $min = $min < 0 ? 0 : $min;
    $max = $max < 0 ? 0 : $max;
    $this->withdraw = Randomize::floatFromTo($min, $max, 2);
  }
}
