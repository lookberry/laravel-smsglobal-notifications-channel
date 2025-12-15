<?php

namespace Tests;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Config;
use SalamWaddah\SmsGlobal\Credentials;
use SalamWaddah\SmsGlobal\SmsGlobalChannel;
use SalamWaddah\SmsGlobal\SmsGlobalMessage;

class ChannelTest extends TestCase
{
    /**
     * @test
     */
    public function to_array_has_correct_content(): void
    {
        Config::set('services.sms_global.origin', 'Salam');

        $credentials = new Credentials();
        $events = $this->mock(Dispatcher::class);

        $channel = new SmsGlobalChannel($credentials, $events);
        $message = new SmsGlobalMessage();

        $message->content('hi there');

        $expected = [
            'destination' => '+971555555555',
            'message' => 'hi there',
            'origin' => 'Salam',
        ];

        $this->assertSame(
            $expected,
            $channel->toArray($message, '+971555555555')
        );
    }

    /**
     * @test
     */
    public function get_origin_returns_config_value(): void
    {
        Config::set('services.sms_global.origin', 'TestOrigin');

        $credentials = new Credentials();
        $events = $this->mock(Dispatcher::class);

        $channel = new SmsGlobalChannel($credentials, $events);

        $this->assertSame('TestOrigin', $channel->getOrigin());
    }
}
