<?php

namespace id161836712\tests\adminlte4;

use id161836712\adminlte4\Card;

final class CardTest extends TestCase
{
    public function testRender(): void
    {
        Card::$counter = 0;
        $output = Card::widget([
            'options' => ['class' => 'card-primary'],
            'title' => 'Expandable',
            'body' => 'The body of the card',
        ]);

        $expected = <<<HTML
            <div id="w0" class="card-primary card">
            <div class="card-header"><h3 class="card-title">Expandable</h3></div>
            <div class="card-body">The body of the card</div>
            </div>
            HTML;

        $this->assertEqualsWithoutLE($expected, $output);
    }
}
