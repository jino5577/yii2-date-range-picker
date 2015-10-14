<?php

/**
 * @copyright Copyright &copy; Dmitrij Butko, <jino5577@gmail.com>, 2015
 * @package yii2-date-range-picker
 * @version 1.0.0
 */

namespace jino5577\daterangepicker;

use yii\web\AssetBundle;

/**
 * DateRangePicker bundle.
 * @author Dmitrij Butko
 */
class DateRangePickerAsset extends AssetBundle
{

    public $sourcePath = '@bower/bootstrap-daterangepicker';

    public $css = [
        'daterangepicker.css',
    ];
    public $js = [
        'daterangepicker.js',
    ];

    public $publishOptions = [
        'only' => [
            'daterangepicker.css',
            'daterangepicker.js',
        ],
        'except' => [
            'website/'
        ]
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'jino5577\daterangepicker\MomentAsset'
    ];


}