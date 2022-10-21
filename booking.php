<?php

const WEEKEND_UPLIFT = 0.10;
const FULL_WEEK_PRICE_REDUCE = 0.10;

function getApartments(): array
{
    /**
     * Funkcija turi nuskaityti failą apartments.json
     * ir grąžinti visus apartamentus kaip masyvą
     */


return json_decode(file_get_contents('./apartments.json'), true);;
}

//if ($argv[1] == 'print_all') {
//    printAllApartments();
//}
function printAllApartments(): void
{
    /**
     * failą php -f booking_pirmas.php print_all
     * funkcija turi atspausdinti visus esamus apartamentus
     * pvz.:
     * ------Available Apartments-----------
     * id : 1
     * name : Palangos apartamentai
     * day price: 10
     * week price: 63
     * ------------------------------------
     * ...
     */

    $apartments = getApartments();
    foreach ($apartments as $apartment) {
        echo '------Available Apartments-----------' . PHP_EOL;
     echo 'id : ' . $apartment['apartment_id'] . PHP_EOL;
        echo 'name : ' . $apartment['name'] . PHP_EOL;
        echo 'day price: ' . $apartment['daily_price'] . PHP_EOL;
        echo 'week price: ' . $apartment['weekly_price'] . PHP_EOL;
     echo '------------------------------------' . PHP_EOL;
    }
}
//if ($argv[1] == 'new_apartment') {
//    addApartment();
//}
function addApartment(): void
{
    /**
     * Paleidus failą php -f booking_pirmas.php new_apartment
     * ši funkcija turi sukurti naujus apartamentus
     * ir juos išsaugoti apartments.json faile
     * 1. Prašykite vartotojo įvesti naujo apartamento pavadinimą, dienos kainą ir depozitą.
     * 2. Naujas apartamentas turi išsaugoti šią informaciją:
     *    a. id - sugeneruokite vienu didesnį skaičių už jau esantį didžiausią apartamentų masyve
     *    b. name - įvestas vartotojo apartamentų pavadinimas
     *    c. daily_price - įvesta vartotojo dienos kaina
     *    d. weekly_price - pilna savaitės kaina ir sumažinus 10 procentų
     *       (naudokitės konstanta FULL_WEEK_PRICE_REDUCE),
     *       pvz.: (daily_price * 7) - (daily_price * 7 * FULL_WEEK_PRICE_REDUCE)
     * 3. Pridėjus naujus apartamentus į masyvą, išsaugokite apartments.json faile
     */

    $apartments = getApartments();
    $newApartmentId = max(array_column($apartments, 'apartment_id'));


    $newApartmentName = readline('Ivesk naujo nuomojamo busto pavadinima: ');
    $newApartmentDeposit = readline('Ivesk naujo nuomojamo busto depozita: ');
    $newApartmentDailyPrice = readline('Ivesk naujo nuomojamo busto paros kaina: ');
    $newApartmentWeeklyPrice = ($newApartmentDailyPrice * 7) - ($newApartmentDailyPrice * 7 * FULL_WEEK_PRICE_REDUCE);

    $newApartment = [
        "apartment_id" => $newApartmentId,
    "name" => $newApartmentName,
    "deposit" => $newApartmentDeposit,
    "daily_price" => $newApartmentDailyPrice,
    "weekly_price" => $newApartmentWeeklyPrice,
    ];
    $apartments[] = $newApartment;

    file_put_contents('./apartments.json', json_encode($apartments, JSON_PRETTY_PRINT));

}

function getBookings(): array
{
    /**
     * Funkcija turi nuskaityti failą bookings.json
     * ir grąžinti visas rezervacijas kaip masyvą
     */


    return json_decode(file_get_contents('./bookings.json'), true);
}

function getBookingsForApartment(int $apartmentId): array
{
    /**
     * Naudojantis funkcija getBookings() gaukite visas rezervacijas,
     * jas išfiltruokite ir grąžinkite tik rezervacijas,
     * kurios atliktos apartamentuose, kurių id yra duotas $apartmentId
     */

$bookings = getBookings();
    $getMatchingBooking =  array_filter($bookings, function ($booking) use ($apartmentId) {
    return $booking['apartment_id'] == $apartmentId;
});
    return $getMatchingBooking;
}
var_dump(getBookingsForApartment(3));
//if ($argv[1] == 'new_booking') {
//    newBooking();
//}
function newBooking(): void
{

    /**
     * Paleidus failą php -f booking_pirmas.php new_booking
     * ši funkcija turėtų atspausdinti visus apartamentus
     * (naudokitės funkcija printAllApartments()) ir leisti
     * vartotojui įvesti apartamentų id numerį, kuriame jis norėtų atlikti rezervaciją.
     *

     * Jei pagal įvestą id apartamentai nerasti, vartotojas turi būti apie tai informuotas:
     * Sorry, the apartments with id you have entered does not exist
     *
     * Radus apartamentus vartotojas turi bųti informuotas apie dienos ir savaitės kainą, pvz.:
     * Price for a day: 10
     * Price for a week: 63
     *
     * Ir taip pat prašoma įvesti rezervacijos pradinę datą ir pabaigos datą:
     * Please enter booking_pirmas start date (YYYY-MM-DD):
     * Please enter booking_pirmas end date (YYYY-MM-DD):
     *
     * Naudodamiesi funkcija getBookingsForApartment($selectedApartmentId) patikrinkite, ar pasirinktos datos laisvos:
     * Jei datos užimtos, informuokite vartotoją ir leiskite jiems pasirinkti naujas datas:
     * Sorry, the selected dates at the apartment are already booked, please select new dates.
     * Please enter booking_pirmas start date (YYYY-MM-DD):
     * Please enter booking_pirmas end date (YYYY-MM-DD):
     **/


//
//        if (($bookingStartDateDate > $apartmentsStartDate && $bookingEndDateDate < $apartmentsEndDate)
//            || ($bookingStartDateDate < $apartmentsStartDate && $bookingEndDateDate > $apartmentsEndDate)
//            || ($bookingStartDateDate < $apartmentsStartDate && $bookingEndDateDate < $apartmentsEndDate)
//            || ($bookingStartDateDate > $apartmentsStartDate && $bookingEndDateDate > $apartmentsEndDate)
//
//        ) {
//            echo 'Sios datos uzimtos, bandyk is naujo' . PHP_EOL;
//        }
//        if (( $bookingStartDateDate > $apartmentsStartDate && $bookingStartDateDate < $apartmentsEndDate)
//            || ($bookingEndDateDate > $apartmentsStartDate && $bookingEndDateDate <  $apartmentsEndDate)
//            || ($bookingStartDateDate < $apartmentsStartDate && $bookingEndDateDate >  $apartmentsEndDate)
//        ) {
//    if (( $apartmentsStartDate > $bookingStartDateDate && $apartmentsStartDate > $bookingEndDateDate)
//        || ($apartmentsEndDate < $bookingStartDateDate && $apartmentsEndDate <  $bookingEndDateDate)
//    ) {
//        echo 'Sios datos laisvos!' . PHP_EOL;
//        echo 'Galutine kaina: ' . PHP_EOL;
//        echo 'Depozitas: ' . PHP_EOL;
//
//    }
    /*
     * Jeigu datos laisvos, informuokite vartotoją apie galutinę rezervacijos kainą ir depozitą.
     * Kainos apskaičiavimas: savaitės kaina * kiekviena pilna savaitė + dienos kaina * kiekviena papildoma diena
     * Depozitas: pilna kaina * depositas (pasirinkto apartamento masyve)
     * Leiskite vartotojui sutikti: taip arba ne
     * - Vartotojui nesutikus - nutraukiame rezervacijos procesą
     * - Vartotojui sutikus naudojam funkciją getBookings(),
     *   pridedame naują rezervaciją pagal vartotojo įvestas datas, bendrą sumą ir apartamentų id
     *   ir išsaugome bookings.json faile JSON formatu.
     */

    printAllApartments();
    $id = readline('Ivesk apartnamentu ID: ');

    $apartments = getApartments();
    $chosenID = array_values(array_filter($apartments, function (array $apartment) use ($id) {
        return $apartment['apartment_id'] == $id;
    }));



    if (empty($chosenID)) {
        echo 'Sorry, the apartments with id you have entered does not exist' . PHP_EOL;

    }

    $chosenID = $chosenID[0];

    echo 'Price for a day: ' . $chosenID['daily_price'] . PHP_EOL;
    echo 'Price for a week: ' . $chosenID['weekly_price'] . PHP_EOL;

    do {
        $datesFree = false;
        $bookingStartDate = readline('Please enter booking_pirmas start date (YYYY-MM-DD): ');
        $bookingEndDate = readline('Please enter booking_pirmas end date (YYYY-MM-DD): ');
        $bookingStartDateDate = new DateTime($bookingStartDate);
        $bookingEndDateDate = new DateTime($bookingEndDate);
        $bookings = getBookingsForApartment($id);
        foreach ($bookings as $booking) {
            $apartmentsStartDate = new DateTime($booking['start_date']);
            $apartmentsEndDate = new DateTime($booking['end_date']);

            if (($apartmentsStartDate > $bookingStartDateDate && $apartmentsStartDate > $bookingEndDateDate)
                || ($apartmentsEndDate < $bookingStartDateDate && $apartmentsEndDate < $bookingEndDateDate)) {
                echo 'These dates are free!' . PHP_EOL;
                break;
                } else {
                    echo 'Sorry, the selected dates at the apartment are already booked, please select new dates.' . PHP_EOL;
                    $datesFree = true;
                break;
            }
        }
    } while ($datesFree);

    $dateInterval = $bookingEndDateDate->diff($bookingStartDateDate);
    $intervalDays = $dateInterval->format('%a');
    $fullWeek = round($intervalDays / 7);
    $leftDays = $intervalDays - $fullWeek * 7;
    $fullPriceWithWeeklyDiscount = $fullWeek * $chosenID['weekly_price'] + $chosenID['daily_price'] * $leftDays;
    $fullPriceWithDailyPrice = $intervalDays * $chosenID['daily_price'];
    $interval = new DateInterval('P1D');
    $period = new DatePeriod($bookingStartDateDate, $interval, $bookingEndDateDate);

    $weekendDates = [];
    foreach ($period as $date) {
        if ($date->format("N") == 6 || $date->format("N") == 7) {
            $weekendDates[] = $date->format("Y-m-d");
        };
    }
    $numberOfWeekends = count($weekendDates);
    $fullPriceWithHigherWeekendPrice =  (($chosenID['daily_price'] + $chosenID['daily_price'] * WEEKEND_UPLIFT) * $numberOfWeekends) +
        (($intervalDays - $numberOfWeekends) * $chosenID['daily_price']);

    echo 'Full price with weeekly discount: ' . $fullPriceWithWeeklyDiscount. PHP_EOL;
    echo 'Full daily price without discount: ' . $fullPriceWithDailyPrice. PHP_EOL;
    echo 'Full daily price with higher weekend price: ' . $fullPriceWithHigherWeekendPrice. PHP_EOL;
    echo 'Deposit: ' . $fullPriceWithWeeklyDiscount * $chosenID['deposit']. PHP_EOL;

    $answer = readline('Is it ok for you? Y/N ');

    if ($answer === 'Y') {
        $allBookings = getBookings();
        $newBooking = [
            "apartment_id" => (int)$id,
            "start_date" => $bookingStartDate,
            "end_date" => $bookingEndDate,
            "price" => $fullPriceWithWeeklyDiscount,
        ];
        $allBookings[] = $newBooking;
        file_put_contents('./bookings.json', json_encode($allBookings, JSON_PRETTY_PRINT));
    }
    if ($answer == 'N') {
        echo 'Your reservation has been canceled.' . PHP_EOL;
    }
}

/**
 * Papildomi uždaviniai:
 * Skaičiuojant rezervacijos bendrą kainą ir mokant už atskiras dienas (ne savaitinę kainą),
 * šeštadienio ir sekmadienio dienų kainas pakelkite 10%, naudokite konstantą WEEKEND_UPLIFT.
 */
