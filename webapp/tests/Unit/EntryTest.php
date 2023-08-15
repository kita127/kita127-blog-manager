<?php

namespace Tests\Unit;

use App\Services\Entries\EntryService;
use PHPUnit\Framework\TestCase;

class EntryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_01_01_get_next_url(): void
    {
        $contents = file_get_contents(__DIR__ . '/input/0101.xml');

        $service = new EntryService();

        $actual = $service->getNextUrl($contents);
        $this->assertSame('https://blog.hatena.ne.jp/hoge/hoge.hatenablog.com/atom/entry?page=11111111111', $actual);
    }
}