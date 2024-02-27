<?php

namespace Tests;

use DOMDocument;
use PHPUnit\Framework\TestCase as BaseTestCase;

// tests/TestCase.php
class TestCase extends BaseTestCase
{
    public function flattenHTML($html)
    {
        $html = preg_replace('/\n+/', '', $html);
        $html = preg_replace('/\s\s+/', '', $html);

        return $html;
    }

    public function document($html): DOMDocument
    {
        $doc = new DOMDocument();
        $doc->loadHTML($this->flattenHTML($html));

        return $doc;
    }
}
