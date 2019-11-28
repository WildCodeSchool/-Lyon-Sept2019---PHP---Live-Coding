<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\House;
use App\Entity\City;

/**
 * @Route("/rentals")
 */
class RentalController extends AbstractController
{
    /**
     * @Route("/", name="rentals_list")
     */
    public function index()
    {
		$houses = $this->getDoctrine()
	        ->getRepository(House::class)
	        ->findAll();

	    // var_dump($houses);

        $cities = $this->getDoctrine()
            ->getRepository(City::class)
            ->findAll();

        return $this->render('rental/index.html.twig', [
            'houses' => $houses,
            'cities' => $cities,
        ]);
    }

    /**
    * @Route("/{id}", name="rental_view")
    */
    public function view(House $house)
    {
        return $this->render('rental/view.html.twig', [
            'house' => $house
        ]);
    }

}
