<?php

class MathAoa {
	public static function getSumByField($aoa, $field) {

		$sum = 0;

		if(!is_array($aoa)) return $sum;

		$aoaLength = sizeof($aoa);

		for($i = 0; $i < $aoaLength; $i++) {

			$row = $aoa[$i];

			if(!is_array($row)) continue;

			if(isset($row[$field])) {
				$sum += floatval($row[$field]);
			}
		}

		return $sum;
	}
}
