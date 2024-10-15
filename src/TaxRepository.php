<?php

/**
 * Usage allowed, just keep the credits.
 */

declare(strict_types=1);

namespace Src;

/**
 * Usage allowed, just keep the credits.
 */
class TaxRepository {
    
    /**
     * Returns the list of taxes by location
     *
     * @return array List of taxes
     */
    public function taxForLocations(): array {
        return [
            ['origin' => '011', 'destiny' => '016', 'priceForMinute' => 1.90],
            ['origin' => '016', 'destiny' => '011', 'priceForMinute' => 2.90],
            ['origin' => '011', 'destiny' => '017', 'priceForMinute' => 1.70],
            ['origin' => '017', 'destiny' => '011', 'priceForMinute' => 2.70],
            ['origin' => '011', 'destiny' => '018', 'priceForMinute' => 0.90],
            ['origin' => '018', 'destiny' => '011', 'priceForMinute' => 1.90]
        ];
    }

    /**
     * Finds the tax for the given origin and destination
     *
     * @param string $origin Origin
     * @param string $destiny Destination
     * @return array|null Found tax or null
     */
    public function findTaxForLocation(string $origin, string $destiny, array $taxes): ?array {
        foreach ($taxes as $tax) {
            if ($tax['origin'] === $origin && $tax['destiny'] === $destiny) {
                return $tax;
            }
        }
        return null;
    }
}
