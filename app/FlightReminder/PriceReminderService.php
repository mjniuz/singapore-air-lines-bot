<?php

namespace App\FlightPriceReminder;

use App\Bot\Repository\TemplateService;
use App\Bot\Services\Word\WordService;
use App\Message\MessageService;
use Illuminate\Support\Facades\Log;

class PriceReminderService extends FlightReminderRepository {
    protected $user, $message, $type, $template, $word, $arr, $has_active, $msgService;
    public function __construct($user, $message, $type = 'text', $nonFinishedConfiguration) {
        $this->user     = $user;
        $this->message  = $message;
        $this->type     = $type;
        $this->template = new TemplateService();
        $this->word     = new WordService();
        $this->msgService   = new MessageService();

        // get postback param
        parse_str($this->message, $arr);
        $this->arr      = $arr;

        $this->has_active   = $nonFinishedConfiguration;
    }


    /**
     * this function for start price reminder
     * @return array
     */
    public function start(){
        // still have an non finished flight reminder
        if($this->has_active){
            return $this->nonFinishedFlightReminder();
        }

        if($this->msgService->stringContain($this->message, "price reminder create new")){
            return $this->intro();
        }

        if($this->msgService->stringContain($this->message, "price_reminder_start_confirm")){
            return $this->createNew();
        }

        if($this->msgService->stringContain($this->message, "price_reminder_found_detail")){
            return $this->responseFoundDetail();
        }

        return [];
    }

    private function responseFoundDetail(){
        $flightID   = $this->arr['price_reminder_found_detail'];
        $flight      = $this->findDetail($flightID);
        if(!$flight){
            return [
                $this->template->sendText("Sorry, your information could not be found, please try again later")
            ];
        }

        $foundList  = $this->word->askFoundDetailList($flight);
        return [
            $this->template->sendList($foundList)
        ];
    }

    private function nonFinishedFlightReminder(){
        if($this->has_active->from == ""){
            return $this->setFrom();
        }

        if($this->has_active->to == ""){
            return $this->setTo();
        }

        if(is_null($this->has_active->date_flight)){
            // please select your date flight
            return $this->setDateFlight();
        }

        if((int)$this->has_active->amount == 0){
            // please set your amount
            return $this->setAmount();
        }

        if(!empty($this->arr['price_reminder_confirm_all'])){
            // save it final
            $this->updateReadyAt($this->has_active->id);

            return [
                $this->template->sendText("That's it, we will notify you when airfare price go down as your configuration set before")
            ];
        }

        if(!empty($this->arr['price_reminder_delete_all'])){
            $confirm    = $this->word->askConfirmDeleteButton();
            return [
                $this->template->sendButton($confirm)
            ];
        }

        if(!empty($this->arr['price_reminder_delete_confirm'])){
            $this->deleteFlight($this->has_active->id);

            return [
                $this->template->sendText("Your flight price reminder deleted!")
            ];
        }

        if(!empty($this->arr['price_reminder_show_final_confirm'])){
            $finalListConfirm   = $this->word->askFinalConfirmList($this->has_active);

            return [
                $this->template->sendList($finalListConfirm, 1)
            ];
        }

        // default response
        $finalListConfirm   = $this->word->askFinalConfirmList($this->has_active);
        return [
            $this->template->sendList($finalListConfirm, 1)
        ];
    }

    private function setAmount(){
        if($this->msgService->stringContain($this->message, "price_reminder_change_amount")){
            $message    = "Now set your new maximum budget (in SGD) for airfare price, if the airfare price changed to go down or same as your budget, we will send an alert to you";
            return [
                $this->template->sendText($message)
            ];
        }

        if(!empty($this->arr['price_reminder_set_amount'])){
            // final confirm amount
            $validAmount        = $this->arr['price_reminder_set_amount'];
            $this->has_active   = $this->updateAmount($this->has_active->id, $validAmount);

            $message            = "Last step, please verify your configuration bellow";
            $finalListConfirm   = $this->word->askFinalConfirmList($this->has_active);

            return [
                $this->template->sendText($message),
                $this->template->sendList($finalListConfirm, 1)
            ];
        }

        if(!$this->isValidNum($this->message)){
            return [
                $this->template->sendText("Please input number only in SGD, (ex 110)")
            ];
        }

        // correct value
        /*$askBudgetButton   = $this->word->askConfirmBudgetButton($this->message);

        return [
            $this->template->sendButton($askBudgetButton)
        ];*/
        $this->has_active   = $this->updateAmount($this->has_active->id, $this->message);

        $message            = "Last step, please verify your configuration bellow";
        $finalListConfirm   = $this->word->askFinalConfirmList($this->has_active);

        return [
            $this->template->sendText($message),
            $this->template->sendList($finalListConfirm, 1)
        ];
    }

    private function setDateFlight(){
        if($this->msgService->stringContain($this->message, "price_reminder_change_flight_date")){
            return [
                $this->template->sendText("please set your new flight date, format (dd-mm-yyyy) ex 31-12-2017")
            ];
        }

        if(!empty($this->arr['price_reminder_set_flight_date'])){
            // final confirm date
            $validDate  = $this->arr['price_reminder_set_flight_date'];
            if(strtotime($validDate) < strtotime(date("Y-m-d"))){
                return [
                    $this->template->sendText("You can't set date flight less than today, please set your date flight again, example " . date("m-d-Y", strtotime("+7 day")))
                ];
            }

            $this->updateDate($this->has_active->id, $validDate);
            $message    = "Now set your maximum budget (in SGD) for airfare price, if the airfare price changed to go down or same as your budget, we will send an alert to you";
            $message2   = "Please reply just a number (ex. 120)";
            return [
                $this->template->sendText("Your flight date saved"),
                $this->template->sendText($message),
                $this->template->sendText($message2)
            ];
        }

        $isValid    = $this->isValidDate($this->message);
        if(is_null($isValid)){
            $msg    = "Date format invalid, please send the valid date for your flight date plan, example 31-12-2017";

            return [
                $this->template->sendText($msg)
            ];
        }

        // ask confirm
        /*$askDateConfirm     = $this->word->askConfirmDateButton($this->message);
        return [
            $this->template->sendButton($askDateConfirm)
        ];*/

        if(strtotime($this->message) < strtotime(date("Y-m-d"))){
            return [
                $this->template->sendText("You can't set date flight less than today, please set your date flight again, example " . date("d-m-Y", strtotime("+7 day")))
            ];
        }

        $this->updateDate($this->has_active->id, $this->message);
        $message    = "Now set your maximum budget (in SGD) for airfare price, if the airfare price changed to go down or same as your budget, we will send an alert to you";
        $message2   = "Please reply just a number (ex. 120)";
        return [
            $this->template->sendText("Your flight date saved"),
            $this->template->sendText($message),
            $this->template->sendText($message2)
        ];
    }

    private function setTo(){
        // please select your destination
        // from postback
        if(!empty($this->arr['price_reminder_set_destination'])){
            $validDestination = $this->arr['price_reminder_set_destination'];

            // update departure
            $this->updateDestination($this->has_active->id, $validDestination);

            return [
                $this->template->sendText("Destination selected, now please set your flight date, format (dd-mm-yyyy) ex 31-12-2017")
            ];
        }

        if(!empty($this->arr['price_reminder_change_destination'])){
            return [
                $this->template->sendText("Please set your destination city/airports")
            ];
        }

        // hardcode for demo purpose
        if(strtolower($this->message) != "singapore"){
            $msg    = "Please set your destination airport";
            $msg    .= PHP_EOL . "For demo only, you can select \"Singapore\" as your destination";

            return [
                $this->template->sendText($msg)
            ];
        }

        // confirm is destination destination
        /*$askConfirm     = $this->word->askDestinationButton($this->message);
        return [
            $this->template->sendButton($askConfirm)
        ];*/

        // update departure
        $this->updateDestination($this->has_active->id, $this->message);

        return [
            $this->template->sendText("Destination selected, now please set your flight date, format (dd-mm-yyyy) ex 31-12-2017")
        ];
    }

    private function setFrom(){
        // from postback
        if(!empty($this->arr['price_reminder_set_departure'])){
            $validDeparture = $this->arr['price_reminder_set_departure'];
            // update departure
            $this->updateDeparture($this->has_active->id, $validDeparture);

            return [
                $this->template->sendText("Departure selected, now please set your destination city/airports")
            ];
        }

        if(!empty($this->arr['price_reminder_change_departure'])){
            return [
                $this->template->sendText("Please set your departure city/airports")
            ];
        }

        // hardcode for demo purpose
        if(strtolower($this->message) != "jakarta"){
            $msg    = "Please set your departure airport";
            $msg    .= PHP_EOL . "For demo only, you can select \"Jakarta\" as your departure location";

            return [
                $this->template->sendText($msg)
            ];
        }

        // confirm is departure correct
        /*$askConfirm     = $this->word->askDepartureButton($this->message);
        return [
            $this->template->sendButton($askConfirm)
        ];*/

        // update departure
        $this->updateDeparture($this->has_active->id, $this->message);

        return [
            $this->template->sendText("Departure selected, now please set your destination city/airports")
        ];
    }

    private function createNew(){
        $this->insert($this->user->id);

        $welcome    = "This tools will help you to check airfare price continuously every 5 minutes, if the price changed and the amount is same as or lower than your budget (you can set your own budget) we will send a notification to you, it's great is not it?";
        $msg        = "First time, Please set your departure airport";
        $msg        .= PHP_EOL . "For demo only, you can select \"Jakarta\" as your departure location";

        return [
            $this->template->sendText($welcome),
            $this->template->sendText($msg,2)
        ];
    }

    private function intro(){
        //$askCreateNew   = $this->word->askStartNewPriceReminderButton();
        $askGenericNew  = $this->word->askStartNewPriceReminderGeneric();

        return [
            //$this->template->sendButton($askCreateNew),
            $this->template->sendGeneric($askGenericNew)
        ];
    }

    private function isValidDate($date){
        $timestamp = strtotime($date);
        return $timestamp ? date("d-m-Y", strtotime($date)) : null;
    }

    private function isValidNum($string_number = ""){
        //$string_number = '1.512.523,55';
        // NOTE: You don't really have to use floatval() here, it's just to prove that it's a legitimate float value.
        $number = floatval(str_replace(',', '.', str_replace('.', '', $string_number)));

        return $number;
    }
}