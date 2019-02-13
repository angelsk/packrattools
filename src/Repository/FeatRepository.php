<?php

namespace App\Repository;

interface FeatRepository
{
    /**
     * @return array
     */
    public function getStatistics(): array;
}
