<?php namespace App\Bot\Repository;

/**
 * this class for handling request message
 */
class RequestRepository extends Repository
{
    /**
     * this function for handling request
     *
     * @param  integer  $id The identifier
     * @return object
     */
    public function handlingRequest($message, $id)
    {
        $request_message = explode(" ", $message);
        switch ($request_message[0])
        {
            case 'test':
                return "berhasil masuk";
                break;

            default:
                return $this->handlingErrorFormat();
                break;
        }
    }
}
