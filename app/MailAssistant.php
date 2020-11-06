<?php

namespace App;
use Mail;

class MailAssistant
{
	private $subject;
	private $destination;
	private $view;
	private $data;

	public function __construct($data){

		$this->setSubject($data['subject']);

		$this->setDestination($data['destination']);

		$this->setView($data['view']);

		$this->setData($data['data']);		

	}

	private function setSubject($subject){
		$this->subject = $subject;
	}
	private function getSubject(){
		return $this->subject;
	}
	
	private function setDestination($destination){
		$this->destination = $destination;
	}
	private function getDestination(){
		return $this->destination;
	}
	
	private function setView($view){
		$this->view = $view;
	}
	private function getView(){
		return $this->view;
	}
	
	private function setData($data){
		$this->data = $data;
	}
	private function getData(){
		return $this->data;
	}
	
	public function sendValidationLink($data){

		$this->setSubject('HaiPay validation link');

		$this->setDestination($data['email']);
		$this->setView('emails.validation_link');
		$this->setData([


		]);
		$this->send();
	}

	public function send(){
		$subject = $this->getSubject();

		$destination = $this->getDestination();

		$view = $this->getView();

		$data = $this->getData();

		Mail::send($view,$data,function($msg) use ($subject,$destination){
			$msg->from(env('MAIL_USERNAME'));

			$msg->subject($subject);

			$msg->to($destination);

		});
	}

}
