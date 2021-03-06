<?php

namespace App\Controller;

use App\Repository\TileRepository;
use App\Services\MapManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tile;
use App\Repository\BoatRepository;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     * @param BoatRepository $boatRepository
     * @return Response
     */
    public function displayMap(BoatRepository $boatRepository) :Response
    {
        $em = $this->getDoctrine()->getManager();
        $tiles = $em->getRepository(Tile::class)->findAll();

        foreach ($tiles as $tile) {
            $map[$tile->getCoordX()][$tile->getCoordY()] = $tile;
        }

        $boat = $boatRepository->findOneBy([]);

        return $this->render('map/index.html.twig', [
            'map'  => $map ?? [],
            'boat' => $boat,
        ]);
    }

    /**
     * @Route("/start", name="start")
     * @param BoatRepository $boatRepository
     * @param MapManager $mapManager
     * @param EntityManagerInterface $em
     * @param TileRepository $tileRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function start(BoatRepository $boatRepository, MapManager $mapManager, EntityManagerInterface $em, TileRepository $tileRepository)
    {
        $boat = $boatRepository->findOneBy([]);
        $boat->setCoordX(0);
        $boat->setCoordY(0);

        $previousTilesWithTreasure = $tileRepository->findBy(['hasTreasure' => true]);
        foreach ($previousTilesWithTreasure as $tile)
        {
            $tile->setHasTreasure(false);
            $em->persist($tile);
        }

        $tileWithTreasure = $mapManager->getRandomIsland();
        $tileWithTreasure->setHasTreasure(true);
        $em->persist($tileWithTreasure);

        $em->flush();

        return $this->redirectToRoute('map');
    }
}
