<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryLabel extends Model
{
    protected $table = 'data_category_labels';

    protected $fillable = ['category_label_name', 'status'];
}
