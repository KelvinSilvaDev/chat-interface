import React, { useState, useEffect, useRef } from 'react';
import { Message } from './Message';
import { Inertia } from '@inertiajs/inertia';


export const Chat = ({ auth }) => {
    const [messages, setMessages] = useState([]);
    const [userMessage, setUserMessage] = useState('');
    const [isSending, setIsSending] = useState(false);
    const messagesEndRef = useRef(null);

    useEffect(() => {
        if (!auth || !auth.user) {
            Inertia.visit(route('login'));
        }
    }, []);
    

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
            // Após enviar a mensagem, role para a nova mensagem (do bot) no final da lista.
            messagesEndRef.current.scrollIntoView({ behavior: 'smooth' });
        }
    };

    useEffect(() => {
        // Carregue o histórico de mensagens ao carregar a página.
        loadMessageHistory();

        // Defina um intervalo de tempo para atualizar as mensagens periodicamente.
        const messageUpdateInterval = setInterval(() => {
            loadMessageHistory();
        }, 5000); // Atualize a cada 5 segundos, ajuste conforme necessário.

        // Certifique-se de limpar o intervalo quando o componente for desmontado.
        return () => {
            clearInterval(messageUpdateInterval);
        };
    }, []);

    const loadMessageHistory = async () => {
        try {
            const response = await axios.get(route('get-message-history'));
            setMessages(response.data.messages);
            // Após receber novas mensagens, role para a última mensagem (do bot) no final da lista.
            messagesEndRef.current.scrollIntoView({ behavior: 'smooth' });
            console.log('Message history loaded:', response.data.messages);
        } catch (error) {
            console.error('Error loading message history:', error);
        }
    };

    return (
        <div className="flex flex-col h-screen overflow-y-auto">
            <div className="bg-gray-200 p-4">Chat Interface</div>
            <div className="flex-1 overflow-y-auto px-4 py-8">
                <div className="bg-white rounded p-2 mb-4 shadow flex flex-col justify-between">
                    {messages.map((message, index) => (
                        <Message key={index} messageText={message.text} messageType={message.type} />
                    ))}
                    {/* Este ref ajudará a rolar automaticamente para a última mensagem */}
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
                                <span className="mr-2">Enviando mensagem...</span>
                                <div className="loader" /> {/* Adicione um elemento de carregamento aqui */}
                            </div>
                        ) : (
                            'Enviar'
                        )}
                    </button>
                </div>
            </div>
        </div>
    );
};
