<?php

namespace App\Entity\Common;

trait CostTrait
{
    /**
     * @var int
     *
     * @ORM\Column(name="credit_cost", type="smallint", nullable=false, options={"default" = 0})
     */
    public $creditCost = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="ticket_cost", type="smallint", nullable=false, options={"default" = 0})
     */
    public $ticketCost = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="draw_cost", type="smallint", nullable=false, options={"default" = 0})
     */
    public $drawCost = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="rat_cost", type="smallint", nullable=false, options={"default" = 0})
     */
    public $ratCost = 0;

    /**
     * @param string $separator
     *
     * @return string
     */
    public function getCost(string $separator = ', '): string
    {
        $totalCost = [];

        if (0 !== $this->ticketCost) {
            $totalCost[] = $this->ticketCost . ' tickets';
        }
        if (0 !== $this->creditCost) {
            $totalCost[] = $this->creditCost . ' credits';
        }
        if (0 !== $this->drawCost) {
            $totalCost[] = $this->drawCost . ' draw card' . (1 !== $this->drawCost ? 's' : '');
        }
        if (0 !== $this->ratCost) {
            $totalCost[] = $this->ratCost . ' rat card' . (1 !== $this->ratCost ? 's' : '');
        }

        return implode($separator, $totalCost);
    }
}
