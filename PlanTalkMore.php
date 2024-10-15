<?php
declare(strict_types=1);

namespace Service;

/**
 * Usage allowed, just keep the credits.
 */

class PlanTalkMore {
    
    /**
     * @var array List of taxes by location
     */
    private array $taxes;

    /**
     * Class constructor
     * @param string $origin Origin code
     * @param string $destiny Destination code
     * @param int $time Call duration
     * @param int $plan Chosen plan (30, 60, 120)
     */
    public function __construct(string $origin, string $destiny, int $time, int $plan) {
        $this->taxes    = $this->taxForLocations();
        $origin         = $this->sanitizeNumber($origin);
        $destiny        = $this->sanitizeNumber($destiny);
        $time           = (int) $this->sanitizeNumber((string) $time);
        $plan           = (int) $this->sanitizeNumber((string) $plan);
        
        $tax = $this->findTaxForLocation($origin, $destiny);
        
        if (!$tax) {
            echo "Tax not found for origin $origin and destination $destiny.";
            exit();
        }

        echo $this->calculatePlanCost($time, $plan, $tax['priceForMinute']);
    }

    /**
     * Sanitizes the number by removing non-numeric characters
     * @param string $number Number to sanitize
     * @return string Sanitized number
     */
    private function sanitizeNumber(string $number): string {
        return preg_replace('/[^\d]/', '', $number);
    }

    /**
     * Calculates the call cost with and without the plan
     * @param int $time Call duration
     * @param int $plan Chosen plan
     * @param float $taxForMin Tax per minute
     * @return string Calculation result
     */
    private function calculatePlanCost(int $time, int $plan, float $taxForMin): string {
        
        if (!in_array($plan, [30, 60, 120])) {
            return "Please select a valid plan: 30, 60, or 120 minutes.";
        }
    
        $extraMinutes   = max(0, $time - $plan);
        $planCost       = $extraMinutes * $taxForMin * 1.1;
        $noPlanCost     = $time * $taxForMin;
    
        return sprintf(
            "With the plan: R$ %.2f, Without the plan: R$ %.2f",
            $planCost,
            $noPlanCost
        );
    }

    /**
     * Finds the tax for the given origin and destination
     * @param string $origin Origin
     * @param string $destiny Destination
     * @return array|null Found tax or null
     */
    private function findTaxForLocation(string $origin, string $destiny): ?array {
        foreach ($this->taxes as $tax) {
            if ($tax['origin'] === $origin && $tax['destiny'] === $destiny) {
                return $tax;
            }
        }
        return null;
    }

    /**
     * Returns the list of taxes by location
     * @return array List of taxes
     */
    private function taxForLocations(): array {
        return [
            ['origin' => '011', 'destiny' => '016', 'priceForMinute' => 1.90],
            ['origin' => '016', 'destiny' => '011', 'priceForMinute' => 2.90],
            ['origin' => '011', 'destiny' => '017', 'priceForMinute' => 1.70],
            ['origin' => '017', 'destiny' => '011', 'priceForMinute' => 2.70],
            ['origin' => '011', 'destiny' => '018', 'priceForMinute' => 0.90],
            ['origin' => '018', 'destiny' => '011', 'priceForMinute' => 1.90]
        ];
    }
}
