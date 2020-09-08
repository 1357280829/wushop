<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Product\EditSku;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductParam;
use App\Models\ProductParamType;
use App\Models\ProductSku;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ProductsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '商品';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->quickSearch('name')->placeholder('快速搜索商品...');
        $grid->disableFilter();

        $grid->actions(function ($actions) {
            $actions->add(new EditSku());
        });

        $grid->column('id', 'ID');
        $grid->column('name', '商品名');
        $grid->column('stock', '库存')->sortable();
        $grid->column('sale_price', '销售价')->sortable();
        $grid->column('cost_price', '成本价')->sortable();
        $grid->column('minimum_price', '最低价')->sortable();
        $grid->column('is_on', '上架开关')->switch()->filter([0 => '已下架', 1 => '已上架']);
        $grid->column('is_enable_sku', 'SKU开关')->switch()->filter([0 => '已关闭', 1 => '已开启']);
        $grid->column('sort', '排序值')->editable()->sortable();
        $grid->column('on_at', '上架时间')->sortable();
        $grid->column('created_at', '创建时间')->sortable();

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->multipleImage('banner_urls', '轮播图')->removable();
        $form->image('cover_url', '封面图');

        $form->divider();

        $form->multipleSelect('productParamTypes', '规格类型')->options(ProductParamType::pluck('name', 'id'));
        $form->multipleSelect('categories', '所属分类')->options(Arr::except(Category::selectOptions(), 0));
        $form->text('name', '商品名')->rules('required');
        $form->number('stock', '当前库存量')->default(0);
        $form->currency('sale_price', '销售价')->symbol('￥');
        $form->currency('cost_price', '成本价')->symbol('￥');
        $form->switch('is_on', '上架开关');
        $form->switch('is_enable_sku', 'SKU开关');
        $form->number('sort', '排序值')->default(0);

        $form->divider();

        $form->editor('desc', '商品描述');
        $form->editor('detail_introduction', '商品介绍');
        $form->editor('detail_after_sale', '售后保障');

        $form->saved(function (Form $form) {
            if ($form->productParamTypes) {
                $form->model()->syncProductSku(array_filter($form->productParamTypes));
            }
            $form->model()->syncMinimumPrice();
        });

        return $form;
    }

    public function skusIndex(Content $content, Product $product)
    {
        $grid = new Grid(new ProductSku());

        $grid->disablePagination();
        $grid->disableCreateButton();
        $grid->disableFilter();
        $grid->disableRowSelector();
        $grid->disableExport();
        $grid->actions(function (Grid\Displayers\DropdownActions $actions) {
            $actions->disableView();
            $actions->disableEdit();
        });

        $grid->model()->collection(function (Collection $collection) {
            $productParamIdToNames = ProductParam::pluck('name', 'id')->toArray();
            $collection->each(function (ProductSku $productSku) use ($productParamIdToNames) {
                $productSku->product_params = array_map(function ($productParamId) use ($productParamIdToNames) {
                    return $productParamIdToNames[$productParamId];
                }, $productSku->product_param_ids);
            });

            return $collection;
        });

        $grid->column('id', 'ID');
        $grid->column('product_params', '规格sku')->label();
        $grid->column('is_enable', '是否开启')->switch([
            'on' => ['value' => 1],
            'off' => ['value' => 0],
        ]);
        $grid->column('stock', '库存')->editable();
        $grid->column('sale_price', '销售价')->editable();
        $grid->column('cost_price', '成本价')->editable();
        $grid->column('desc', '描述')->editable();

        return $content
            ->title($product->name)
            ->description('SKU')
            ->body($grid);
    }

    public function skuUpdate($productId, $productSkuId)
    {
        $form = new Form(new ProductSku());

        $form->switch('is_enable');
        $form->number('stock');
        $form->currency('sale_price');
        $form->currency('cost_price');
        $form->text('desc');

        $form->saved(function (Form $form) use ($productId) {
            Product::findOrFail($productId)->syncMinimumPrice();
        });

        return $form->update($productSkuId);
    }
}
