## pteal79/share-text

Opens the native share sheet with plain text, so it arrives in WhatsApp, Messages or Mail as a message rather than a link or a file.

### PHP Usage

@verbatim
<code-snippet name="Sharing text" lang="php">
use Pteal79\ShareText\Facades\ShareText;

ShareText::text("Gang 1\n1. QN-0001", subject: 'Job List');
</code-snippet>
@endverbatim

- `ShareText::text(string $text, ?string $subject = null): bool` — false off-device or for blank text.
- The subject is only used where the target has one (an email's subject line); it is never added to the text.
