# yii2-date-range-picker
Date range picker input for Yii Framework 2 based on [Dan Grossman's bootstrap-daterangepicker](http://www.daterangepicker.com/).

Features:

* MaskedInput can be used to manually input date range.

* Since version 2.0.8 [daterangepicker](http://www.daterangepicker.com/) plugin can accept empty initial values.
To do this, set plugin option ```autoUpdateInput``` to ```false``` and use default ```callback``` option. 
See [https://github.com/dangrossman/bootstrap-daterangepicker/issues/815](https://github.com/dangrossman/bootstrap-daterangepicker/issues/815)
for details.


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). 

To install, either run

```
$ php composer.phar require jino5577/yii2-date-range-picker "*"
```

or add

```
"jino5577/yii2-date-range-picker": "*"
```

to the ```require``` section of your `composer.json` file.

## Usage

```php

use jino5577\daterangepicker\DateRangePicker;

echo DateRangePicker::widget([
    'model'     => $model,
    'attribute' => 'dateRange',
    
    // Optional. Used for calendar localization. 
    // IF `null` (default), default moment.js language will be used.
    'locale'    => 'ru-RU';
    // Daterange plugin options. Default is `null`.
    // See http://www.daterangepicker.com/#options
    'pluginOptions' => [
        /* ... */
        'autoUpdateInput' => false,
    ],
    // Optional. If maskOptions is set, MaskedInput will be used 
    // instead of TextInput. Default is `null`. 
    'maskOptions' => [
        'mask' => '99/99/9999 - 99/99/9999',
    ],
    // Optional. Input control options, 
    // default is `['class' => 'form-control']`.
    'options' => [
        /* ... */
    ],
    // Optional. Widget template, default is `{input}`. 
    // The special tag `{input}` will be replaced with the form input. 
    'template' => '
        <div class="input-group">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
             </span>
            {input}
        </div>
    '
    ],
    // Optional. Javascript callback to be passed to the 
    // plugin constructor. By default, updates the input 
    // and triggers `change` event.
    'callback' => 'function() { /* ... */ }';   
]);
```

## License

BSD 3-Clause License. Please see bundled `LICENSE.md` file for more information.
