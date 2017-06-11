<?php
/**
 * Milica Djordjevic 2016/3120
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    protected $fillable = ['latest_change', 'latest_run', 'count', 'seed', 'status', 'fail_description'];
    public $timestamps = false;
}
