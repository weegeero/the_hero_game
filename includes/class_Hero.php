<?php

	/*
	hero character class
	extends parent and implements the abstract methods
	*/
	class Hero extends CharacterParent {

		/*
		class properties/attributes
		*/
		protected $name;
		protected $stats;
		private $skills;

		/*
		class constructor
		initiates character stats, sets name, instatiate skills
		@param string
		*/
		public function __construct($name = '') {

			if (strlen($name) < 1) {
				$name = get_class();
			}
			if (strlen($name) > 50) {
				$name = substr($name, 0, 50) . '...';
			}
			parent::__construct($name);
			$this->initStats();
			$this->skills = new Skills();
		}

		/*
		implements attack algorithm and outputs outcome
		@param object
		@return void
		*/
		public function attack($obj) {

			echo $this->name . ' Attacks:' . NL;
			$multiplier = 1;
			if ($this->skills->rapidStrike()) {
				echo $this->name . ' uses [Rapid Strike] and strikes twice!' . NL;
				$multiplier = 2;
			}
			for ($i = 1; $i <= $multiplier; $i++) {
				$damage = $this->strength - $obj->defence;
				if ($obj->isAlive()) {
					if ($obj->isLucky()) {
						echo $obj->getName() . ' is lucky and ' . $this->name . ' misses!' . NL;
					} else {
						echo $this->name . ' does ' . $damage . ' damage to ' . $obj->getName() . '.' . NL;
						$obj->defend($damage);
					}
				}
			}
		}
		/*
		substract damage from chacarter's health and outputs outcome
		@param int
		@return void
		*/
		public function defend($damage) {

			if ($this->skills->magicShield()) {
				echo $this->name . ' uses [Magic Shield] and takes only half damage!' . NL;
				$damage /= 2;
			}
			$this->health -= $damage;
			echo $this->name . ' has ' . $this->health . ' health left.' . NL;
		}

		/*
		determines if character is lucky, to be used in attack/defence algorithms
		@return boolean
		*/
		public function isLucky() {

			$chance = mt_rand(0, 99);
			if ($chance < $this->luck) {
				return true;
			}
			return false;
		}
		/*
		determines if character is alive, to be used in battle turns
		@return boolean
		*/
		public function isAlive() {

			if ($this->health > 0) {
				return true;
			}
			return false;
		}

		/*
		initiates character stats, called in the constructor
		@return void
		*/
		protected function initStats() {

			$this->stats['health'] = mt_rand(70, 100);
			$this->stats['strength'] = mt_rand(70, 80);
			$this->stats['defence'] = mt_rand(45, 55);
			$this->stats['speed'] = mt_rand(40, 50);
			$this->stats['luck'] = mt_rand(10, 30);
		}
		/*
		initiates character stats, called after each turn in battle
		@return void
		*/
		public function randomizeStats() {

			$this->stats['strength'] = mt_rand(70, 80);
			$this->stats['defence'] = mt_rand(45, 55);
			$this->stats['luck'] = mt_rand(10, 30);
		}

		/*
		name getter
		@return string
		*/
		public function getName() {

			return $this->name;
		}

		/*
		class setter and getter (magic methods) implementation for accesing (setting/retrieving) protected stats
		*/
		public function __set($stat, $value) {

			if (array_key_exists($stat, $this->stats)) {
				$this->stats[$stat] = $value;
			}
		}
		public function __get($stat) {

			if (array_key_exists($stat, $this->stats)) {
				return $this->stats[$stat];
			}
		}
		/*
		toString implementation for character object output in battle
		*/
		public function __toString() {

			$str = '';
			foreach ($this->stats as $key => $value) {
				$str .= ucfirst($key) . ' - ' . $value . ', ';
			}
			return $this->name . ': ' . rtrim($str, ', ') . '%';
		}

	}

?>