<?php

/**
 * Usage allowed, just keep the credits.
 */

declare(strict_types=1);

namespace Src;

/**
 * Usage allowed, just keep the credits.
 */
class Sanitizer {
    
    /**
     * Sanitizes the number by removing non-numeric characters
     *
     * @param string $number Number to sanitize
     * @return string Sanitized number
     */
    public function sanitizeNumber(string $number): string {
        return preg_replace('/[^\d]/', '', $number);
    }
}
