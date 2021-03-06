<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author Kewynhe
 */
class KewynhePlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        //Begin with foe
        if ($this->result->getNbRound() == 0) {
            return 'friend';
        }
        else {
            //Get LastScore
            $me = $this->result->getLastScoreFor($this->mySide);
            $other = $this->result->getLastScoreFor($this->opponentSide);

            //Get LastChoice from opponent
            $lastChoice = $this->result->getLastChoiceFor($this->opponentSide);
            
            //Get all the Choices to create Stats in percent from foe
            $myChoices = $this->result->getStatsFor($this->mySide);
            $foeChoices = $this->result->getStatsFor($this->opponentSide);
            
            $mySum = $myChoices['friend'] + $foeChoices['foe'];
            $foeSum = $foeChoices['friend'] + $foeChoices['foe'];

            $foe_foeStats = $foeChoices['foe'] ? $foeChoices['foe']/$foeSum * 100 : 0;
            $foe_friendStats = $foeChoices['friend'] ? $foeChoices['friend']/$foeSum * 100 : 0;

            $dream_team = array('PacoTheGreat', 'Felixdupriez', 'Shiinsekai', 'GHope', 'Christaupher', 'Benli06', 'Etienneelg', 'Sky555v');
            $name = $this->result->getStatsFor($this->opponentSide)['name'];
            if (in_array($name, $dream_team))
                return parent::foeChoice();

            //If opponent is nice, be nice too
            if ($lastChoice == 'friend') {
                return parent::friendChoice();
            }

            //If there is to many foe, go foe
            if ($foeSum > 3 && $foeChoices['foe'] == $foeSum) {
                return parent::foeChoice();
            }
            
            /**
             * Depending on the last choice from my Opponent
             * Use the ratio and the difference about the scores
             * to respond correctly in case if 'foe' came more than 30%
             * or if 'friend' cmore than 70
             * */
            if ($lastChoice == 'foe') {
                if ($myChoices['score'] >= $foeChoices['score']) { // In case of victory
                    if ($foe_friendStats > 70)
                        return parent::foeChoice();
                    else
                        return parent::friendChoice();
                }
                else { // In case of defeat
                    if ($foe_foeStats > 70) {
                        return parent::friendChoice();
                    }
                    else {
                        return parent::foeChoice();
                    }
                }
            }
        }
    }
 
};
