<?php
namespace Vita\Booking\Services;
class DatabaseService
{
    const FULL_WEEK_PRICE_REDUCE = 0.10;
    private array $apartments;

    public function __construct()
    {
        $this->apartments = $this->getApartments();
        $this->bookings = $this->getBookings();
    }

    public function getApartments(): array
    {
        return json_decode(file_get_contents(__DIR__ . '/../../database/apartments.json'), true);
    }

    public function getOne(int $id): array
    {
        foreach ($this->apartments as $apartment) {
           if ($apartment['apartment_id'] === $id) {
               return $apartment;
           }
        }
        return $apartment;
    }

    public function add(array $newApartment): void
    {
        $newId = empty($this->apartments) ? 0 : max(array_column($this->apartments, 'apartment_id')) + 1;
        $weeklyPrice = ($newApartment['daily_price'] * 7) - ($newApartment['daily_price'] * 7 * self::FULL_WEEK_PRICE_REDUCE);
        $newApartment['apartment_id'] = $newId;
        $newApartment['weekly_price'] = $weeklyPrice;
        $this->apartments[] = $newApartment;

        $this->saveApartments();
    }

    public function saveApartments(): void
    {
        file_put_contents(__DIR__ . '/../../database/apartments.json', json_encode(array_values($this->apartments)));
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

    public function saveBooking(): void
    {
        file_put_contents(__DIR__ . '/../../database/bookings.json', json_encode(array_values($this->bookings)));
    }

    public function delete(array $params): array
    {
        foreach ($this->apartments as $key => $apartment) {
            if ($apartment['apartment_id'] == $params['btn-delete']) {
                unset($this->apartments[$key]);
                unlink(__DIR__ . '/../../database/images/' . $apartment['apartment_id'] . ".jpg");
            }
        }
        $this->saveApartments();

        return $this->apartments;
    }

    public function update(array $params): void
    {
        $chosenApartment = [];
        $apartmentKey = 0;
        foreach ($this->apartments as $key => $apartment) {
            if ($apartment['apartment_id'] == $params['btn-submit']) {
                $chosenApartment = $apartment;
                $apartmentKey = $key;
            }
        }

        foreach ($chosenApartment as $apartKey => $apartment) {
            foreach ($params as $paramKey => $param) {
                if ($apartKey === $paramKey && strlen($param) > 0) {
                    $chosenApartment[$apartKey] = $param;
                }
            }
        }

        array_map(function (array $apartment) use ($chosenApartment, $apartmentKey) {
            if ($chosenApartment['apartment_id'] === $apartment['apartment_id']) {
                    unset($this->apartments[$apartmentKey]);
                    $this->apartments[] = $chosenApartment;
            }
        }, $this->apartments);

        $this->saveApartments();
    }
}

