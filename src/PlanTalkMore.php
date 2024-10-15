<?php

/**
 * Usage allowed, just keep the credits.
 */

declare(strict_types=1);

namespace Src;

/**
 * Usage allowed, just keep the credits.
 */
class PlanTalkMore {
    
    private TaxRepository $taxRepository;
    private Sanitizer $sanitizer;
    private CostCalculator $costCalculator;

    /**
     * Class constructor
     *
     * @param string $origin Origin code
     * @param string $destiny Destination code
     * @param int $time Call duration
     * @param int $plan Chosen plan (30, 60, 120)
     */
    public function __construct(string $origin, string $destiny, int $time, int $plan) {
        $this->taxRepository    = new TaxRepository();
        $this->sanitizer        = new Sanitizer();
        $this->costCalculator   = new CostCalculator();

        $taxes      = $this->taxRepository->taxForLocations();
        $origin     = $this->sanitizer->sanitizeNumber($origin);
        $destiny    = $this->sanitizer->sanitizeNumber($destiny);
        $time       = (int) $this->sanitizer->sanitizeNumber((string) $time);
        $plan       = (int) $this->sanitizer->sanitizeNumber((string) $plan);
        
        $tax = $this->taxRepository->findTaxForLocation($origin, $destiny, $taxes);
        
        if (!$tax) {
            throw new \InvalidArgumentException("Tax not found for origin $origin and destination $destiny.");
        }

        echo $this->costCalculator->calculatePlanCost($time, $plan, $tax['priceForMinute']);
    }
}
