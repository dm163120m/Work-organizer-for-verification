<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports_Tests extends Model
{
    protected $table = 'reports_tests';

    public function tests(){
        return $this->belongsTo('App\Test', 'id', 'id_test');
    }

    public function reports(){
        return $this->belongsTo('App\Report', 'id', 'id_report');
    }
}