<?php namespace App\Bot\Helper;

use Illuminate\Support\Facades\Config;

class Helper
{
    /**
     * Return the slug of a string to be used in a URL.
     *
     * @return String
     */
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicated - symbols
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }

    /**
     * this function for change charater replace
     *
     * @param  string   $character_replace        The character replace
     * @param  string   $change_character_replace The change character replace
     * @param  string   $sentence_replace         The sentence replace
     * @return string
     */
    public function replaceCharacter($character_replace, $change_character_replace, $sentence_replace)
    {
        return str_replace($character_replace, $change_character_replace, $sentence_replace);
    }

    /**
     * this function for check format date
     * @param  date      $date
     * @return boolean
     */
    public static function checkFormatDate($date)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * this function for random links airlines
     * @return string
     */
    public static function randomLinkAirlines()
    {
        $urls       = Config::get('imageflights.flights');
        $randomlink = array_rand($urls, 1);
        $thelink    = $urls[$randomlink];

        return $thelink;
    }
}
