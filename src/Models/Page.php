<?php

namespace Kryptonit3\Counter\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'kryptonit3_counter_page';

    protected $fillable = ['page'];
    
    public $timestamps = false;

    public function visitors()
    {
        return $this->belongsToMany('Kryptonit3\Counter\Models\Visitor', 'kryptonit3_counter_page_visitor', 'page_id', 'visitor_id');
    }
}
