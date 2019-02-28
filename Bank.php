<?php

require("./User.php");
require("./Transaction.php");
require("./MathAoa.php");

class Bank {

	private $mysqli;

	public function __construct() {
		$this->users = array();
		$this->transactions = array();
	}

	public function randomize() {

		for($i = 0; $i < 5; $i++) {
			$user = new User();
			$user->id = $i + 1;
			$user->randomizeName();
			$user->randomizeBirthDate("1930-01-01", "2000-01-01");

			array_push($this->users, (array) $user);

			$startDate = "2018-01-01";

			for($j = 0; $j < 180; $j++) {
				$transaction = new Transaction();

				$transaction->id = $user->id * ($j + 2);
				$transaction->user_id = $user->id;
				$transaction->date = date_format(date_add(date_create($startDate), date_interval_create_from_date_string("1 days")), "Y-m-d");
				$startDate = $transaction->date;
				$transaction->randomizeDeposit(0, 10000);
				$transaction->randomizeWithdraw(0, 10000);

				array_push($this->transactions, (array) $transaction);
			}
		}

	}

	public function balance() {

		//$this->users = mysqli_get("users", );
		if(!is_array($this->users)) return array();

		$usersLength = sizeof($this->users);

		for($i = 0; $i < $usersLength; $i++) {

			$user = $this->users[$i];

			$userTransations = $this->groupTransactionsByUserId($user["id"]);
			//$userTransations = mysqli_get("transactions", where user_id = $user["id"]);

			$plus = MathAoa::getSumByField($userTransations, "deposit");
			$minus = MathAoa::getSumByField($userTransations, "withdraw");

			$this->users[$i]["balance"] = $plus - $minus;
		}

		print_r($this->users);
	}

	public function transactions() {
		/*$this->$users = mysqli_get("users", );
		$this->$usersLength = sizeof($users);
		$transations = mysqli_get("transations", );*/

		$this->joinUsersTransactions();

		print_r($this->transactions);
	}

	public function dailyTransactions($month = 1) {
		/*$this->$users = mysqli_get("users", );
		$this->$transations = mysqli_get("transations", where date = "'2018-' . $month . '-%''");*/

		$this->joinUsersTransactions();

		print_r($this->transations);
	}

	public function negativeBalance() {


	}


	private function joinUsersTransactions() {

		if(!is_array($this->users)) return array();
		if(!is_array($this->transactions)) return array();

		$usersLength = sizeof($this->users);

		$transactionsLength = sizeof($this->transactions);

		for($i = 0; $i < $usersLength; $i++) {

			$user = $this->users[$i];

			if(!is_array($user)) continue;

			for($j = 0; $j < $transactionsLength; $j++) {
				$row = $this->transactions[$j];

				if(!is_array($row)) continue;
				if(!isset($row["user_id"])) continue;

				if(intval($row["user_id"]) == intval($user["id"])) {
					$this->transactions[$j]["name"] = isset($user["name"]) ? $user["name"] : "";
					$this->transactions[$j]["birth_date"] = isset($user["birth_date"]) ? $user["birth_date"] : "";
				}
			}
		}
	}

	private function groupTransactionsByUserId($user_id) {
		if(!isset($user_id)) return array();
		if(!is_array($this->transactions)) return array();

		$user_id = intval($user_id);

		$transationsLength = sizeof($this->transactions);

		$group = array();

		for($i = 0; $i < $transationsLength; $i++) {
			$row = $this->transactions[$i];

			if(!is_array($row)) continue;
			if(!isset($row["user_id"])) continue;

			if(intval($row["user_id"]) == $user_id) {
				array_push($group, $row);
			}
		}

		return $group;
	}

}

/*$test = new Bank();
$test->randomize();
$test->balance();
$test->transactions();
$test->dailyTransactions();
*/
