<?php

/**
 * Usage allowed, just keep the credits.
 */

declare(strict_types=1);

namespace Src;

class CostCalculator {

    /**
     * Calculates the cost of a call based on the time, selected plan, and tax rate.
     *
     * @param int $time The duration of the call in minutes.
     * @param int $plan The chosen plan duration (30, 60, or 120 minutes).
     * @param float $taxForMin The cost per minute for the call.
     *
     * @return string A formatted string indicating the costs with and without the selected plan.
     */
    public function calculatePlanCost(int $time, int $plan, float $taxForMin): string {
        if (!in_array($plan, [30, 60, 120])) {
            return "Please select a valid plan: 30, 60, or 120 minutes.";
        }

        $extraMinutes = max(0, $time - $plan);
        $planCost = $extraMinutes * $taxForMin * 1.1;
        $noPlanCost = $time * $taxForMin;

        return sprintf(
            "With the plan: R$ %.2f, Without the plan: R$ %.2f",
            $planCost,
            $noPlanCost
        ).PHP_EOL;
    }
}
