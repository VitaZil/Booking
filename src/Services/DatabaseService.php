<?php

namespace Vita\Booking\Services;

use Vita\Booking\Exceptions\PropertyNotFoundException;

class DatabaseService
{
    const FULL_WEEK_DISCOUNT = 0.10;

    private string $filePath;
    private array $items;
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->filePath = __DIR__ . '/../../database/' . $fileName . '.json';
        $this->items = $this->get();
    }

    public function get(): array
    {
        return json_decode(file_get_contents($this->filePath), true);
    }

    public function getOne(int $id): array
    {
        foreach ($this->items as $apartment) {
            if ($apartment['apartment_id'] === $id) {
                return $apartment;
            }
        }
        throw new PropertyNotFoundException();
    }

    public function add(array $newApartment): void
    {
        $newId = empty($this->items) ? 0 : max(array_column($this->items, 'apartment_id')) + 1;
        $weeklyPrice = ($newApartment['daily_price'] * 7) - ($newApartment['daily_price'] * 7 * self::FULL_WEEK_DISCOUNT);
        $newApartment['apartment_id'] = $newId;
        $newApartment['weekly_price'] = $weeklyPrice;
        $this->items[] = $newApartment;

        $this->save();
    }

    public function save(): void
    {
        file_put_contents($this->filePath, json_encode(array_values($this->items)));
    }

    public function newBooking(int    $id,
                               string $startDate,
                               string $endDate,
                               int    $fullPrice,
                               int    $deposit,
    ): void
    {
        $newBooking = [
            "apartment_id" => $id,
            "start_date" => $startDate,
            "end_date" => $endDate,
            "price" => $fullPrice,
            "deposit" => $deposit,
        ];

        $this->items[] = $newBooking;
        $this->save();
    }

    public function delete(array $params): array
    {
        foreach ($this->items as $key => $apartment) {
            if ($apartment['apartment_id'] == $params['btn-delete']) {
                unset($this->items[$key]);
                unlink(__DIR__ . '/../../database/images/' . $apartment['photo_name']);
            }
        }

        $this->save();

        return $this->items;
    }

    public function update(array $params): void
    {
        $chosenApartment = [];
        $apartmentKey = 0;
        foreach ($this->items as $key => $apartment) {
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
                if (strlen($params['daily_price']) !== 0) {
                    $weeklyPrice = ($params['daily_price'] * 7) - ($params['daily_price'] * 7 * self::FULL_WEEK_DISCOUNT);
                    $chosenApartment['weekly_price'] = (int)$weeklyPrice;
                }
            }
        }

        array_map(function (array $apartment) use ($chosenApartment, $apartmentKey) {
            if ($chosenApartment['apartment_id'] === $apartment['apartment_id']) {
                unset($this->items[$apartmentKey]);
                $this->items[] = $chosenApartment;
            }
        }, $this->items);

        $this->save();
    }
}

