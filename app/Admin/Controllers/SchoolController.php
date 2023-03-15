<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\Approve;
use App\Admin\Actions\Post\Reject;
use App\Enums\SchoolStatusEnum;
use App\Models\School;
use App\Models\Teacher;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Show;
use Illuminate\Database\Eloquent\Collection;

class SchoolController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '学校';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new School());

        $grid->model()->collection(function (Collection $schools) {
            /** @var School $school */
            foreach ($schools as $school) {
                $school->makeVisible(['status', 'reject_reason']);
                $school->append('status_text');
            }
            return $schools;
        });

        $grid->filter(function (Filter $filter) {
            $filter->like('name', __('Name'));
            $filter->equal('status', __('Status'))->select(SchoolStatusEnum::getKeyValue());
            $filter->equal('owner_id', __('Owner'))->select(Teacher::pluck('name', 'id'));
        });

        $grid->actions(function (Actions $actions) {
            if ($actions->row->status === SchoolStatusEnum::PENDDING) {
                $actions->add(new Approve);
                $actions->add(new Reject);
            }
        });

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('owner.name', __('Owner'));
        $grid->column('status_text', __('Status'));
        $grid->column('reject_reason', __('Reject reason'));
        $grid->column('created_at', __('Created at'))->dt();
        $grid->column('updated_at', __('Updated at'))->dt();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id): Show
    {
        $show = new Show(School::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('owner.name', __('Owner'));
        $show->field('status_text', __('Status'));
        $show->field('reject_reason', __('Reject reason'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new School());

        $form->editing(function (Form $form) {
            $form->model()
                ->makeVisible(['status', 'reject_reason', 'owner_id'])
                ->append('status_text');
        });

        $form->saving(function (Form $form) {
            /** @var School $school */
            $school = $form->model();
            $school->teachers()->attach($school->owner_id);
        });

        $form->text('name', __('Name'));
        $form->select('owner_id', __('Owner'))
            ->options(Teacher::pluck('name', 'id'));
        $form->radio('status', __('Status'))
            ->when(SchoolStatusEnum::REJECTED, function (Form $form) {
                $form->text('reject_reason', __('Reject reason'));
            })
            ->options(SchoolStatusEnum::getKeyValue())
            ->default(SchoolStatusEnum::NORMAL);

        return $form;
    }
}
