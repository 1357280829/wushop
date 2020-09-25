<?php

namespace App\Admin\Controllers;

use App\Models\Freight;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class FreightsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '运费';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Freight());

        $grid->quickCreate(function (Grid\Tools\QuickCreate $create) {
            $create->text('price', '价格');
            $create->text('province', '省');
            $create->text('city', '市');
            $create->text('area', '区');
        });

        $grid->header(function ($query) {
            $customForm = new \Encore\Admin\Widgets\Form(Freight::getGlobalFreightSetting());

            $customForm->disableReset();
            $customForm->action(route('global-freight-setting.store', [], false));

            $customForm->radio('is_free', '是否统一免运费')->options([0 => '否', 1 => '是'])->default(0);
            $customForm->currency('global_price', '统一运费')->symbol('￥');

            return $customForm;
        });

        $grid->disableFilter();
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disablePagination();
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
        });

        $grid->column('id', 'ID');
        $grid->column('price', '价格');
        $grid->column('is_free', '是否免运费')->switch();
        $grid->column('province', '省');
        $grid->column('city', '市');
        $grid->column('area', '区');

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Freight());

        $form->currency('price', '价格')->symbol('￥')->rules('numeric');
        $form->switch('is_free', '是否免运费');
        $form->text('province', '省');
        $form->text('city', '市');
        $form->text('area', '区');

        return $form;
    }
}
