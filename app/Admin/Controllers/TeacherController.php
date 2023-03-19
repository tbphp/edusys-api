<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\Message;
use App\Models\School;
use App\Models\Teacher;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Show;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class TeacherController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '教师';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Teacher());

        $grid->model()
            ->latest('id')
            ->withCount(['schools', 'ownerSchools', 'fans']);

        $grid->model()->collection(function (Collection $schools) {
            /** @var Teacher $school */
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
        $grid->column('username', '邮箱');
        $grid->column('line_id', __('Bind Line'))->bool();
        $grid->column('owner_schools_count', '管理学校')->label('primary');
        $grid->column('schools_count', '加入学校')->label('default');
        $grid->column('fans_count', '粉丝数')->label('default');
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
        $show = new Show(Teacher::withCount(['schools', 'ownerSchools', 'fans'])->findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Names'));
        $show->field('username', '邮箱');
        $show->field('line_id', 'Line ID');
        $show->field('owner_schools_count', '管理学校');
        $show->field('schools_count', '加入学校');
        $show->field('fans_count', '粉丝数');
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
        $form = new Form(new Teacher());

        $form->text('name', __('Names'))->required();
        $form->text('username', '邮箱')
            ->required()
            ->creationRules('unique:teachers|email')
            ->updateRules('unique:teachers,username,{{id}}|email');
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
