<?php namespace App\Bot\Api;

/**
 * Class For API Response, Objective Reason.
 */
class ApiResponse
{

    const SUCCESS            = 1;
    const ERR_FORMAT         = 2;
    const ERR_VALIDATION     = 40;
    const ERR_NOT_FOUND      = 60;
    const ERR_INVALID_METHOD = 66;
    const ERR_PROCESS        = 88;
    const ERR_INVALID_KEY    = 90;
    const ERR_SYSTEM         = 99;
    /**
     * Status Code with Message for api response
     * @var Array
     */
    private $_messages = [
        1  => 'Success',
        2  => 'Your format is not correct',
        40 => 'Validation is not correct',
        60 => 'Resource not found',
        66 => 'Bad Request',
        88 => 'Proses gagal',
        90 => 'API key tidak valid',
        99 => 'Internal system error',
    ];

    private $key;
    public $status  = self::SUCCESS;
    public $message = 'Success';
    public $data    = [];

    /**
     * Set status variabel
     * @param Integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        if (!empty($this->_messages[$status]))
        {
            $this->message = $this->_messages[$status];
            if ($this->status != self::SUCCESS)
            {
                if (!isset($this->data['errors']))
                {
                    $this->setData([$this->message], 'errors');
                }
            }
        }
    }

    /**
     * Get Status Value
     * @return Integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status message
     * @param String $msg
     */
    public function setMessage($msg)
    {
        $this->message = $msg;
    }

    /**
     * Get status message only
     * @return String
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set Data return for api response
     * @param All    $data
     * @param String $key
     */
    public function setData($data, $key = '')
    {
        if (empty($key))
        {
            $this->key  = '';
            $this->data = array_merge($this->data, $data);
        }
        else
        {
            $this->key        = $key;
            $this->data[$key] = $data;
        }
    }

    /**
     * Get all data
     * @return Array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * this function for remove data
     *
     * @param  string  $value The value
     * @return Array
     */
    public function removeData($value)
    {
        if (!empty($this->data[$value]))
        {
            unset($this->data[$value]);
            $this->setData($this->data);
            return $this->data;
        }
    }

    /**
     * get status and message
     * @return Array
     */
    public function getStatusMessage()
    {
        return [
            'status'  => $this->status,
            'message' => $this->message,
        ];
    }

    /**
     * return all value in this class for api response purpose
     * @return Array
     */
    public function toArray()
    {
        $return = array(
            'status'  => $this->status,
            'message' => $this->message,
        );

        if (!empty($this->data))
        {
            $return['data'] = $this->data;
        }
        else
        {
            $return['data'] = null;
        }

        return $return;
    }
}
