<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Tree;

class CategoriesController extends AdminController
{
    public function index(Content $content)
    {
        $tree = new Tree(new Category);
        $tree->branch(function ($branch) {
            return "<strong>{$branch['name']}</strong>";
        });

        return $content
            ->header('分类管理')
            ->body($tree);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());

        $form->select('parent_id', '父级分类')
            ->options(Category::selectOptions(null, '顶级'))
            ->rules('required');
        $form->text('name', '分类名称')->rules('required');
        $form->image('cover_url', '封面图');
        $form->number('sort', '排序值');

        return $form;
    }
}
