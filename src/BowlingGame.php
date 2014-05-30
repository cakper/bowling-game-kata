<?php

class BowlingGame
{
    private $rolls = [];

    const MAX_FRAMES = 10;

    public function roll($pins)
    {
        $this->rolls[] = $pins;
    }

    public function score()
    {
        $score = 0;
        $frameIndex = 0;

        for ($frame = 0; $frame < self::MAX_FRAMES; $frame++) {

            if ($this->isStrike($frameIndex)) {
                $score += 10 + $this->strikeBonus($frameIndex);
                $frameIndex++;
            } elseif ($this->isSpare($frameIndex)) {
                $score += $this->scoreFrame($frameIndex) + $this->spareBonus($frameIndex);
                $frameIndex += 2;
            } else {
                $score += $this->scoreFrame($frameIndex);
                $frameIndex += 2;
            }
        }

        return $score;
    }

    private function scoreFrame($frameIndex)
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1];
    }

    private function isSpare($frameIndex)
    {
        return 10 === $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1];
    }

    private function spareBonus($frameIndex)
    {
        return $this->rolls[$frameIndex + 2];
    }

    private function isStrike($frameIndex)
    {
        return 10 === $this->rolls[$frameIndex];
    }

    private function strikeBonus($frameIndex)
    {
        return $this->rolls[$frameIndex + 1] + $this->rolls[$frameIndex + 2];
    }
}
