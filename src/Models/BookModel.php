<?php

namespace Vita\Booking\Models;

use DateTime;
use Vita\Booking\Services\DatabaseService;

class BookModel
{
    function checkAvailability(int $id, string $startDate, string $endDate): ?array
    {

        $data = [
            'id' => $id,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        file_put_contents(__DIR__ . '/../../database/temporary_data.json', json_encode($data));

        $database = new DatabaseService();
        $apartments = $database->get();

        $chosen = array_values(array_filter($apartments, function (array $apartment) use ($data) {
            return $apartment['apartment_id'] == $data['id'];
        }));
        $chosenID = $chosen[0];

        $bookingStartDateDate = new DateTime($data['start_date']);
        $bookingEndDateDate = new DateTime($data['end_date']);
        $allBookings = $database->getBookings();
        $bookings = array_filter($allBookings, function ($booking) use ($data) {
            return $booking['apartment_id'] == $data['id'];
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

public function newBooking(int $id, string $startDate, string $endDate):void
{

    $data = [
        'id' => $id - 1,
        'start_date' => $startDate,
        'end_date' => $endDate,
    ];

    $bookingStartDateDate = new DateTime($data['start_date']);
    $bookingEndDateDate = new DateTime($data['end_date']);

    $bookingInterval = $bookingEndDateDate->diff($bookingStartDateDate);
    $days = $bookingInterval->format('%a');

    $bookingWeeks = floor($days / 7);
    $bookingDays = $days - $bookingWeeks * 7;

    $database = new DatabaseService();
    $apartments = $database->get();

    $fullPrice = $bookingWeeks * $apartments[$data['id']]['weekly_price'] + $bookingDays * $apartments[$data['id']]['daily_price'];

    $deposit = $fullPrice * $apartments[$data['id']]['deposit'];

    $database->newBooking($id, $startDate, $endDate, $fullPrice, $deposit);
}
}