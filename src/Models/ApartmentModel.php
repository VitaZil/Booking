<?php
namespace Vita\Booking\Models;
use DateTime;
use Vita\Booking\Services\DatabaseService;

class ApartmentModel
{

    public function __construct()
    {
    }

    public function get(): array
    {
        $database = new DatabaseService();

        return $database->get();

    }

    public function getOne(int $id): array
    {
        $database = new DatabaseService();

        return $database->getOne($id);
    }

    public function addNewOne(array $newApartment): void
    {
        $database = new DatabaseService();
        $database->add($newApartment);
    }

    public function getUniqueCities(): array
    {
        $database = new DatabaseService();
        $apartments = $database->get();
        return array_values(array_unique(array_column($apartments, 'city')));
    }

    function checkAvailableDates($startDate, $endDate, $city): array
    {
        $data = [

            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
        file_put_contents(__DIR__ . '/../../database/temporary_data.json', json_encode($data));

        $database = new DatabaseService();
        $apartments = $database->get();
        $bookings = $database->getBookings();

        foreach ($bookings as $booking) {
            $apartmentStartDate = new DateTime($startDate);
            $apartmentEndDate = new DateTime($endDate);
            $bookingStartDate = new DateTime($booking['start_date']);
            $bookingEndDate = new DateTime($booking['end_date']);

            if (($apartmentStartDate > $bookingStartDate && $apartmentStartDate < $bookingEndDate)
                || ($apartmentEndDate > $bookingStartDate && $apartmentEndDate < $bookingEndDate)
                || ($apartmentStartDate < $bookingStartDate && $apartmentEndDate > $bookingEndDate)) {
                foreach ($apartments as $key => $apartment) {
                    if ($apartment['apartment_id'] === $booking['apartment_id']) {
                        unset($apartments[$key]);
                    }
                }
            }
        }
        $apartmentsByCity = $this->filterByCity($city);
        $availableDatesByCity = [];
        foreach ($apartmentsByCity as $apartmentByCity) {
            $availableDatesByCity = array_filter($apartments, function ($apartment) use ($apartmentByCity) {
                return $apartment['city'] === $apartmentByCity['city'];
            });
        }

        return $city ? $availableDatesByCity : $apartments;
    }

    function filterByCity($city): array
    {
        $database = new DatabaseService();
        $apartments = $database->get();
        return array_filter($apartments, function ($apartment) use ($city) {
            return $apartment['city'] == $city;
        });
    }
    function bookApartment($id, $startDate, $endDate, $fullPrice): void
    {
        $database = new DatabaseService();
        $bookings = $database->getBookings();
        if (checkAvailability($id, $startDate, $endDate) != null) {
            $bookings[] = [
                "apartment_id" => $id,
                "start_date" => $startDate,
                "end_date" => $endDate,
                "price" => $fullPrice,
            ];

            $database->saveBooking();
        }
    }

}