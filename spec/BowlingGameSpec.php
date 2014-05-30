<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BowlingGameSpec extends ObjectBehavior
{
    function it_plays_gutter_game()
    {
        $this->rollMany(20, 0);

        $this->score()->shouldReturn(0);
    }

    function it_plays_all_ones()
    {
        $this->rollMany(20, 1);

        $this->score()->shouldReturn(20);
    }

    function it_plays_one_spare()
    {
        $this->rollSpare();
        $this->roll(3);
        $this->rollMany(17, 0);

        $this->score()->shouldReturn(16);
    }

    function it_plays_one_strike()
    {
        $this->rollStrike();
        $this->roll(3);
        $this->roll(4);
        $this->rollMany(17, 0);

        $this->score()->shouldReturn(24);
    }

    function it_plays_perfect_game()
    {
        $this->rollMany(12, 10);
        $this->score()->shouldReturn(300);
    }

    private function rollMany($rolls, $pins)
    {
        for ($i = 0; $i < $rolls; $i++) {
            $this->roll($pins);
        }
    }

    private function rollSpare()
    {
        $this->roll(5);
        $this->roll(5);
    }

    private function rollStrike()
    {
        $this->roll(10);
    }

}
