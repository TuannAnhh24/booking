<div>
    <!-- open chatbot -->
    <div class="fixed bottom-5 right-5 bg-blue-600 p-4 rounded-full cursor-pointer shadow-xl text-white text-3xl flex justify-center items-center transition duration-300 hover:bg-blue-700" wire:click="toggleChat">
        <i class="fas fa-comment-alt"></i>
    </div>

    @if($isOpen)
        <!-- Chatbot Window -->
        <div class="fixed bottom-20 right-5 w-90 h-96 bg-white rounded-2xl shadow-2xl flex flex-col border border-gray-300 transition-all duration-300 ease-in-out">
            <div class="flex items-center justify-between p-3 border-b border-gray-200 rounded-t-xl bg-blue-600 text-white">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-full bg-blue-800 flex justify-center items-center text-white shadow-md">
                        <i class="fas fa-robot"></i>
                    </div>
                    <span class="font-semibold text-xl">{{ __('content.chatbot.name') }}</span>
                </div>
                <button wire:click="toggleChat" class="text-white hover:text-gray-200 transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="messageBox" class="flex-1 overflow-y-auto p-2 space-y-3 bg-gray-50">
                @foreach($messages as $message)
                    <div class="message p-3 rounded-lg max-w-xs flex items-center space-x-3">
                        @if($message['type'] == 'user')
                            <div class="flex-1 flex items-center space-x-3 justify-end">
                                <div class="max-w-full bg-blue-100 self-end rounded-lg p-3 text-blue-600 shadow-md break-words w-60">
                                    {{ $message['message'] }}
                                </div>
                                <div class="w-10 h-10 rounded-full bg-blue-600 flex justify-center items-center text-white shadow-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        @else
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 rounded-full bg-blue-600 flex justify-center items-center text-white shadow-md">
                                    <i class="fas fa-robot"></i>
                                </div>
                                <div class="max-w-full bg-gray-100 self-end rounded-lg p-3 text-gray-600 shadow-md break-words w-60">
                                    {{ $message['message'] }}
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="flex items-center p-3 border-t border-gray-200 rounded-b-xl bg-gray-100">
                <input type="text" wire:model="userMessage" placeholder="Nhập tin nhắn..." class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400 transition duration-200">
                <button wire:click="sendMessage" class="bg-blue-600 text-white px-4 py-2 rounded-lg ml-3 hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    @endif
</div>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

