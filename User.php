<?php

require_once("./Randomize.php");

/**
 * @property string $name
 * @property string $birth_date
 */
interface IUser {

}

class User implements IUser {

	public function __construct($id = "", $name = "", $birth_date = "") {
		$this->id = $id;
		$this->name = $name;
		$this->birth_date = $birth_date;
	}

  public function randomizeName() {
    $this->name = Randomize::name();
  }

  public function randomizeBirthDate($startDate = "", $endDate = "") {
    $this->birth_date = Randomize::dateFromTo($startDate, $endDate);
  }

}
