<?php

namespace App\Service;

use DateTime;
use App\Repository\BookingRepository;
use App\Entity\House;

class BookingManager
{
	private $bookingRepository;

	public function __construct(BookingRepository $bookingRepository)
	{
		$this->bookingRepository = $bookingRepository;
	}

	public function isBooked(House $house, DateTime $fromDate, DateTime $toDate) : bool
	{
		$bookings = $this->bookingRepository
			->checkAvailability($house, $fromDate, $toDate);
		return count($bookings) > 0;
	}
}