<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat'); // Renderiza a página do chat (crie a view 'chat.blade.php')
    }

    public function chatWithAI()
    {
        // Defina suas mensagens de conversa aqui
        $messages = [
            ["role" => "system", "content" => "You are a helpful assistant."],
            ["role" => "user", "content" => "Who won the world series in 2020?"],
        ];

        // Enviar uma solicitação para a API da OpenAI
        $response = OpenAI::chatCompletions()->create([
            "model" => "text-davinci-003",
            // "model" => "gpt-3.5-turbo",
            "messages" => $messages,
            'max_tokens' => 150,
            'stop' => ['\n'],
        ]);

        // Obter a resposta do assistente
        $assistantResponse = $response['choices'][0]['message']['content'];

        // Retornar a resposta ao cliente ou realizar ações adicionais
        return response()->json(['response' => $assistantResponse]);
    }

    public function sendMessage(Request $request)
    {
        try {
            // Obtém a mensagem do usuário a ser enviada ao modelo GPT-3.5
            $userMessage = $request->input('message');

            $conversation = [
                ["role" => "system", "content" => "You are a helpful assistant."],
                ["role" => "user", "content" => $userMessage],
            ];

            // $result = OpenAI::chat()->completions()->create([
            //     "model" => "gpt-3.5-turbo",
            //     "messages" => $conversation,
            //     'max_tokens' => 150,
            // ]);

            $result = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                "messages" => $conversation,
                'temperature' => 0.8,
            ]);

            $assistantResponse = $result['choices'][0]['message']['content'];

            Message::create([
                'text' => $userMessage,
                'type' => 'user',
            ]);

            Message::create([
                'text' => $assistantResponse,
                'type' => 'bot',
            ]);

            return response()->json(['message' => $assistantResponse]);
        } catch (\OpenAI\Exceptions\ErrorException $e) {
            // Registre o erro para fins de depuração
            Log::error($e);
            // Registre informações no arquivo de log
            Log::info('Mensagem de log informativa', ['chave' => 'valor']);

            // Retorne uma resposta de erro adequada
            return response()->json(['error' => 'Ocorreu um erro interno no servidor', 'exception' => $e->getMessage()], 500);
        }
    }
}
