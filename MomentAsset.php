<?php

/**
 * @copyright Copyright &copy; Dmitrij Butko, <jino5577@gmail.com>, 2015
 * @package yii2-date-range-picker
 * @version 1.0.0
 */

namespace jino5577\daterangepicker;

use yii\web\AssetBundle;

/**
 * MomentAsset bundle
 * @author Dmitrij Butko
 */
class MomentAsset extends AssetBundle
{
    /**
     * @var string locale for moment.js
     */
    public static $locale;

    public $sourcePath = '@bower/moment';

    public $publishOptions = [
        'only' => [
            'min/*.js',
            'locale/*.js',
            'moment.js'
        ],
        'except' => [
            'src/',
            'templates/',
            'min/tests.js'
        ]
    ];

    public function init()
    {
        $this->js[] = (YII_DEBUG) ? 'moment.js' : 'min/moment.min.js';
        
        $localePath = \Yii::getAlias($this->sourcePath . DIRECTORY_SEPARATOR . 'locale');
        if (isset(static::$locale)) {
            $locale = strtolower(static::$locale);
            $fallbackLocale = substr($locale, 0, 2);
            if (is_file($localePath . DIRECTORY_SEPARATOR . $locale . '.js')) {
                $this->js[] = "locale/{$locale}.js";
            } elseif ($locale != $fallbackLocale
                    && (is_file($localePath . DIRECTORY_SEPARATOR . $fallbackLocale . '.js'))) {
                $this->js[] = "locale/{$fallbackLocale}.js";
            }
        }
    }
}
