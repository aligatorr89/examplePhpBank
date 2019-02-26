<?php

//$mysqli = mysqli_connect("172.17.0.2", "root", "");

class User {
	public function __construct() {
		$this-> id = null;
		$this-> name = null;
		$this -> birth_date = null;
	}
}

class Transactions {
	public function __construct() {
		$this-> id = null;
		$this-> user_id = null;
		$this -> date = null;
		$this -> deposit = null;
		$this -> withdraw = null;
	}
}

class MathAoa {
	public static function getSumByField($aoa, $field) {

		$sum = 0;

		if(!is_array($aoa)) return $sum;

		$aoaLength = sizeof($aoa);

		for($i = 0; $i < $aoaLength; $i++) {

			$row = $aoa[$i];

			if(!is_array($row)) continue;

			print_r($row[$field]);

			if(isset($row[$field])) {
				$sum += floatval($row[$field]);
			}
		}

		return $sum;
	}
}


class Bank {

	private $mysqli;

	public function __construct() {
		$this->name = "Banka Slovenije";

		$this->mysqli = new mysqli('mysql:3306', 'root', '', 'bank');

		$this->users = array(
			0 => array("id" => 1, "name" => "Rok", "birth_date" => "1989-06-30"),
			1 => array("id" => 2, "name" => "Benjamin", "birth_date" => "1990-02-10")
		);

		$this->transactions = array(
			0 => array("id" => 1, "user_id" => "1", "date" => "2018-01-01", "deposit" => "102", "withdraw" => "0"),
			1 => array("id" => 2, "user_id" => "1", "date" => "2018-01-11", "deposit" => "0", "withdraw" => "110"),
			2 => array("id" => 3, "user_id" => "1", "date" => "2018-01-15", "deposit" => "170", "withdraw" => "0"),
			3 => array("id" => 4, "user_id" => "2", "date" => "2018-01-18", "deposit" => "190", "withdraw" => "0"),
			4 => array("id" => 5, "user_id" => "2", "date" => "2018-01-25", "deposit" => "", "withdraw" => "190"),
			5 => array("id" => 6, "user_id" => "1", "date" => "2018-01-18", "deposit" => "190", "withdraw" => "0"),
			6 => array("id" => 7, "user_id" => "1", "date" => "2018-01-25", "deposit" => "", "withdraw" => "190")
		);
	}

	public function randomize() {

	}

	public function balance() {

		//$this->users = mysqli_get("users", );

		$usersLength = sizeof($this->users);

		for($i = 0; $i < $usersLength; $i++) {

			$user = $this->users[$i];

			$userTransations = $this->groupTransactionsByUser($user);
			//$userTransations = mysqli_get("transactions", where user_id = $user["id"]);

			$plus = MathAoa::getSumByField($userTransations, "deposit");
			$minus = MathAoa::getSumByField($userTransations, "withdraw");

			print_r($plus);

			$this->users[$i]["balance"] = $plus - $minus;
		}

		print_r($this->users);
	}

	public function transactions() {
		/*$this->$users = mysqli_get("users", );
		$this->$usersLength = sizeof($users);

		$transations = mysqli_get("transations", );*/

		$this->joinUsersTransactions();

		print_r($transations);
	}

	public function dailyTransactions($month = 1) {
		/*$this->$users = mysqli_get("users", );
		$this->$transations = mysqli_get("transations", where date = "'2018-' . $month . '-%''");*/

		$this->joinUsersTransactions();

		print_r($transations);
	}

	public function negativeBalance() {

	}


	private function joinUsersTransactions() {

		if(!is_array($this->$users)) return array();
		if(!is_array($this->$transations)) return array();

		$usersLength = sizeof($this->$users);

		$transationsLength = sizeof($this->$transations);

		for($i = 0; $i < $usersLength; $i++) {

			$user = $this->$users[$i];

			if(!is_array($user)) continue;

			if(!isset($user["name"])) continue;
			if(!isset($user["birth_date"])) continue;

			for($j = 0; $j < $transationsLength; $j++) {
				$row = $this->$transations[$j];

				if(!is_array($row)) continue;
				if(!isset($row["user_id"])) continue;

				if($row["user_id"] === $user["id"]) {
					$row["name"] = $user["name"];
					$row["birth_date"] = $user["birth_date"];
				}
			}
		}
	}

	private function groupTransactionsByUser($user) {
		if(!is_array($user)) return array();
		if(!is_array($this->$transactions)) return array();

		$transationsLength = sizeof($this->$transactions);
		$group = array();

		for($i = 0; $i < $transationsLength; $i++) {
			$row = $this->$transactions[$i];
			if(!is_array($row)) continue;
			if(!isset($row["user_id"])) continue;

			if(intval($row["user_id"]) == intval($user["id"])) {
				array_push($group, $row);
			}
		}

		return $group;
	}

}


$test = new Bank();
$test->balance();
