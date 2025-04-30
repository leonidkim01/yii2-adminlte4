<?php

declare(strict_types=1);

namespace id161836712\adminlte4;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

use function array_merge;
use function implode;
use function strtr;

/**
 * For example:
 *
 * ```php
 * echo Menu::widget([
 *     'items' => [
 *         [
 *             'label' => 'Starter Pages',
 *             'icon' => 'tachometer-alt',
 *             'badge' => '<span class="right badge badge-info">2</span>',
 *             'items' => [
 *                 ['label' => 'Active Page', 'url' => ['site/index']],
 *                 ['label' => 'Inactive Page'],
 *             ],
 *         ],
 *         ['label' => 'Simple Link', 'iconClass' => 'bi bi-list', 'badge' => '<span class="right badge badge-danger">New</span>'],
 *         ['label' => 'Yii2 PROVIDED', 'header' => true],
 *         ['label' => 'Gii',  'iconClass' => 'bi bi-file-code', 'url' => ['/gii'], 'target' => '_blank'],
 *         ['label' => 'Debug', 'iconClass' => 'bi bi-bug-fill', 'url' => ['/debug'], 'target' => '_blank'],
 *         ['label' => 'Important', 'iconClass' => 'bi bi-exclamation-triangle-fill text-danger'],
 *         ['label' => 'Warning', 'iconClass' => 'bi bi-circle-fill'],
 *     ]
 * ])
 * ```
 *
 * @see https://adminlte-v4.netlify.app/dist/pages/docs/components/main-sidebar
 */
final class Menu extends \yii\widgets\Menu
{
    /**
     * @var array list of menu items. Each menu item should be an array of the following structure:
     *
     * - label: string, optional, specifies the menu item label. When [[encodeLabels]] is true, the label
     *   will be HTML-encoded. If the label is not specified, an empty string will be used.
     * - encode: boolean, optional, whether this item`s label should be HTML-encoded. This param will override
     *   global [[encodeLabels]] param.
     * - url: string or array, optional, specifies the URL of the menu item. It will be processed by [[Url::to]].
     *   When this is set, the actual menu item content will be generated using [[linkTemplate]];
     *   otherwise, [[labelTemplate]] will be used.
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - items: array, optional, specifies the sub-menu items. Its format is the same as the parent items.
     * - active: boolean or Closure, optional, whether this menu item is in active state (currently selected).
     *   When using a closure, its signature should be `function ($item, $hasActiveChild, $isItemActive, $widget)`.
     *   Closure must return `true` if item should be marked as `active`, otherwise - `false`.
     *   If a menu item is active, its CSS class will be appended with [[activeCssClass]].
     *   If this option is not set, the menu item will be set active automatically when the current request
     *   is triggered by `url`. For more details, please refer to [[isItemActive()]].
     * - options: array, optional, the HTML attributes for the menu container tag.
     *
     * - header: boolean, not nav-item but nav-header when it is true.
     * - iconClass: string, the icon class.
     * - badge: string, html.
     * - target: string.
     */
    public $items = [];

    /**
     * @inheritdoc
     */
    public $linkTemplate = '<a class="nav-link {active}" href="{url}" {target}>{icon} {label}</a>';

    /**
     * @inheritdoc
     */
    public $labelTemplate = '<p>{label} {submenuIcon} {badge}</p>';

    /**
     * @inheritdoc
     */
    public $submenuTemplate = "\n<ul class='nav nav-treeview ps-3'>\n{items}\n</ul>\n";

    /**
     * @inheritdoc
     */
    public $itemOptions = ['class' => 'nav-item'];

    /**
     * @inheritdoc
     */
    public $activateParents = true;

    /**
     * @inheritdoc
     */
    public $options = [
        'class' => 'nav sidebar-menu flex-column',
        'data-lte-toggle' => 'treeview',
        'role' => 'menu',
        'data-accordion' => 'false',
    ];

    public string $submenuIcon = '<i class="nav-arrow bi bi-chevron-right"></i>';

    /**
     * @inheritdoc
     */
    protected function renderItems($items): string
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));

            if (isset($item['header']) && $item['header']) {
                Html::removeCssClass($options, 'nav-item');
                Html::addCssClass($options, 'nav-header');
            }

            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
                if ($item['active']) {
                    $options['class'] .= ' menu-open';
                }
            }

            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item): string
    {
        if (isset($item['header']) && $item['header']) {
            return $item['label'];
        }

        $submenuIcon = isset($item['items']) ? $this->submenuIcon : '';

        $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

        return strtr($template, [
            '{label}' => strtr($this->labelTemplate, [
                '{label}' => $item['label'],
                '{submenuIcon}' => $submenuIcon,
                '{badge}' => $item['badge'] ?? '',
            ]),
            '{url}' => isset($item['url']) ? Html::encode(Url::to($item['url'])) : '#',
            '{icon}' => isset($item['iconClass']) ? Html::tag('i', '', ['class' => $item['iconClass']]) : '',
            '{active}' => $item['active'] ? $this->activeCssClass : '',
            '{target}' => isset($item['target']) ? "target=\"{$item['target']}\"" : '',
        ]);
    }
}
