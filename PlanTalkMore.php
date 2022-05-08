<?php

class PlanTalkMore {
    
    /**
     * Return tax to specific location
     * @param $origin :: Origin 
     * @param $destiny :: Destiny
     * @param $time :: Call time
     * @param $plan :: Plan choise (example 30, 60, 120)
     */

    public function __construct($origin, $destiny, $time, $plan) {
        foreach ($this->taxForLocations() as $value) {
            if ($value['origin'] === preg_replace('/[^\d]/i', '', $origin) && $value['destiny'] === preg_replace('/[^\d]/i', '', $destiny)) :
                echo $this->plans(preg_replace('/[^\d]/i', '', $time), preg_replace('/[^\d]/i', '', $plan), $value['priceForMinute']);
            endif;
        }
    }

    /**
     * Return call time value
     * @param $time :: Call time
     * @param $plan :: Plan choised (example 30, 60, 120)
     * @param $taxForMin :: Tax for minute
     */

    private function plans($time, $plan, $taxForMin) {
        if (in_array($plan, [30, 60, 120])) {
            $plan   = (($time - $plan) * $taxForMin) * 1.1;
            $noPlan = $time * $taxForMin;
            echo "Com {$plan}, sem {$noPlan}";
            /*return [
                'plan'      => (($time - $plan) * $taxForMin) * 1.1,
                'noPlan'    => $time * $taxForMin
            ];*/
        } else {
            echo "Defina um plano fale mais de 30, 60 ou 120";
        }
    }

    /**
     * Return tax for locations
     */
    private function taxForLocations() {
        return [
            [
                'origin' => '011',
                'destiny' => '016',
                'priceForMinute' => 1.90
            ],
            [
                'origin' => '016',
                'destiny' => '011',
                'priceForMinute' => 2.90
            ],
            [
                'origin' => '011',
                'destiny' => '017',
                'priceForMinute' => 1.70
            ],
            [
                'origin' => '017',
                'destiny' => '011',
                'priceForMinute' => 2.70
            ],
            [
                'origin' => '011',
                'destiny' => '018',
                'priceForMinute' => 0.90
            ],
            [
                'origin' => '018',
                'destiny' => '011',
                'priceForMinute' => 1.90
            ]
        ];
    }
}

(new PlanTalkMore('018', '011', 200, 120));
