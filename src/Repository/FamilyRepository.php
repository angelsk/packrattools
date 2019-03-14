<?php

namespace App\Repository;

interface FamilyRepository
{
    /**
     * @return array
     */
    public function getStatistics(): array;

    /**
     * @return array
     */
    public function getCardStatistics(): array;
}
