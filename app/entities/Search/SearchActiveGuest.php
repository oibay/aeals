<?php


namespace App\entities\Search;


class SearchActiveGuest implements SearchInterface
{
    private $filterData;
    private $query;

    public function __construct(SearchInterface $filterData)
    {
        $this->query = $filterData->getQuery();
        $this->filterData = $filterData->getFilterData();
    }
    public function getQuery()
    {
        if ($this->filterData['company']) {
            $this->query = $this->query->where('guests.user_id', '=', $this->filterData['company']);
        }

        if ($this->filterData['location']) {
            $this->query = $this->query->where('guests.location', '=', $this->filterData['location']);
        }

        if ($this->filterData['vouchers']) {
            $this->query = $this->query->where('guests.vouchers', '<>', '0');
        }

        if ($this->filterData['entry']) {
            $this->query = $this->query
                ->whereDate('guest_times.entry', '=', date('Y-m-d',strtotime($this->filterData['entry'])));
        }

        if ($this->filterData['departure']) {

            $this->query = $this->query
                ->whereDate('guest_times.departure', '=', date('Y-m-d',strtotime($this->filterData['departure'])));
        }

        return $this->query;
    }

    public function getFilterData()
    {
        return $this->_contactsFilterData;
    }
}
