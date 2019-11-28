<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\House;
use App\Entity\City;

/**
 * @Route("/rentals")
 */
class RentalController extends AbstractController
{

    const NB_HOUSE_PER_PAGE = 6;

    /**
     * @Route("/", name="rentals_list")
     */
    public function index(Request $request)
    {
        $page = $request->query->get('page', 1);

		$houses = $this->getDoctrine()
	        ->getRepository(House::class)
            ->findBy([], null, self::NB_HOUSE_PER_PAGE, ($page -1) * self::NB_HOUSE_PER_PAGE);

        $cities = $this->getDoctrine()
            ->getRepository(City::class)
	        ->findAll();

        return $this->render('rental/index.html.twig', [
            'houses' => $houses,
            'cities' => $cities,
            'page' => $page,
        ]);
    }

    /**
    * @Route("/{slug}", name="rental_view")
    */
    public function view(House $house)
    {
        return $this->render('rental/view.html.twig', [
            'house' => $house
        ]);
    }

}
