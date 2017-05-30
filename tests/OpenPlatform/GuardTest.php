<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\Tests\OpenPlatform;

use EasyWeChat\Application;
use EasyWeChat\Applications\OpenPlatform\Server\Guard;
use EasyWeChat\Tests\TestCase;

class GuardTest extends TestCase
{
    public function testGetHandler()
    {
        $server = $this->make();

        $handlers = [
            Guard::EVENT_AUTHORIZED => 'EasyWeChat\Applications\OpenPlatform\EventHandlers\Authorized',
            Guard::EVENT_UNAUTHORIZED => 'EasyWeChat\Applications\OpenPlatform\EventHandlers\Unauthorized',
            Guard::EVENT_UPDATE_AUTHORIZED => 'EasyWeChat\Applications\OpenPlatform\EventHandlers\UpdateAuthorized',
            Guard::EVENT_COMPONENT_VERIFY_TICKET => 'EasyWeChat\Applications\OpenPlatform\EventHandlers\ComponentVerifyTicket',
        ];

        foreach ($handlers as $type => $handler) {
            $this->assertInstanceOf($handler, $server->getHandler($type));
        }
    }

    private function make()
    {
        $config = [
            'open_platform' => [
                'app_id' => 'your-app-id',
                'secret' => 'your-app-secret',
                'token' => 'your-token',
                'aes_key' => 'your-ase-key',
            ],
        ];

        $app = new Application($config);

        return $app->open_platform->server;
    }
}
