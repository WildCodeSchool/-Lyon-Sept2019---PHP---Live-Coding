<?php

namespace App\Services;

use App\Entity\Boat;
use App\Entity\Tile;
use App\Repository\TileRepository;

class MapManager
{
    private $tileRepository;

    public function __construct(TileRepository $tileRepository)
    {
        $this->tileRepository = $tileRepository;
    }

    public function tileExists(int $x, int $y) : bool
    {
        $tile = $this->tileRepository->findOneBy([
            'coordX' => $x,
            'coordY' => $y
        ]);
        return ($tile !== null);
    }

    public function getRandomIsland() : Tile
    {
        $islands = $this->tileRepository->findByType("island");
        return $islands[rand(0, count($islands))];
    }

    public function checkTreasure(Boat $boat) : bool
    {
        $tile = $this->tileRepository->findOneBy([
            'coordX' => $boat->getCoordX(),
            'coordY' => $boat->getCoordY()
        ]);
        return $tile->getHasTreasure();
    }
}