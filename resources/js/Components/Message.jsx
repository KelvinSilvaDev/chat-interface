import React from 'react';

export const Message = ({ messageText, messageType }) => {
    const isUserMessage = messageType === 'user';
    const alignClass = isUserMessage ? 'text-right justify-end' : 'text-left justify-start my-4';
    const bgColor = isUserMessage ? 'bg-blue-500' : 'bg-gray-300';
    const textColor = isUserMessage ? 'text-white' : 'text-black';


    return (
        <div className={`flex message my-2 ${alignClass}`}>
            <div className={`message-content w-2/3 p-2 rounded ${bgColor} ${textColor}`}>
                {messageText?.split('\n').map((paragraph, index) => (
                    <p key={index}>{paragraph}</p>
                ))}
            </div>
        </div>
    );
};
