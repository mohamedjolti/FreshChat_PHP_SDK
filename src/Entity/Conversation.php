<?php

namespace Freshchat\Entity;

use Freshchat\Http\Curl;


class Conversation
{

    private Curl $curl;
    private string $id;

    public function __construct()
    {
        $this->curl = new Curl();
    }

    public function createConversation()
    {
        /**
         * @var string
         */
        $CREATE_CONVERSATION = FreshchatApiEndpoint::getConversationCreation();
        $headers = FreshchatApiEndpoint::createHeader();

        return $this->curl->post($CREATE_CONVERSATION,new \stdClass, $headers);
    }

    public function sendMessage(Message $message)
    {
        $MESSAGE_ENDPOINT = FreshchatApiEndpoint::getConversationSendMessage($this->id);
        $messageObject = $message->createMessageObject();
        return $this->curl->post($MESSAGE_ENDPOINT, $messageObject, FreshchatApiEndpoint::createHeader(), true);
    }

	/**
	 * @return string
	 */
	public function getId(): string {
		return $this->id;
	}
	
	/**
	 * @param string $id 
	 * @return self
	 */
	public function setId(string $id): self {
		$this->id = $id;
		return $this;
	}
}
