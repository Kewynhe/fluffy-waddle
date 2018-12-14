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
        

        /*if (!$this->result->getLastChoiceFor($this->mySide)) {
            return 'friend';
        }
        else {
            $mylast = $this->result->getLastChoiceFor($this->mySide);
            $foelast = $this->result->getLastChoiceFor($this->opponentSide);
            $myscore = $this->result->getLastScoreFor($this->mySide);
            $otherscore = $this->result->getLastScoreFor($this->opponentSide);

            if ($mylast == $foelast) {
                return $mylast;
            }
            else {
                return $foelast;
            }
        }*/

        //echo($this->result->getChoicesFor($this->mySide));

        if ($this->result->getLastChoiceFor($this->mySide) == 0) {
            return 'foe';
        }
        else {
            $me = $this->result->getLastScoreFor($this->mySide);
            $other = $this->result->getLastScoreFor($this->opponentSide);
            
            $lastchoice = $this->result->getLastChoiceFor($this->opponentSide);
            if ($lastchoice == 'foe') {
                if ($me < $other) {
                    return 'foe';
                }
                else {
                    return 'friend';
                }
            }
            else {
                if ($me < $other) {
                    return 'friend';
                }
                else {
                    return 'foe';
                }
            }
        }
    }
 
};
