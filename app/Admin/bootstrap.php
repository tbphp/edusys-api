<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid\Column;

Form::forget(['map', 'editor']);

// 时间格式化
Column::extend('dt', function ($value) {
    return Carbon::createFromTimestamp($value)
        ->format('Y-m-d H:i:s');
});
