<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\House;
use App\Entity\City;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Form\SearchType;

use App\Service\BookingManager;

use Symfony\Component\Form\FormError;

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

        $searchForm = $this->createForm(SearchType::class, null, [
            'method' => 'GET',
        ]);

        $searchForm->handleRequest($request);

        $houses = [];

        if ($searchForm->isSubmitted() && $searchForm->isValid())
        {
            $filters = $searchForm->getData(); // Returns an Array ['city' => .... , "type" => ...., "bedNumber" => ...., "price" => ...]

            $houses = $this->getDoctrine()
                ->getRepository(House::class)
                ->filterSearch($filters, self::NB_HOUSE_PER_PAGE, ($page -1) * self::NB_HOUSE_PER_PAGE);
        } else {        
    		$houses = $this->getDoctrine()
    	        ->getRepository(House::class)
                ->findBy([], null, self::NB_HOUSE_PER_PAGE, ($page -1) * self::NB_HOUSE_PER_PAGE);
        }

        $cities = $this->getDoctrine()
            ->getRepository(City::class)
	        ->findAll();

        return $this->render('rental/index.html.twig', [
            'houses' => $houses,
            'cities' => $cities,
            'page' => $page,
            'searchForm' => $searchForm->createView(),
        ]);
    }

    /**
    * @Route("/{slug}", name="rental_view")
    */
    public function view(Request $request, House $house, BookingManager $bookingManager)
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $booking->setHouse($house);

            if ($bookingManager->isBooked($house, $booking->getFromDate(), $booking->getToDate())) {
                $form->addError(new FormError("unavailable > Already booked"));
            } else {                
                $em->persist($booking);
                $em->flush();
            }
        }

        return $this->render('rental/view.html.twig', [
            'house' => $house,
            'bookingForm' => $form->createView(),
        ]);
    }

}
