<?php
/**
 * @link https://github.com/MacGyer/yii2-materializecss
 * @copyright Copyright (c) 2016 ... MacGyer for pluspunkt coding
 * @license https://github.com/MacGyer/yii2-materializecss/blob/master/LICENSE
 */

namespace macgyer\yii2materializecss\widgets;

use macgyer\yii2materializecss\lib\BaseWidget;
use macgyer\yii2materializecss\lib\Html;

/**
 * Spinner renders a circular loading animation.
 *
 * When displaying a spinner you can choose to let the colors change with every rotation.
 *
 * @see Progress|Progress
 * @author Christoph Erdmann <yii2-materializecss@pluspunkt-coding.de>
 * @since 1.0.2
 * @package widgets
 */
class Spinner extends BaseWidget
{
    /**
     * @var array the HTML attributes for the widget container tag.
     *
     * @see [yii\helpers\BaseHtml::renderTagAttributes()](http://www.yiiframework.com/doc-2.0/yii-helpers-basehtml.html#renderTagAttributes()-detail)
     * for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the HTML attributes for the spinner.
     *
     * If [[flashColors]] is set to "true" these options will be applied to all spinner simultaneously.
     *
     * @see [yii\helpers\BaseHtml::renderTagAttributes()](http://www.yiiframework.com/doc-2.0/yii-helpers-basehtml.html#renderTagAttributes()-detail)
     * for details on how attributes are being rendered.
     */
    public $spinnerOptions = [];

    /**
     * @var boolean whether to show alternating colors in spinner.
     *
     * If this is set to "true" the spinner will continously alternate its colors between blue, red, yellow and green.
     *
     * @see http://materializecss.com/preloader.html
     */
    public $flashColors = false;

    /**
     * @var array the colors alternating when $flashColors equals 'true'
     */
    private $colors = [
        'blue',
        'red',
        'yellow',
        'green',
    ];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        Html::addCssClass($this->options, ['widget' => 'preloader-wrapper active']);
        Html::addCssClass($this->spinnerOptions, ['spinner' => 'spinner-layer']);
    }

    /**
     * Executes the widget.
     * @return string the result of widget execution to be outputted.
     * @uses [[renderSpinner()]]
     */
    public function run()
    {
        $html[] = Html::beginTag('div', $this->options);

        if ($this->flashColors !== false) {
            foreach ($this->colors as $color) {
                Html::addCssClass($this->spinnerOptions, ['color' => 'spinner-' . $color]);

                $html[] = Html::beginTag('div', $this->spinnerOptions);
                $html[] = $this->renderSpinner();
                $html[] = Html::endTag('div');

                Html::removeCssClass($this->spinnerOptions, ['color' => 'spinner-' . $color]);
            }
        } else {
            $html[] = Html::beginTag('div', $this->spinnerOptions);
            $html[] = $this->renderSpinner();
            $html[] = Html::endTag('div');
        }

        $html[] = Html::endTag('div');

        return implode("\n", $html);
    }

    /**
     * Renders a single spinner.
     * @return string
     */
    protected function renderSpinner()
    {
        $html = [
            '<div class="circle-clipper left">',
            '<div class="circle"></div>',
            '</div>',
            '<div class="gap-patch">',
            '<div class="circle"></div>',
            '</div>',
            '<div class="circle-clipper right">',
            '<div class="circle"></div>',
            '</div>'
        ];

        return implode("\n", $html);
    }
}
