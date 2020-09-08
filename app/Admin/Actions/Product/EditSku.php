<?php

namespace App\Admin\Actions\Product;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class EditSku extends RowAction
{
    public $name = '编辑SKU';

    public function href()
    {
        return '/products/' . $this->getKey() . '/skus';
    }
}