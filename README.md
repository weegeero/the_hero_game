# The Hero Game

A command line RPG game that simulates battles between a hero and a wild beast.

## Classes files
- class_CharacterParent.php
- class_Hero.php
- class_Beast.php
- class_Skills.php
- class_Battle.php

### CharacterParent
This abstract class defines the methods that each child class must implement

### Hero/Beast
This class implements the hero/beast character methods inherited from CharacterParent class:
- attack - determines the damage deald to the other character/player. Also determines if the attacking player uses a special skill, rapidStrike, set by chance in Skill class' method, and acts accordingly. If such skill is used, the attacked player's health is verified for the attacking player not to attack again if the other player is already dead. If the attacked player is lucky, then it doesn't receive any damage. The dealt damage is passed as argument to the other player's defend method. Outputs message with the action that took place and its results.
- defend - determines the damage to be substracted from one's life/health. Also determines if the defending player uses a special skill, magicShield, set by chance in Skills class' method, and acts accordingly. If such skill is used, the defending player receives only a part (half) of the attacker's dealt damage. Substracts the received damage from the players's health. Outputs message with the action that took place and its results.
- isLucky - checks whether the player has a chance of not receiving any damage. Generates random number between 0 and 99 and compares it to the initialized luck value/percentage.
- isAlive - checks whether the player is still alive or not checking its health value. Used in doBattle workflow.
- initStats - initializes the player's stats. Called int the constructor, at object instantiation.
- randomizeStats - reinitializes the player's variable stats. Is called after each turn in doBattle workflow to modify strength, defense, and luck, resulting in a different damage and luck chance each turn, for a more dynamic battle. This method can be ignored/commented if the player's stats are to be fixed at object instatiation and not change with each turn. Health stat is not to be changed (there is no healing) while speed stat is relevant only for the battle start.
- getName - retrieves the player's name (custom getter);
The magic methods __set, __get, __toString are overloaded to set/acces stats, and to output formated (as string) object respectively.

### Skills
This class defines the (special) methods to be used by players when in battle - implemented in attack and/or defend methods.
- rapidStrike/magicShield - defines the chance of such skill to happen. Compares the chance with the prederemined value/percentage and returns true or false. Used in a player's attack and/or defend algorithms to establish the damage dealt/received by the battling players.

### Battle
This class defines the methods that comprise the battling mechanism:
- setOrder - compares two objects/players and determines the player with the highest speed value or, if the speeds are equal, the player with the highest luck value/percentage, and determines the player who will strike/attack first. Assigns object variable to a new one (passed by reference), making both objects copies of the same identifier. Called in class constructor.
- intro - outputs a nicely formated intro message with the players initial stats.
- statsAfterTurn - outputs the players stats after each turn. Uses formated objects (__toString).
- endBattle - outputs the finishing message, when a player is killed and the other declared winner, and exits the script.
- doBattle - the battle workflow. Calls intro output. Loops through the battle turns until the turns limit is reached, in which case it outputs a draw message, or until a player is no longer alive. Calls for attack and defend methods in succesion, analyzes the result and checks wether the attacked player has been killed, and calls for endBattle if so. Outputs the players' stats at the end of every turn. 

## Other files
- gameplay.php - script for manually testing various battle scenarios
