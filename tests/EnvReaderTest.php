<?php

namespace EnvReader\Tests;

use EnvReader\EnvReader;
use PHPUnit\Framework\TestCase;

class EnvReaderTest extends TestCase
{
    protected $envFile;

    protected function setUp(): void
    {
        $this->envFile = __DIR__ . '/.env.test';
        file_put_contents($this->envFile, "APP_NAME=TestApp\nDEBUG=true\n");
    }

    protected function tearDown(): void
    {
        unlink($this->envFile);
    }

    public function testEnvReaderGetsCorrectValue()
    {
        $env = new EnvReader($this->envFile);
        $this->assertEquals('TestApp', $env->get('APP_NAME'));
        $this->assertEquals('true', $env->get('DEBUG'));
    }

    public function testEnvReaderReturnsDefault()
    {
        $env = new EnvReader($this->envFile);
        $this->assertEquals('default', $env->get('NON_EXISTENT', 'default'));
    }
}
