<?php

declare(strict_types=1);

namespace id161836712\adminlte4;

use yii\bootstrap5\Widget;
use yii\helpers\Html;

/**
 * For example:
 *
 * ```php
 * echo Card::widget([
 *     'title' => 'Expandable',
 *     'body' => 'The body of the card',
 * ])
 * ```
 *
 * @see https://adminlte-v4.netlify.app/dist/pages/widgets/cards
 */
final class Card extends Widget
{
    public ?string $title = null;

    public array $headerOptions = [];

    public ?string $body = null;

    public array $bodyOptions = [];

    /**
     * @inheritdoc
     */
    public function run(): string
    {
        $html = "\n" . $this->renderHeader() . "\n" . $this->renderContent() . "\n";

        Html::addCssClass($this->options, ['widget' => 'card']);

        return Html::tag('div', $html, $this->options);
    }

    private function renderHeader(): string
    {
        $title = Html::tag('h3', $this->title, ['class' => 'card-title']);

        Html::addCssClass($this->headerOptions, ['widget' => 'card-header']);

        return Html::tag('div', $title, $this->headerOptions);
    }

    private function renderContent(): string
    {
        Html::addCssClass($this->bodyOptions, ['widget' => 'card-body']);

        return Html::tag('div', $this->body, $this->bodyOptions);
    }
}
