<?php

namespace App\CheckIn;

use App\Bot\Repository\TemplateService;
use App\Bot\Services\Word\WordService;
use App\Message\MessageService;
use Illuminate\Support\Facades\Log;

class CheckInService extends CheckInRepository{
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
     * this function for start check in module
     * @return array
     */
    public function start(){
        // still have an non finished check in
        if($this->has_active){
            return $this->nonFinishedCheckIn();
        }

        if($this->msgService->stringContain($this->message, "check in create new")){
            return $this->intro();
        }

        if($this->msgService->stringContain($this->message, "check_in_start_confirm")){
            return $this->createNew();
        }

        if($this->msgService->stringContain($this->message, "check_in_my_detail")){
            return $this->responseCheckInDetail();
        }

        return [];
    }

    private function responseCheckInDetail(){
        $checkInID   = $this->arr['check_in_my_detail'];
        $check       = $this->findDetail($checkInID);
        if(!$check){
            return [
                $this->template->sendText("Sorry, your information could not be found, please try again later")
            ];
        }

        if(is_null($check->ready_at) OR $check->is_valid == false){
            return [
                $this->template->sendText("Sorry your data invalid, please try update your information")
            ];
        }

        // update new one
        $askFound   = $this->word->askFlightCheckIn($check);

        return [
            $this->template->sendCheckIn($askFound)
        ];
    }

    private function nonFinishedCheckIn(){
        if($this->has_active->booking_number == ""){
            return $this->setFrom();
        }

        if($this->has_active->last_name == ""){
            return $this->setLastName();
        }

        if(!empty($this->arr['check_in_confirm_all'])){
            // save it final
            $this->updateReadyAt($this->has_active->id);

            // fin check in here // fake for now
            $foundName  = $this->dataFound($this->has_active->id);

            return $foundName;
        }

        if(!empty($this->arr['check_in_delete_all'])){
            $confirm    = $this->word->askConfirmDeleteCheckInButton();
            return [
                $this->template->sendButton($confirm)
            ];
        }

        if(!empty($this->arr['check_in_delete_confirm'])){
            $this->delete($this->has_active->id);

            return [
                $this->template->sendText("Your check in deleted successfully!")
            ];
        }

        if(!empty($this->arr['check_in_show_final_confirm'])){
            $finalListConfirm   = $this->word->askFinalConfirmCheckInList($this->has_active);

            return [
                $this->template->sendList($finalListConfirm)
            ];
        }

        // default response
        $finalListConfirm   = $this->word->askFinalConfirmCheckInList($this->has_active);
        return [
            $this->template->sendList($finalListConfirm)
        ];
    }

    private function dataFound($checkInID = null){
        $checkInUpdate  = $this->updateFinal($checkInID);
        if(!$checkInUpdate){
            return [
                $this->template->sendText("Your data not found, please try again later")
            ];
        }

        // update new one
        $askFound   = $this->word->askFlightCheckIn($checkInUpdate);

        return [
            $this->template->sendCheckIn($askFound)
        ];
    }

    private function setLastName(){
        // from postback
        if(!empty($this->arr['check_in_set_last_name'])){
            $validLastName = $this->arr['check_in_set_last_name'];

            // update last name
            $this->updateLastName($this->has_active->id, $validLastName);
            $finalListConfirm   = $this->word->askFinalConfirmCheckInList($this->has_active);

            return [
                $this->template->sendList($finalListConfirm)
            ];
        }

        if(!empty($this->arr['check_in_change_last_name'])){
            return [
                $this->template->sendText("Please reply with your last name in your flight ticket booking")
            ];
        }

        // hardcode for demo purpose
        if(strlen($this->message) < 3){
            $msg    = "Your last name invalid, please check your last name (minimum 4 digit)";
            return [
                $this->template->sendText($msg)
            ];
        }

        // confirm is last name correct
        $askConfirm     = $this->word->askCheckInLastNameButton($this->message);
        return [
            $this->template->sendButton($askConfirm)
        ];
    }

    private function setFrom(){
        // from postback
        if(!empty($this->arr['check_in_set_booking_number'])){
            $validBookNum   = $this->arr['check_in_set_booking_number'];

            // update departure
            $this->updateBookingNumber($this->has_active->id, $validBookNum);

            return [
                $this->template->sendText("Booking Number Updated, now please reply with your last name")
            ];
        }

        if(!empty($this->arr['check_in_change_booking_number'])){
            return [
                $this->template->sendText("Please reply with your Booking Number")
            ];
        }

        if(strlen($this->message) > 6 OR strlen($this->message) < 4){
            $msg    = "Your booking number invalid, please reply with your valid booking number (4-6 digit)";

            return [
                $this->template->sendText($msg)
            ];
        }

        // confirm is booking number correct
        $askConfirm     = $this->word->askBookingNumberButton($this->message);
        return [
            $this->template->sendButton($askConfirm)
        ];
    }

    private function createNew(){
        $this->insertNew($this->user->id);

        $welcome    = "This tools will help you to check in through the chat just by input your last name and booking number, it's great is not it?";
        $msg        = "First time, Please reply with your Booking Number";

        return [
            $this->template->sendText($welcome),
            $this->template->sendText($msg,2)
        ];
    }

    private function intro(){
        $askGenericNew  = $this->word->askStartNewCheckInGeneric();

        return [
            $this->template->sendGeneric($askGenericNew)
        ];
    }
}