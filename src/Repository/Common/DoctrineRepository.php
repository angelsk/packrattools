<?php

namespace App\Repository\Common;

interface DoctrineRepository
{
    /**
     * @return string
     */
    public function getEntityClass(): string;
}
