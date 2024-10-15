<?php

/**
 * Usage allowed, just keep the credits.
 */

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Sanitizer;

/**
 * Class SanitizerTest
 *
 * Tests for the Sanitizer class, which is responsible for sanitizing
 * input numbers by removing non-numeric characters.
 */
class SanitizerTest extends TestCase {
    private Sanitizer $sanitizer;

    /**
     * Setup method that runs before each test.
     * Instantiates the Sanitizer class.
     */
    protected function setUp(): void {
        $this->sanitizer = new Sanitizer();
    }

    /**
     * Tests the sanitization of a valid numeric input.
     *
     * This test checks if the method returns the input as is when
     * it consists only of numeric characters.
     */
    public function testSanitizeNumber(): void {
        $input = '123456789';
        $expected = '123456789';
        
        $result = $this->sanitizer->sanitizeNumber($input);

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests the sanitization of an input with non-numeric characters.
     *
     * This test verifies if the method correctly removes non-numeric
     * characters from the input string.
     */
    public function testSanitizeNumberWithNonNumericCharacters(): void {
        $input = '12345abc';
        $expected = '12345';
    
        $result = $this->sanitizer->sanitizeNumber($input);
    
        $this->assertEquals($expected, $result);
    }
}

