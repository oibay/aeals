<?php


namespace App\entities\Search;


use Illuminate\Support\Facades\DB;

class SearchGuest implements SearchInterface
{
    private $filterData;
    private $query;

    public function __construct($filterData)
    {
        $this->query = DB::table('guests')
                       ->join('guest_times','guests.id','=','guest_times.guest_id')
                        ->select('guests.id','guests.name','guests.passport','guests.phone','guests.location',
                            'guests.room','guests.room_type',
                            'guest_times.entry','guest_times.departure',
                            'users.name as company'
                        )
                        ->join('users','users.id','=','guests.user_id')
                       ->where('status',1)
                       ->where('room','<>',null);

        $this->filterData = $filterData;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getFilterData()
    {
        return $this->filterData;
    }
}
