<?php

namespace Vita\Booking\Models;

use DateTime;
use Vita\Booking\Services\DatabaseService;

class BookModel
{
    function checkAvailability(int $id, string $startDate, string $endDate): ?array
    {
        $database = new DatabaseService();
        $apartments = $database->getApartments();

        $chosen = array_values(array_filter($apartments, function (array $apartment) use ($id) {
            return $apartment['apartment_id'] == $id;
        }));
        $chosenID = $chosen[0];

        $bookingStartDateDate = new DateTime($startDate);
        $bookingEndDateDate = new DateTime($endDate);
        $allBookings = $database->getBookings();
        $bookings = array_filter($allBookings, function ($booking) use ($id) {
            return $booking['apartment_id'] == $id;
        });

        $bookingInterval = $bookingEndDateDate->diff($bookingStartDateDate);
        $days = $bookingInterval->format('%a');
        $bookingWeeks = floor($days / 7);
        $bookingDays = $days - $bookingWeeks * 7;
        $fullPrice = $bookingWeeks * $chosenID['weekly_price'] + $bookingDays * $chosenID['daily_price'];
        $fullDeposit = $fullPrice * $chosenID['deposit'];
        $chosenID['days'] = $days;
        $chosenID['full_price'] = $fullPrice;
        $chosenID['full_deposit'] = $fullDeposit;

        foreach ($bookings as $booking) {
            $apartmentsStartDate = new DateTime($booking['start_date']);
            $apartmentsEndDate = new DateTime($booking['end_date']);

            if (($apartmentsStartDate > $bookingStartDateDate && $apartmentsStartDate >= $bookingEndDateDate)
                || ($apartmentsEndDate < $bookingStartDateDate && $apartmentsEndDate < $bookingEndDateDate)) {
                return $chosenID;
            } else {
                return null;
            }
        }
        return $chosenID;
    }

    public function newBooking(int $id, string $startDate, string $endDate): void
    {
        $bookingStartDateDate = new DateTime($startDate);
        $bookingEndDateDate = new DateTime($endDate);

        $bookingInterval = $bookingEndDateDate->diff($bookingStartDateDate);
        $days = $bookingInterval->format('%a');

        $bookingWeeks = floor($days / 7);
        $bookingDays = $days - $bookingWeeks * 7;

        $database = new DatabaseService();
        $apartments = $database->getApartments();
        $key = 0;
        foreach ($apartments as $apartmentKey => $apartment) {
            if ($apartment['apartment_id'] === $id) {
                $key = $apartmentKey;
            }
        }

        $fullPrice = $bookingWeeks * $apartments[$key]['weekly_price'] + $bookingDays * $apartments[$key]['daily_price'];

        $deposit = $fullPrice * $apartments[$apartmentKey]['deposit'];

        $database->newBooking($id, $startDate, $endDate, (int)$fullPrice, (int)$deposit);
    }
}
