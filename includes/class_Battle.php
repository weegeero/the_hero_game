<?php

	/*
	battle class, defines the game's gameplay
	*/
	class Battle {

		/*
		class properties/attributes
		*/
		private $first, $second;
		private $turns, $heroName, $beastName;

		/*
		class constructor
		initiates battle turns and character objects that do battle
		@params object, object, int
		*/
		public function __construct($obj1, $obj2, $turns = 20) {

			$this->turns = is_numeric($turns) ? $turns : 20;
			$this->setOrder($obj1, $obj2);
			$this->heroName = $obj1->getName();
			$this->beastName = $obj2->getName();
		}

		/*
		does all the battle workflow and outputs each step
		@return void
		*/
		public function doBattle() {

			$this->intro();

			$turn = 1;
			echo $this->first->getName() . ' has first strike.' . NL . NL;

			while ($turn <= $this->turns) {
				echo 'TURN ' . $turn . ':' . NL;
				if ($turn % 2 == 1) {
					$this->first->attack($this->second);
					if (!$this->second->isAlive()) {
						$this->endBattle($this->first, $this->second);
					}
					$this->second->attack($this->first);
					if (!$this->first->isAlive()) {
						$this->endBattle($this->second, $this->first);
					}
				} else {
					$this->second->attack($this->first);
					if (!$this->first->isAlive()) {
						$this->endBattle($this->second, $this->first);
					}
					$this->first->attack($this->second);
					if (!$this->second->isAlive()) {
						$this->endBattle($this->first, $this->second);
					}
				}
				$this->statsAfterTurn($turn);
				$this->first->randomizeStats();
				$this->second->randomizeStats();
				echo NL;
				$turn++;
			}
			echo 'Battle ended in a draw, after ' . $this->turns . ' turns...' . NL;
		}

		/*
		determines which character attacks first
		@return array
		*/
		private function setOrder($obj1, $obj2) {

			if ($obj1->speed > $obj2->speed) {
				$this->first = $obj1;
				$this->second = $obj2;
			} elseif ($obj1->speed < $obj2->speed) {
				$this->first = $obj2;
				$this->second = $obj1;
			} else {
				if ($obj1->luck >= $obj2->luck) {
					$this->first = $obj1;
					$this->second = $obj2;
				} else {
					$this->first = $obj2;
					$this->second = $obj1;
				}
			}
		}

		/*
		outputs the battle intro message
		@return void
		*/
		private function intro() {

			$intro = 'Our great hero, ' . $this->heroName . ' will battle ' . $this->beastName . ' in the ever-green forests of Emagia';
			echo NL . str_pad('', strlen($intro), '=') . NL;
			echo $intro . NL;
			echo 'Characters\'s starting stats are:' . NL;
			echo $this->first . NL;
			echo $this->second . NL;
			echo NL;
			$begin = 'Let The Battle Begin!';
			echo str_pad($begin, round((strlen($intro) - strlen($begin))/2)+strlen($begin), ' ', STR_PAD_LEFT) . NL;
			echo NL;
			echo str_pad('', strlen($intro), '=') . NL;
		}

		/*
		outputs the characters' stats after each turn
		@param int
		@return void
		*/
		private function statsAfterTurn($turn) {

			echo 'Characters\' stats after turn ' . $turn . ' are:' . NL;
			echo $this->first . NL; 
			echo $this->second . NL;
		}

		/*
		outputs the final action in battle, and exits the script
		*/
		private function endBattle($obj1, $obj2) {

			exit(NL . $obj2->getName() . ' has been killed! ' . $obj1->getName() . ' WINS THE BATTLE!' . NL. NL);
		}

	}

?>