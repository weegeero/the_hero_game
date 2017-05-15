<?php

	/*
	abstract parent character class for children hero, beast, etc
	that forces the children to implement its methods
	*/
	abstract class CharacterParent {

		/*
		class properties/attributes
		*/
		protected $name;
		protected $stats;

		/*
		class constructor
		*/
		public function __construct($name) {

			$this->name = $name;
		}

		/*
		abstract methods for the children classes to implement
		*/
		abstract public function attack($obj);
		abstract public function defend($damage);
		abstract public function isLucky();
		abstract public function isAlive();
		abstract public function getName();
		abstract protected function initStats();
		abstract public function randomizeStats();

	}

?>