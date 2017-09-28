<?php namespace App\Bot\Repository;

use URL;

class Repository
{
    /**
     * this function for check count array
     *
     * @param  integer   $data  The data
     * @param  integer   $count The count
     * @return boolean
     */
    public function checkCountArray($data, $count)
    {
        if ($data < $count)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * this function for handling exception error
     *
     * @return string
     */
    public function handlingErrorFormat()
    {
        return "Format yang kamu masukkan salah, check kembali format kamu di " . url('/format/chat');
    }
}
