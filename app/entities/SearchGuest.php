<?php


namespace App\entities;


use App\Models\Guest;

class SearchGuest
{
    protected ?string $company;
    protected ?string $location;
    protected ?string $room_type;
    protected ?string $entry;
    protected ?string $departure;
    protected ?string $vouchers;

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string|null $company
     * @return SearchGuest
     */
    public function setCompany(?string $company): SearchGuest
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string|null $location
     * @return SearchGuest
     */
    public function setLocation(?string $location): SearchGuest
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRoomType(): ?string
    {
        return $this->room_type;
    }

    /**
     * @param string|null $room_type
     * @return SearchGuest
     */
    public function setRoomType(?string $room_type): SearchGuest
    {
        $this->room_type = $room_type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntry(): ?string
    {
        return $this->entry;
    }

    /**
     * @param string|null $entry
     * @return SearchGuest
     */
    public function setEntry(?string $entry): SearchGuest
    {
        $this->entry = $entry;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    /**
     * @param string|null $departure
     * @return SearchGuest
     */
    public function setDeparture(?string $departure): SearchGuest
    {
        $this->departure = $departure;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVouchers(): ?string
    {
        return $this->vouchers;
    }

    /**
     * @param string|null $vouchers
     * @return SearchGuest
     */
    public function setVouchers(?string $vouchers): SearchGuest
    {
        $this->vouchers = $vouchers;
        return $this;
    }


    public function searchGuest()
    {
        //dd($this->getCompany());
        $search = Guest::query()
            ->join('guest_times','guests.id','=','guest_times.guest_id')
            ->where('user_id','LIKE',"%{$this->getCompany()}%")
            ->where('location','LIKE',"%{$this->getLocation()}%")
            ->where('room_type','LIKE',"%{$this->getRoomType()}%")

            ->where('status',1)->get();

        return $search;
    }




}
