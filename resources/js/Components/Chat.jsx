



import React, { useState, useEffect, useRef } from 'react';
import { Message } from './Message';
import { Inertia } from '@inertiajs/inertia';

export const Chat = ({ auth }) => {
    const [messages, setMessages] = useState([]);
    const [userMessage, setUserMessage] = useState('');
    const [isSending, setIsSending] = useState(false);
    const [shouldScroll, setShouldScroll] = useState(true);

    const messagesEndRef = useRef(null);

    const handleSendMessage = async () => {
        try {
            setIsSending(true);
            const response = await axios.post(route('send-message'), {
                message: userMessage,
            });
            setMessages([...messages, response.data.message]);
            setUserMessage('');
        } catch (error) {
            console.error('Erro ao enviar mensagem:', error);
        } finally {
            setIsSending(false);

            messagesEndRef.current.scrollIntoView({ behavior: 'smooth' });
        }
    };

    useEffect(() => {


        const checkForNewMessages = async () => {
            try {
                const response = await axios.get(route('get-message-history'));

                if (messages.length < response.data.messages.length) {
                    setMessages(response.data.messages);
                    setShouldScroll(true);
                }
            } catch (error) {
                console.error('Erro ao verificar novas mensagens:', error);
            }
        };


        const messageCheckInterval = setInterval(checkForNewMessages, 3000);

        return () => {
            clearInterval(messageCheckInterval);
        };
    }, [messages]);



    useEffect(() => {
        if (shouldScroll) {
            messagesEndRef.current.scrollIntoView({ behavior: 'smooth' });
            setShouldScroll(false); // Redefina para false após o scroll
        }
    }, [shouldScroll]);

    // ...

    return (
        <div className="flex flex-col h-full">
            <div className="flex-1 py-8">
                <div className="bg-white rounded p-2 mb-4 shadow flex flex-col justify-between">
                    {messages.map((message, index) => (
                        <Message key={index} messageText={message.text} messageType={message.type} />
                    ))}
                    <div ref={messagesEndRef}></div>
                </div>
            </div>
            <div className="bg-gray-200 p-4">
                <div className="flex">
                    <input
                        type="text"
                        value={userMessage}
                        onChange={(e) => setUserMessage(e.target.value)}
                        onKeyPress={(e) => {
                            if (e.key === 'Enter') {
                                e.preventDefault();
                                handleSendMessage();
                            }
                        }}
                        className="flex-1 mr-2 p-2"
                        placeholder="Digite sua mensagem..."
                    />
                    <button
                        onClick={handleSendMessage}
                        className="bg-blue-500 text-white px-4 py-2"
                        disabled={isSending}
                    >
                        {isSending ? (
                            <div className="flex items-center">
                                <span className="mr-2">Sending message...</span>
                                <div className="loader" />
                            </div>
                        ) : (
                            'Send'
                        )}
                    </button>
                </div>
            </div>
        </div>
    );
};
