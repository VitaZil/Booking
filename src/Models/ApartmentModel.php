<?php

namespace Vita\Booking\Models;

use DateTime;
use Vita\Booking\Services\DatabaseService;

class ApartmentModel
{

    public function getApartments(): array
    {
        $database = new DatabaseService('apartments');
        return $database->get();
    }

    public function getOneApartment(int $id): array
    {
        $database = new DatabaseService('apartments');
        return $database->getOne($id);
    }

    public function addNewApartment(array $newApartment): void
    {
        $database = new DatabaseService('apartments');
        $database->add($newApartment);
    }

    public function getUniqueCities(): array
    {
        $database = new DatabaseService('apartments');
        $apartments = $database->get();
        return array_values(array_unique(array_column($apartments, 'city')));
    }

    function checkAvailableDates($startDate, $endDate, $city): array
    {
        $database = new DatabaseService('apartments');
        $apartments = $database->get();
        $database = new DatabaseService('bookings');
        $bookings = $database->get();

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
        $database = new DatabaseService('apartments');
        $apartments = $database->get();
        return array_filter($apartments, function ($apartment) use ($city) {
            return $apartment['city'] == $city;
        });
    }

    function update(array $params): void
    {
        $database = new DatabaseService('apartments');
        $database->update($params);
    }

    function delete(array $params): array
    {
        $database = new DatabaseService('apartments');
        return $database->delete($params);
    }
}
