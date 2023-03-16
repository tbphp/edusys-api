<?php

namespace App\Libs;

use Illuminate\Pagination\LengthAwarePaginator;

class ApiPaginator extends LengthAwarePaginator
{
    public function __construct($items, $total, $perPage, $currentPage = null, array $options = [])
    {
        parent::__construct($items, $total, $perPage, $currentPage, $options);
    }

    /**
     * 设置总数
     * @param int $total
     * @return $this
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;
        $this->lastPage = max((int)ceil($total / $this->perPage()), 1);

        return $this;
    }

    /**
     * 设置每页数量
     * @param int $perPage
     * @return $this
     */
    public function setPerPage(int $perPage): self
    {
        $this->perPage = $perPage;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'list' => $this->items->toArray(),
            'total' => $this->total(),
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
            'per_page' => intval($this->perPage()),
            'from' => $this->firstItem() ?? 0,
            'to' => $this->lastItem() ?? 0,
        ];
    }
}
