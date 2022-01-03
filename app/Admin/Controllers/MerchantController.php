<?php

namespace App\Admin\Controllers;

use App\Models\Merchant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Ramsey\Uuid\Uuid;

class MerchantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '商戶';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Merchant());

        $grid->column('uid', __('Uid'));
        $grid->column('name', __('Name'));
        $grid->column('user_id', __('User id'));
        $grid->column('code', __('Code'));
        $grid->column('expired_at', __('Expired at'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Merchant::findOrFail($id));

        $show->field('uid', __('Uid'));
        $show->field('name', __('Name'));
        $show->field('user_id', __('User id'));
        $show->field('code', __('Code'));
        $show->field('expired_at', __('Expired at'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Merchant());

        $form->text('uid', __('Uid'))->readonly();
        $form->text('name', __('Name'));
        $form->number('user_id', __('User id'));
        $form->text('code', __('Code'));
        $form->datetime('expired_at', __('Expired at'))->default(date('Y-m-d H:i:s'));
        $form->switch('status', __('Status'));

        $form->saving(function (Form $form) {
            $form->uid = Uuid::uuid4();
        });

        return $form;
    }
}
