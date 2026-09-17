<?php

namespace Pteal79\ShareText;

/**
 * Opens the native share sheet with plain text: a message, not a link or a
 * file, so it arrives in WhatsApp, Messages or Mail as text to send.
 */
class ShareText
{
    /**
     * Show the share sheet. The subject is used where the target has one
     * (an email's subject line); it is never added to the text itself.
     *
     * Returns false off-device, or when there is no text to share.
     */
    public function text(string $text, ?string $subject = null): bool
    {
        if (trim($text) === '' || ! function_exists('nativephp_call')) {
            return false;
        }

        $result = nativephp_call('ShareText.Text', json_encode(array_filter([
            'text' => $text,
            'subject' => $subject,
        ], fn ($value) => $value !== null && $value !== '')));

        if (! $result) {
            return false;
        }

        $decoded = json_decode($result, true);

        return is_array($decoded) && ($decoded['status'] ?? null) !== 'error';
    }
}
