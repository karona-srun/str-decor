<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSubGroups extends Model
{
    use HasFactory;

    public function ItemGroup()
    {
        return $this->belongsTo(ItemGroups::class,'item_group_id');
    }

}
