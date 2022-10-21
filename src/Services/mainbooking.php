<?php

const FULL_WEEK_PRICE_REDUCE = 0.10;

function getApartments(): array
{
return json_decode(file_get_contents('./apartments.json'), true);;
}

function getBookings(): array
{
    return json_decode(file_get_contents('./bookings.json'), true);
}


function checkAvailableDates($startDate, $endDate, $city):array
{
    $apartments = getApartments();
    $bookings = getBookings();

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
    $apartmentsByCity = filterByCity($city);
    $availableDatesByCity = [];
    foreach ($apartmentsByCity as $apartmentByCity){
        $availableDatesByCity = array_filter($apartments, function ($apartment) use ($apartmentByCity){
            return $apartment['city'] === $apartmentByCity['city'];
    });
    }

    return $city ? $availableDatesByCity : $apartments ;
}
//var_dump(checkAvailableDates('2022-09-03', '2022-09-07'));

function checkAvailability($id, $startDate, $endDate): ?array
{
    $apartments = getApartments();
    $chosen = array_values(array_filter($apartments, function (array $apartment) use ($id) {
        return $apartment['apartment_id'] == $id;
    }));
    $chosenID = $chosen[0];

    $bookingStartDateDate = new DateTime($startDate);
    $bookingEndDateDate = new DateTime($endDate);
    $allBookings = getBookings();
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

function addApartment($name, $city, $dailyPrice, $deposit): void
{
    $apartments = getApartments();
    $weeklyPrice = ($dailyPrice * 7) - ($dailyPrice * 7 * FULL_WEEK_PRICE_REDUCE);
    $apartments[] = [
        'apartment_id' => max(array_column($apartments, 'apartment_id')) + 1,
        'name' => $name,
        "city" => $city,
        'deposit' => $deposit,
        'daily_price' => $dailyPrice,
        'weekly_price' => $weeklyPrice,
    ];
    file_put_contents('./apartments.json', json_encode($apartments, JSON_PRETTY_PRINT));
}

function bookApartment($id, $startDate, $endDate, $fullPrice):void
{
    $bookings = getBookings();
    if (checkAvailability($id, $startDate, $endDate) != null) {
        $bookings[] = [
            "apartment_id" => $id,
            "start_date" => $startDate,
            "end_date" => $endDate,
            "price" => $fullPrice,
        ];

        file_put_contents('./bookings.json', json_encode($bookings, JSON_PRETTY_PRINT));
    }
}

function getUniqueCity(): array
{
    $apartments = getApartments();
    $uniqueCities = [];
    foreach ($apartments as $apartment) {
        $uniqueCities[] = $apartment['city'];
    }
    return array_unique($uniqueCities);
}

function filterByCity($city):array
{
    $apartments = getApartments();
   return array_filter($apartments, function ($apartment) use ($city) {
        return $apartment['city'] == $city;
    });
}
