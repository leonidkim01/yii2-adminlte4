<?php

declare(strict_types=1);

namespace id161836712\adminlte4;

use yii\bootstrap5\Widget;
use yii\helpers\Html;

use function is_numeric;
use function is_string;

/**
 * For example:
 *
 * ```php
 * echo InfoBox::widget([
 *     'text' => 'Bookmarks',
 *     'number' => '41,410',
 *     'iconClass' => 'bi bi-bookmarks-fill',
 *     'progress' => [
 *         'width' => '70%',
 *         'description' => '70% Increase in 30 Days',
 *     ],
 * ])
 * ```
 *
 * @see https://adminlte-v4.netlify.app/dist/pages/widgets/info-box
 */
final class InfoBox extends Widget
{
    public ?string $iconClass = null;

    public array $iconOptions = [];

    public ?string $text = null;

    public ?string $number = null;

    public array $contentOptions = [];

    public array $progress = [];

    public array $progressOptions = [];

    public array $progressBarOptions = [];

    public array $progressDescriptionOptions = [];

    /**
     * @inheritdoc
     */
    public function run(): string
    {
        $html = $this->renderIcon() . "\n" . $this->renderContent();

        Html::addCssClass($this->options, ['widget' => 'info-box']);

        return Html::tag('div', $html, $this->options);
    }

    private function renderIcon(): ?string
    {
        if (!$this->iconClass) {
            return null;
        }

        $html = Html::tag('i', '', ['class' => $this->iconClass]);

        Html::addCssClass($this->iconOptions, ['widget' => 'info-box-icon']);

        return Html::tag('span', $html, ['class' => $this->iconOptions]);
    }

    private function renderContent(): ?string
    {
        $text = $this->text ? Html::tag('span', $this->text, ['class' => 'info-box-text']) : null;
        $number = $this->number ? Html::tag('span', $this->number, ['class' => 'info-box-number']) : null;
        $progress = $this->renderProgress();

        Html::addCssClass($this->contentOptions, ['widget' => 'info-box-content']);

        return Html::tag('div', $text . "\n" . $number . "\n" . $progress, ['class' => $this->contentOptions]);
    }

    private function renderProgress(): ?string
    {
        if ($this->progress && isset($this->progress['width']) && is_numeric($this->progress['width'])) {
            Html::addCssClass($this->progressOptions, ['widget' => 'progress']);
            Html::addCssClass($this->progressBarOptions, ['widget' => 'progress-bar']);
            Html::addCssStyle($this->progressBarOptions, ['width' => $this->progress['width']]);

            $progressBar = Html::tag('div', Html::tag('div', '', $this->progressBarOptions), ['class' => $this->progressOptions]);

            if (isset($this->progress['description']) && is_string($this->progress['description'])) {
                Html::addCssClass($this->progressDescriptionOptions, ['widget' => 'progress-description']);

                $progressDescription = Html::tag('span', $this->progress['description'], $this->progressDescriptionOptions);

                return $progressBar . "\n" . $progressDescription;
            }

            return $progressBar;
        }

        return null;
    }
}
