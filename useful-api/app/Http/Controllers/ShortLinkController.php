<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    //

    public function shorten(Request $request)
    {

        $originalUrl = $request->validate([
            'original_url' => 'required|url',
            'custom_code' => 'string|max:10|unique:short_links|custom_code',
        ]);
        $link = ShortLink::customCode($originalUrl);
    }

    public function code($shortUrl)
    {
        $originalUrl = ShortLink::getOriginalUrl($shortUrl);

        if (!$originalUrl) {
            abort(404);
        }

    }

    public function delete($shortUrl)
    {
        $originalUrl = ShortLink::getOriginalUrl($shortUrl);

        if (!$originalUrl) {
            abort(404);
        }

    }
}
