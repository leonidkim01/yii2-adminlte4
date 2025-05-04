<?php

namespace id161836712\tests\adminlte4;

use id161836712\adminlte4\InfoBox;

final class InfoBoxTest extends TestCase
{
    public function testRender(): void
    {
        InfoBox::$counter = 0;
        $output = InfoBox::widget([
            'options' => ['class' => 'text-bg-primary'],
            'text' => 'Bookmarks',
            'number' => '41,410',
            'iconClass' => 'bi bi-bookmarks-fill',
            'progress' => [
                'width' => '70%',
                'description' => '70% Increase in 30 Days',
            ],
        ]);

        $expected = <<<HTML
            <div id="w0" class="text-bg-primary info-box">
            <span class="info-box-icon"><i class="bi bi-bookmarks-fill"></i></span>
            <div class="info-box-content"><span class="info-box-text">Bookmarks</span>
            <span class="info-box-number">41,410</span>
            <div class="progress"><div class="progress-bar" style="width: 70%;"></div></div>
            <span class="progress-description">70% Increase in 30 Days</span></div>
            </div>
            HTML;

        $this->assertEqualsWithoutLE($expected, $output);
    }
}
