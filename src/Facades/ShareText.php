<?php

namespace Pteal79\ShareText\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool text(string $text, ?string $subject = null)
 *
 * @see \Pteal79\ShareText\ShareText
 */
class ShareText extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Pteal79\ShareText\ShareText::class;
    }
}
