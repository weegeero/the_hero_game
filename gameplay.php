<?php

	/*
		useful constants
	*/
	define('NL', (isset($argv[0]) && $argc > 0) ? "\n" : '<br />');
	define('INC', '/includes/');

	/*
		required classes
	*/
	require_once __DIR__ . INC . 'class_CharacterParent.php';
	require_once __DIR__ . INC . 'class_Hero.php';
	require_once __DIR__ . INC . 'class_Beast.php';
	require_once __DIR__ . INC . 'class_Skills.php';
	require_once __DIR__ . INC . 'class_Battle.php';

	/*
	usual/normal battle scenario
	*/
	$hero = new Hero('Orderus');
	$beast = new Beast('The Mighty Tiger');
	$battle = new Battle($hero, $beast, 20);
	$battle->doBattle();

	/*
	battle scenario where characters have default (class name) values
	*/
	/*
	$hero = new Hero();
	$beast = new Beast();
	$battle = new Battle($hero, $beast, 20);
	$battle->doBattle();
	*/

	/*
	battle scenario where it's most likely to end in a draw (2 turns)
	*/
	/*
	$hero = new Hero('Orderus');
	$beast = new Beast('The Mighty Lion');
	$battle = new Battle($hero, $beast, 2);
	$battle->doBattle();
	*/

?>