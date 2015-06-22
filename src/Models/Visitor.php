<?php

namespace Kryptonit3\Counter\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'kryptonit3_counter_visitor';

    protected $fillable = ['visitor'];
    
    public $timestamps = false;

    public function pages()
    {
        return $this->belongsToMany('Kryptonit3\Counter\Models\Page', 'kryptonit3_counter_page_visitor', 'visitor_id', 'page_id');
    }
}
