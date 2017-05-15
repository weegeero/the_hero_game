<?php

	/*
	beast character class
	extends parent and implements the abstract methods
	*/
	class Beast extends CharacterParent {

		/*
		class properties/attributes
		*/
		protected $name;
		protected $stats;

		/*
		class constructor
		initiates character stats, sets name
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
		}

		/*
		implements attack algorithm and outputs outcome
		@param object
		@return void
		*/
		public function attack($obj) {

			echo $this->name . ' Attacks:' . NL;
			$damage = $this->strength - $obj->defence;
			if ($obj->isLucky()) {
				echo $obj->getName() . ' is lucky and ' . $this->name . ' misses!' . NL;
			} else {
				echo $this->name . ' does ' . $damage . ' damage to ' . $obj->getName() . '.' . NL;
				$obj->defend($damage);
			}
		}
		/*
		substract damage from chacarter's health and outputs outcome
		@param int
		@return void
		*/
		public function defend($damage) {

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
		determines if character is alive, to be used in battler turns
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

			$this->stats['health'] = mt_rand(60, 90);
			$this->stats['strength'] = mt_rand(60, 90);
			$this->stats['defence'] = mt_rand(40, 60);
			$this->stats['speed'] = mt_rand(40, 60);
			$this->stats['luck'] = mt_rand(25, 40);
		}
		/*
		initiates character stats, called after each turn in battle
		@return void
		*/
		public function randomizeStats() {

			$this->stats['strength'] = mt_rand(60, 90);
			$this->stats['defence'] = mt_rand(40, 60);
			$this->stats['luck'] = mt_rand(25, 40);
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