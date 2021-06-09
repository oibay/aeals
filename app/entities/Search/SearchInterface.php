<?php


namespace App\entities\Search;


interface SearchInterface
{
    public function getQuery();

    public function getFilterData();
}
