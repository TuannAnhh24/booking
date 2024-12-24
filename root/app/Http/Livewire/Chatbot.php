<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Gemini\Client;
use Gemini\Enums\ModelType;

class Chatbot extends Component
{
    public $isOpen = false;
    public $userMessage = '';
    public $messages = [];

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }
    // public function sendMessage()
    // {
    //     if (empty($this->userMessage)) {
    //         return;
    //     }
    //     $this->messages[] = ['type' => 'user', 'message' => $this->userMessage];
    //     $client = app(Client::class);
    //     $chatSession = $client->chat(ModelType::GEMINI_FLASH);
    //     $response = $chatSession->sendMessage($this->userMessage);
    //     if (!empty($response->candidates)) {
    //         $aiResponse = $response->candidates[0]->content->parts[0]->text ?? __('content.chatbot.error_message');
    //     } else {
    //         $aiResponse = __('content.chatbot.error_url');
    //     }
    //     $this->messages[] = ['type' => 'ai', 'message' => $aiResponse];
    //     $this->userMessage = '';
    //     $this->emit('messageAdded');
    // }

    public function sendMessage()
    {
        if (empty($this->userMessage)) {
            return;
        }

        $this->messages[] = ['type' => 'user', 'message' => $this->userMessage];

        $client = app(Client::class);
        $chatSession = $client->chat(ModelType::GEMINI_FLASH);

        $aiResponse = $this->attemptChatSession($chatSession, $this->userMessage);

        $this->messages[] = ['type' => 'ai', 'message' => $aiResponse];
        $this->userMessage = '';
        $this->emit('messageAdded');
    }

    private function attemptChatSession($chatSession, $message, $maxRetries = 3, $retryDelay = 2)
    {
        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                $response = $chatSession->sendMessage($message);

                if (!empty($response->candidates)) {
                    return $response->candidates[0]->content->parts[0]->text ?? __('content.chatbot.error_message');
                }
            } catch (\Exception $e) {
            }

            if ($attempt < $maxRetries) {
                sleep($retryDelay);
            }
        }
        return __('content.chatbot.error_overloaded');
    }


    public function render()
    {
        return view('livewire.chatbot');
    }
}