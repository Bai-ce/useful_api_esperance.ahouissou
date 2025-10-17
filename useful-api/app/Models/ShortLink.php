<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortLink extends Model
{
    //
    use HasFactory;
    protected $fillable = ['original_url', 'custom_code'];

    public static function customCode($originalUrl)
    {
        $link = self::create(['original_url' => $originalUrl]);
        $link->custom_code = Hashids::encode($link->id);
        $link->save();

        return $link;
    }

    public static function getOriginalUrl($customCode)
    {
        $linkId = Hashids::decode($customCode);
        $link = self::find($linkId);

        return $link ? $link->original_url : null;
    }
}
