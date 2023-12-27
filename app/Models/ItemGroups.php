<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroups extends Model
{
    use HasFactory;

    public function ItemSubGroups()
    {
        return $this->belongsTo(ItemSubGroups::class,'id','item_group_id');
    }

}
