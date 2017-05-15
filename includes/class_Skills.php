<?php

	/*
	skills class contains methods to be used by hero/characters objects' methods (attack, defence, etc)
	*/
	class Skills {

		/*
		skills methods implementation
		returns boolean
		*/
		public function rapidStrike() {

			$chance = mt_rand(0, 99);
			if ($chance < 10) {
				return true;
			}
			return false;
		}
		public function magicShield() {

			$chance = mt_rand(0, 99);
			if ($chance < 20) {
				return true;
			}
			return false;
		}

	}

?>