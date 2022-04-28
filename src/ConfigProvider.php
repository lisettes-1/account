<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace Lisettes\Account;

class ConfigProvider
{
    public function __invoke(): array
    {
        $base_path = BASE_PATH;
        return [
            'dependencies' => [
            ],
            'commands'     => [
            ],
            'listeners' => [
            ],
            'annotations'  => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish'      => [
                [
                    'id'          => 'en-US language',
                    'description' => 'The languages for account.',
                    'source'      => __DIR__ . '/../publish/languages/en_US/account.php',
                    'destination' => $base_path . '/storage/languages/en_US/account.php',
                ],
                [
                    'id'          => 'zh-CN language',
                    'description' => 'The languages for account.',
                    'source'      => __DIR__ . '/../publish/languages/zh_CN/account.php',
                    'destination' => $base_path . '/storage/languages/zh_CN/account.php',
                ],
                [
                    'id'          => 'user Model',
                    'description' => 'The model for account.',
                    'source'      => __DIR__ . '/../publish/models/User.php',
                    'destination' => $base_path . '/app/Model/User.php',
                ],
            ],
        ];
    }
}
