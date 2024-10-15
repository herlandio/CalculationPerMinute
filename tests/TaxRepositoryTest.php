<?php

/**
 * Usage allowed, just keep the credits.
 */

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\TaxRepository;

/**
 * Class TaxRepositoryTest
 *
 * Tests for the TaxRepository class, which provides rates for calls
 * between different locations.
 */
class TaxRepositoryTest extends TestCase {
    private TaxRepository $taxRepository;

    /**
     * Setup method that runs before each test.
     * Instantiates the TaxRepository class.
     */
    protected function setUp(): void {
        $this->taxRepository = new TaxRepository();
    }

    /**
     * Tests the taxForLocations method.
     *
     * This test checks if the method returns the correct number of rates
     * and if the price per minute of the first rate is equal to 1.90.
     */
    public function testTaxForLocations(): void {
        $taxes = $this->taxRepository->taxForLocations();
        $this->assertCount(6, $taxes);
        $this->assertEquals(1.90, $taxes[0]['priceForMinute']);
    }

    /**
     * Tests the findTaxForLocation method.
     *
     * This test checks if the method finds the correct rate for a valid
     * origin and destination and returns null for an invalid combination
     * of origin and destination.
     */
    public function testFindTaxForLocation(): void {
        $tax = $this->taxRepository->findTaxForLocation('011', '016', $this->taxRepository->taxForLocations());
        $this->assertNotNull($tax);
        $this->assertEquals(1.90, $tax['priceForMinute']);

        $tax = $this->taxRepository->findTaxForLocation('000', '016', $this->taxRepository->taxForLocations());
        $this->assertNull($tax);
    }
}
