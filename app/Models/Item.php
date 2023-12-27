<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function ItemSubGroups()
    {
        return $this->belongsTo(ItemSubGroups::class,'item_sub_group_id');
    }

    public function ItemGroups()
    {
        return $this->belongsTo(ItemGroups::class,'item_group_id');
    }
}
