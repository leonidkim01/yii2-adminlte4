<?php

namespace id161836712\tests\adminlte4;

use id161836712\adminlte4\SmallBox;

final class SmallBoxTest extends TestCase
{
    public function testRender(): void
    {
        SmallBox::$counter = 0;
        $output = SmallBox::widget([
            'options' => ['class' => 'text-bg-warning'],
            'title' => '150',
            'text' => 'New Orders',
            'iconClass' => 'bi bi-cart-fill',
            'footerText' => 'More info',
            'footerUrl' => ['/gii'],
        ]);

        $expected = <<<HTML
            <div id="w0" class="text-bg-warning small-box">
            <div class="inner"><h3>150</h3><p>New Orders</p></div>
            <div class="small-box-icon"><i class="bi bi-cart-fill"></i></div>
            <a class="small-box-footer" href="/index.php?r=gii">More info</a>
            </div>
            HTML;

        $this->assertEqualsWithoutLE($expected, $output);
    }
}
