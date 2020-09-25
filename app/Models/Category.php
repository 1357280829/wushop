<?php

namespace App\Models;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, ModelTree;

    protected $fillable = [
        'name', 'cover_url', 'parent_id', 'sort',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('name');
    }
}
