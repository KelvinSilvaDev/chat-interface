<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $userMessage = $request->input('message');

        // Salve a mensagem do usuário no banco de dados com o tipo "user".
        Message::create([
            'text' => $userMessage,
            'type' => 'user',
        ]);

        // Aqui você pode chamar a lógica para obter a resposta do bot (por exemplo, usando a API GPT-3).

        // Salve a resposta do bot no banco de dados com o tipo "bot".
        $botResponse = "Resposta do bot..."; // Substitua com a resposta real do bot.

        Message::create([
            'text' => $botResponse,
            'type' => 'bot',
        ]);

        return response()->json(['message' => 'Mensagem enviada com sucesso']);
    }

    public function index()
    {
        // Recupere todas as mensagens do banco de dados.
        $messages = Message::all();

        return response()->json(['messages' => $messages]);
    }
}
