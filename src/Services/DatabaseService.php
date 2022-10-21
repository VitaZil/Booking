<?php
namespace Vita\Booking\Services;
class DatabaseService
{
    const FULL_WEEK_PRICE_REDUCE = 0.10;
    private array $apartments;

    public function __construct()
    {
        $this->apartments = $this->get();
        $this->bookings = $this->getBookings();
    }

    public function get(): array
    {
        return json_decode(file_get_contents(__DIR__ . '/../../database/apartments.json'), true);
    }

    public function getOne(int $id):array
    {
        $this->apartments = $this->get();

        $apartmentId = array_filter($this->apartments, function ($apartment) use ($id) {
            return $apartment['apartment_id'] === $id;
        });
        $apartment = $apartmentId[$id - 1];
        return $apartment;
    }

    public function add(array $newApartment): void
    {
        $newId = empty($this->apartments) ? 0 : max(array_column($this->apartments, 'apartment_id')) + 1;
        $weeklyPrice = ($newApartment['daily_price'] * 7) - ($newApartment['daily_price'] * 7 * self::FULL_WEEK_PRICE_REDUCE);
        $newApartment['apartment_id'] = $newId;
        $newApartment['weekly_price'] = $weeklyPrice;
        $this->apartments[] = $newApartment;

        $this->save();
    }

    public function save():void
    {
        file_put_contents(__DIR__ . '/../../database/apartments.json', json_encode($this->apartments));
    }

    public function getBookings()
    {
        return json_decode(file_get_contents(__DIR__ . '/../../database/bookings.json'), true);

    }

    public function newBooking(int $id, string $startDate, string $endDate, float $fullPrice, float|int $deposit): void
    {
        $newBooking = [
            "apartment_id" => $id,
            "start_date" => $startDate,
            "end_date" => $endDate,
            "price" => $fullPrice,
            "deposit" => $deposit,
        ];

        $this->bookings[] = $newBooking;
        $this->saveBooking();
    }

    public function saveBooking():void
    {
        file_put_contents(__DIR__ . '/../../database/bookings.json', json_encode($this->bookings));
    }


}

//$new = new DatabaseService();
//var_dump($new->getOne(5));