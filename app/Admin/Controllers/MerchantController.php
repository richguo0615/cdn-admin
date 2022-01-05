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
    protected $title = 'Merchant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Merchant());

        $grid->column('uuid', __('Uuid'));
        $grid->column('name', __('Name'));
        $grid->column('expired_at', __('Expired at'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('user_id', __('User id'));
        $grid->column('cdn_plan_id', __('Cdn plan id'));
        $grid->column('default_line_id', __('Default line id'));
        $grid->column('deliver_domain_id', __('Deliver domain id'));
        $grid->column('code', __('Code'));

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

        $show->field('uuid', __('Uuid'));
        $show->field('name', __('Name'));
        $show->field('expired_at', __('Expired at'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('user_id', __('User id'));
        $show->field('cdn_plan_id', __('Cdn plan id'));
        $show->field('default_line_id', __('Default line id'));
        $show->field('deliver_domain_id', __('Deliver domain id'));
        $show->field('code', __('Code'));

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

        // $form->text('uuid', __('Uuid'))->readonly();
        $form->text('name', __('Name'));
        $form->date('expired_at', __('Expired at'))->default(date('Y-m-d H:i:s'));
        $form->text('code', __('Code'));
        $form->switch('status', __('Status'));
        $form->number('user_id', __('User id'));
        $form->number('cdn_plan_id', __('Cdn plan id'));
        $form->number('default_line_id', __('Default line id'));
        $form->number('deliver_domain_id', __('Deliver domain id'));
        $form->saving(function (Form $form) {
            $form->input('uuid', Uuid::uuid4());
            $form->hidden('uuid')->default('');
        });

        return $form;
    }
}
