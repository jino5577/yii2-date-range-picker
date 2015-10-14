<?php

/**
 * @copyright Copyright &copy; Dmitrij Butko, <jino5577@gmail.com>, 2015
 * @package yii2-date-range-picker
 * @version 1.0.0
 */

namespace jino5577\daterangepicker;

use yii\helpers\ArrayHelper;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\MaskedInput;

/**
 * @author Dmitrij Butko
 */
class DateRangePicker extends InputWidget
{
     /**
     * @var string the javascript callback to be passed to the plugin constructor.
     */
    public $callback = <<<JS
function() {
    if (this.element.is('input') && !this.singleDatePicker) {
        this.element.val(this.startDate.format(this.locale.format) 
            + this.locale.separator + this.endDate.format(this.locale.format));
        this.element.trigger('change');
    } else if (this.element.is('input')) {
        this.element.val(this.startDate.format(this.locale.format));
        this.element.trigger('change');
    }
}
JS;

    /**
     * @var string|null locale for moment.js. Used for display localized month and week names.
     * @link http://momentjs.com/docs/#/i18n/
     */
     public $locale;

     /**
     * @var array|null settings for MaskedInput. If provided, MaskedInput will be used instead of TextInput.
     */
     public $maskOptions;

    /**
     * @var array Date range plugin settings
     * @link http://www.daterangepicker.com/#options
     */
    public $pluginOptions;

    /**
     * @var array The HTML attributes for the input tag.
     */
    public $options = ['class' => 'form-control'];
    
    /**
     * @var string the template to render. The special tag `{input}` will be replaced with the form input.
     */
    public $template = '{input}';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (isset($this->locale) && !isset($this->pluginOptions['locale']['monthNames'])) {
            $this->pluginOptions['locale']['monthNames'] = new JsExpression("moment.months()");
        }
        if (isset($this->locale) && !isset($this->pluginOptions['locale']['daysOfWeek'])) {
            $this->pluginOptions['locale']['daysOfWeek'] = new JsExpression("moment.weekdaysMin()");
        }
        if (isset($this->locale) && !isset($this->pluginOptions['locale']['firstDay'])) {
            $this->pluginOptions['locale']['firstDay'] = new JsExpression("moment.localeData().firstDayOfWeek()");
        }

    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        parent::run();
        $view = $this->getView();

        if (is_array($this->maskOptions)) {
            if ($this->hasModel()) {
                $this->maskOptions = ArrayHelper::merge($this->maskOptions, [
                    'options' => $this->options,
                    'model' => $this->model,
                    'attribute' =>$this->attribute
                ]);
            } else {
                $this->maskOptions = ArrayHelper::merge($this->maskOptions, [
                    'options' => $this->options,
                    'name' => $this->name,
                    'value' =>$this->value
                ]);
            }
            $input = MaskedInput::widget($this->maskOptions);
        } else {
            $input = $this->hasModel()
                ? Html::activeTextInput($this->model, $this->attribute, $this->options)
                : Html::textInput($this->name, $this->value, $this->options);
        }

        $options = Json::encode($this->pluginOptions);
        $callback = (isset($this->callback)) ? ", {$this->callback}" : '';

        $script = "moment.locale('{$this->locale}');";
        $script .= "$('#{$this->options['id']}').daterangepicker({$options}{$callback});";
        $view->registerJs($script);

        echo strtr($this->template, ['{input}' => $input]);
        
        MomentAsset::$locale = $this->locale;
        MomentAsset::register($view);
        DateRangePickerAsset::register($view);
        
    }
}
