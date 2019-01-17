<?php

namespace App\Entity\Store;

trait SortTrait
{
    public function up()
    {
        if($this->sort == self::firstBySort()->sort) {
            return $this;
        }

        $currentSort = $this->sort;
        $beforeItem = self::where('sort', $currentSort-1)->first();

        $this->update(['sort' => $beforeItem->sort]);
        $beforeItem->update(['sort' => $currentSort]);
        return $this;
    }

    public function down()
    {
        if($this->sort == self::lastBySort()->sort) {
            return $this;
        }

        $currentSort = $this->sort;
        $afterItem = self::where('sort', $currentSort+1)->first();

        $this->update(['sort' => $afterItem->sort]);
        $afterItem->update(['sort' => $currentSort]);
        return $this;

    }

    public function first()
    {
        $firstItem = self::firstBySort();

        if($this->sort == $firstItem->sort) {
            return $this;
        }

        $beforeItems = self::where('sort', '<', $this->sort)->get();
        $this->update(['sort' =>  $firstItem->sort]);
        foreach($beforeItems as $item) {
            $item->sort++;
            $item->update();
        }

        return $this;
    }

    public function last()
    {
        $lastItem = self::lastbySort();

        if($this->sort == $lastItem->sort) {
            return $this;
        }

        $afterItems = self::where('sort', '>', $this->sort)->get();
        $this->update(['sort' => $lastItem->sort]);
        foreach($afterItems as $item) {
            $item->sort--;
            $item->update();
        }
        return $this;
    }

    public static function firstBySort()
    {
        return self::orderBy('sort', 'asc')->first();
    }

    public static function lastBySort()
    {
        return self::orderBy('sort', 'desc')->first();
    }

    public static function _append(array $data)
    {
        if($last = self::lastBySort()) {
            $data['sort'] = ++$last->sort;
        } else {
            $data['sort'] = 0;
        }
        return self::create($data);
    }

    public function remove()
    {
        $this->last();
        return $this->delete();
    }

    public static function allBySort(string $sort = 'asc')
    {
        return self::orderBy('sort', $sort)->get();
    }

    public static function refreshSort()
    {
        $items = self::allBySort();

        foreach($items as $k=>$item)
        {
            $item->update(['sort' => $k]);
        }

    }
}