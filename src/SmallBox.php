<?php

declare(strict_types=1);

namespace ourleu\adminlte4;

use yii\bootstrap5\Widget;
use yii\helpers\Html;

/**
 * ```php
 * echo SmallBox::widget([
 *     'title' => '150',
 *     'text' => 'New Orders',
 *     'iconClass' => 'bi bi-cart-fill',
 *     'footerText' => 'More info',
 *     'footerUrl' => ['/gii'],
 * ])
 * ```
 *
 * @see https://adminlte-v4.netlify.app/dist/pages/widgets/small-box
 */
final class SmallBox extends Widget
{
    public ?string $title = null;

    public ?string $text = null;

    public ?string $footerText = null;

    public array $innerOptions = [];

    public ?string $iconClass = null;

    public array $iconOptions = [];

    /**
     * @var string|array|null
     */
    public $footerUrl;

    public array $footerOptions = [];

    /**
     * @inheritdoc
     */
    public function run(): string
    {
        $html = $this->renderInner() . "\n" . $this->renderIcon() . "\n" . $this->renderFooter();

        Html::addCssClass($this->options, ['widget' => 'small-box']);

        return Html::tag('div', $html, $this->options);
    }

    private function renderInner(): string
    {
        $title = Html::tag('h3', $this->title);
        $text = Html::tag('p', $this->text);

        Html::addCssClass($this->innerOptions, ['widget' => 'inner']);

        return Html::tag('div', $title . "\n" . $text, $this->innerOptions);
    }

    private function renderIcon(): ?string
    {
        if ($this->iconClass === null) {
            return null;
        }

        $html = Html::tag('i', '', ['class' => $this->iconClass]);

        Html::addCssClass($this->iconOptions, ['widget' => 'small-box-icon']);

        return Html::tag('div', $html, ['class' => $this->iconOptions]);
    }

    private function renderFooter(): string
    {
        Html::addCssClass($this->footerOptions, ['widget' => 'small-box-footer']);

        return Html::a($this->footerText, $this->footerUrl, $this->footerOptions);
    }
}
