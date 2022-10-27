<?php

namespace Vita\Booking\Models;

use DateTime;
use Vita\Booking\Services\DatabaseService;

class BookModel
{
    function checkAvailability(int $id, string $startDate, string $endDate): ?array
    {
        $database = new DatabaseService('apartments');
        $chosenID = $database->getOne($id);

        $bookingStartDateDate = (new DateTime($startDate));
        $bookingEndDateDate = (new DateTime($endDate));
        $database = new DatabaseService('bookings');
        $allBookings = $database->get();
        $bookings = array_filter($allBookings, function ($booking) use ($id) {
            return $booking['apartment_id'] == $id;
        });

        $bookingInterval = $bookingEndDateDate->diff($bookingStartDateDate);
        $days = $bookingInterval->format('%a');
        $bookingWeeks = floor($days / 7);
        $bookingDays = $days - $bookingWeeks * 7;
        $fullPrice = $bookingWeeks * $chosenID['weekly_price'] + $bookingDays * $chosenID['daily_price'];
        $fullDeposit = $fullPrice * $chosenID['deposit'] / 100;
        $chosenID['days'] = $days;
        $chosenID['full_price'] = (int) $fullPrice;
        $chosenID['full_deposit'] = (int) $fullDeposit;

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

        $database = new DatabaseService('apartments');
        $apartments = $database->get();
        $key = 0;
        foreach ($apartments as $apartmentKey => $apartment) {
            if ($apartment['apartment_id'] === $id) {
                $key = $apartmentKey;
            }
        }

        $fullPrice = $bookingWeeks * $apartments[$key]['weekly_price'] + $bookingDays * $apartments[$key]['daily_price'];
        $deposit = $fullPrice * $apartments[$key]['deposit'] / 100;
        $database = new DatabaseService('bookings');
        $database->newBooking($id, $startDate, $endDate, (int)$fullPrice, (int)$deposit);
    }
}
