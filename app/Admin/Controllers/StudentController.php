<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\Message;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Show;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class StudentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '学生';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Student());

        $grid->model()->latest('id');

        $grid->model()->collection(function (Collection $schools) {
            /** @var Student $school */
            foreach ($schools as $school) {
                $school->makeVisible('line_id');
            }
            return $schools;
        });

        $grid->filter(function (Filter $filter) {
            $filter->like('name', __('Names'));
            $filter->like('username', '邮箱');
        });

        $grid->actions(function (Actions $actions) {
            $actions->add(new Message);
        });

        $grid->column('id', __('Id'));
        $grid->column('name', __('Names'));
        $grid->column('username', __('Username'));
        $grid->column('school.name', '学校');
        $grid->column('line_id', __('Bind Line'))->bool();
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
        $show = new Show(Student::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Names'));
        $show->field('username', __('Username'));
        $show->field('school.name', '学校');
        $show->field('line_id', 'Line ID');
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
        $form = new Form(new Student());

        $form->editing(function (Form $form) {
            $form->model()->makeVisible(['school_id']);
        });

        $form->text('name', __('Names'))
            ->required()
            ->rules('required|string|min:2|max:50');
        $form->text('username', __('Username'))
            ->required()
            ->creationRules('required|string|min:4|max:50|unique:students')
            ->updateRules('required|string|min:4|max:50|unique:students,username,{{id}}');
        $form->select('school_id', '学校')
            ->options(School::pluck('name', 'id'))
            ->required();
        $form->password('password', '密码')
            ->creationRules('required|string|min:6|max:32')
            ->updateRules('nullable|string|min:6|max:32');

        $form->submitted(function (Form $form) {
            if (request()->filled('password')) {
                $form->password = Hash::make(request('password'));
            } else {
                $form->ignore('password');
            }
        });

        return $form;
    }
}
