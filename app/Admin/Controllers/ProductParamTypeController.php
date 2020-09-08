<?php

namespace App\Admin\Controllers;

use App\Models\ProductParamType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ProductParamTypeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '商品规格';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductParamType());

        $grid->disableFilter();

        $grid->model()->collection(function (Collection $collection) {
            $collection->each(function (ProductParamType $productParamType) {
                $productParamType->param_names = $productParamType->params->pluck('name')->toArray();
            });

            return $collection;
        });

        $grid->column('id', 'ID');
        $grid->column('name', '类型');
        $grid->column('param_names', '规格')->label();

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductParamType());

        $form->text('name', '类型');
        $form->hasMany('params', '', function (Form\NestedForm $form) {
            $form->text('name', '可选值');
        });

        return $form;
    }
}
