<?php

namespace App\Traits;

/**
 * Trait Sortable
 * @package App\Traits
 */
trait Sortable
{
    /**
     * @var string
     */
    public $sortBy = 'created_at';

    /**
     * @var string
     */
    public $sortOrder = 'asc';

    /**
     * @param string $sortBy
     */
    public function setSortBy($sortBy = 'created_at')
    {
        $this->sortBy = $sortBy;
    }

    /**
     * @param string $sortOrder
     */
    public function setSortOrder($sortOrder = 'desc')
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return self::orderBy($this->sortBy, $this->sortOrder)
            ->get();
    }
}
