<?php

/**
 * Usage allowed, just keep the credits.
 */

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\CostCalculator;
use Src\PlanTalkMore;
use Src\Sanitizer;
use Src\TaxRepository;

class PlanTalkMoreTest extends TestCase {
    private $taxRepositoryMock;
    private $sanitizerMock;
    private $costCalculatorMock;

    protected function setUp(): void {
        $this->taxRepositoryMock = $this->createMock(TaxRepository::class);
        $this->sanitizerMock = $this->createMock(Sanitizer::class);
        $this->costCalculatorMock = $this->createMock(CostCalculator::class);
    }

    /**
    * Tests the calculation of plan costs with valid tax rates.
    *
    * This test simulates a scenario where a valid origin and destination
    * are provided, along with a specific call duration and plan. It mocks
    * the necessary dependencies to ensure the method behaves as expected
    * and verifies that the output matches the anticipated cost summary.
    *
    * @return void
    */
    public function testCalculatePlanCostWithValidTax(): void {
        $origin = '011';
        $destiny = '016';
        $time = 60;
        $plan = 30;

        $this->taxRepositoryMock
            ->method('taxForLocations')
            ->willReturn([
                ['origin' => '011', 'destiny' => '016', 'priceForMinute' => 1.90],
            ]);

        $this->taxRepositoryMock
            ->method('findTaxForLocation')
            ->with($this->equalTo($origin), $this->equalTo($destiny), $this->anything())
            ->willReturn(['priceForMinute' => 1.90]);

        $this->costCalculatorMock
            ->method('calculatePlanCost')
            ->with($this->equalTo($time), $this->equalTo($plan), $this->equalTo(1.90))
            ->willReturn("With the plan: R$ 62.70, Without the plan: R$ 114.00");

        (new PlanTalkMore(
            $origin,
            $destiny,
            $time,
            $plan
        ));

        $this->expectOutputString("With the plan: R$ 62.70, Without the plan: R$ 114.00\n");
    }

    /**
     * Tests the behavior of PlanTalkMore when given an invalid tax situation.
     *
     * This test simulates a scenario where an invalid origin is provided
     * along with a valid destination, call duration, and plan. It mocks
     * the necessary dependencies to simulate the absence of a valid tax
     * rate and verifies that the output indicates that no tax was found.
     *
     * @return void
     */
    public function testCalculatePlanCostWithInvalidTax(): void {
        $origin = '000';
        $destiny = '016';
        $time = 60;
        $plan = 30;
    
        $this->taxRepositoryMock
            ->method('taxForLocations')
            ->willReturn([
                ['origin' => '011', 'destiny' => '016', 'priceForMinute' => 1.90],
            ]);
    
        $this->taxRepositoryMock
            ->method('findTaxForLocation')
            ->with($this->equalTo($origin), $this->equalTo($destiny), $this->anything())
            ->willReturn(null);
    
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Tax not found for origin $origin and destination $destiny.");
    
        (new PlanTalkMore(
            $origin,
            $destiny,
            $time,
            $plan
        ));
    }
}

