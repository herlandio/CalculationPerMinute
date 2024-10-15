<?php

/**
 * Usage allowed, just keep the credits.
 */

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\CostCalculator;

/**
 * Class CostCalculatorTest
 *
 * Tests for the CostCalculator class, which calculates the costs of calls
 * based on the call duration, selected plan, and rate per minute.
 */
class CostCalculatorTest extends TestCase {
    private CostCalculator $costCalculator;

    /**
     * Setup method that runs before each test.
     * Instantiates the CostCalculator class.
     */
    protected function setUp(): void {
        $this->costCalculator = new CostCalculator();
    }

    /**
     * Tests the calculation of plan costs.
     *
     * This test checks if the result of the cost calculation includes
     * information about the costs with and without the plan for different
     * durations and rates.
     */
    public function testCalculatePlanCost(): void {
        $result = $this->costCalculator->calculatePlanCost(100, 60, 1.90);
        $this->assertStringContainsString('With the plan: R$', $result);
        $this->assertStringContainsString('Without the plan: R$', $result);

        $result = $this->costCalculator->calculatePlanCost(30, 30, 2.00);
        $this->assertStringContainsString('With the plan: R$', $result);
        $this->assertStringContainsString('Without the plan: R$', $result);
    }

    /**
     * Tests the behavior when an invalid plan is passed.
     *
     * This test checks if the method returns the correct message when an
     * invalid plan is provided (not 30, 60, or 120 minutes).
     */
    public function testInvalidPlan(): void {
        $result = $this->costCalculator->calculatePlanCost(100, 15, 1.90);
        $this->assertEquals("Please select a valid plan: 30, 60, or 120 minutes.", $result);
    }
}
