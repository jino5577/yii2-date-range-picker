# yii2-date-range-picker
Date range picker input for Yii Framework 2 based on [Dan Grossman's bootstrap-daterangepicker](http://www.daterangepicker.com/).

Features:

* MaskedInput can be used to manually input date range.

* Since version 2.0.8 [daterangepicker](http://www.daterangepicker.com/) plugin can accept empty initial values.
To do this set plugin option ```autoUpdateUnput``` to ```false``` and use default ```callback``` option. 
See [https://github.com/dangrossman/bootstrap-daterangepicker/issues/815](https://github.com/dangrossman/bootstrap-daterangepicker/issues/815)
for details


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). 

To install, either run

```
$ php composer.phar require jino5577/date-range-picker "*"
```

or add

```
"jino5577/date-range-picker": "*"
```

to the ```require``` section of your `composer.json` file.

## Usage

```php

use jino5577\daterangepicker\DateRangePicker;

echo DateRangePicker::widget([
    'model'     => $model,
    'attribute' => 'dateRange',
    'locale'    => 'ru-RU';
    'pluginOptions'=>[
        /* ... plugin options here ... */
        'autoUpdateInput' => false,
    ],
    /* if maskOptions is set, MaskedInput wil be used instead of TextInput */
    'maskOptions' => [
        'mask' => '99/99/9999 - 99/99/9999',
    ],

    
]);
```

## License

BSD 3-Clause License. Please see bundled `LICENSE.md` file for more information.