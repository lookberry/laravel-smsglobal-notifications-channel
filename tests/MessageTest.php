<?php

namespace Tests;

use SalamWaddah\SmsGlobal\SmsGlobalMessage;

class MessageTest extends TestCase
{
    /**
     * @test
     */
    public function content_can_be_set(): void
    {
        $message = new SmsGlobalMessage();

        $message->content('hi this is a message');

        $this->assertSame(
            'hi this is a message',
            $message->getContent()
        );
    }

    /**
     * @test
     */
    public function content_method_returns_self(): void
    {
        $message = new SmsGlobalMessage();

        $result = $message->content('test message');

        $this->assertSame($message, $result);
    }
}
