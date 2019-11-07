<?php

class Unit
{
	private $pv;
	protected $position = [0,0];
	private $speed = 1;

	const DIRECTIONS = [
		"right" => 1,
		"left" => -1,
		"top" => 1,
		"bottom" => -1
	];

	public function walk(string $direction, int $occurences = 1)
	{
		if (!array_key_exists($direction, self::DIRECTIONS)) {
			throw new Exception("Forbidden Direction", 1);
		}

		if (in_array($direction, ['top', 'bottom'])) {
			$newPos = [$this->position[0], $this->position[1] + ($this->speed * self::DIRECTIONS[$direction] * $occurences)];
		} else {
			$newPos = [$this->position[0] + ($this->speed * self::DIRECTIONS[$direction] * $occurences), $this->position[1]];
		}
		if ($newPos[0] < 0 || $newPos[1] < 0) {
			throw new Exception("Out of map borders!!", 1);
		}
		$this->position = $newPos;

		return $this;
	}

	public function __toString() : string
	{
		return "position: x:" . $this->position[0] . " y:" . $this->position[1] . "\n";
	}

	protected function setSpeed(int $speed)
	{
		$this->speed = $speed;
		return $this;
	}

	public function getSpeed()
	{
		return $this->speed;
	}
}