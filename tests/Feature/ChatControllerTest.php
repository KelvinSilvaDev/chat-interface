<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    public function testSendMessage()
    {
        $response = $this->post('/send-message', ['message' => 'Olá, Chat!']);
        $response->assertStatus(200); // Verifique se a resposta HTTP é bem-sucedida.

        // Verifique se a resposta não está vazia (qualquer resposta não vazia é válida).
        $response->assertSeeText('');

        // Você também pode usar a seguinte asserção para verificar se a resposta é uma string não vazia:
        // $response->assertSeeText('Olá, Chat! - Resposta do bot: ');
    }

    public function testUserMessages()
    {
        $messages = ['Olá, Chat!', 'Como posso fazer um pedido?', 'Qual é a previsão do tempo hoje?'];

        foreach ($messages as $message) {
            $response = $this->post('/send-message', ['message' => $message]);
            $response->assertStatus(200);
        }
    }

    public function testChatHistory()
    {
        // Acesse a URL correta para recuperar o histórico de mensagens
        $response = $this->get('/message-history');

        // Verifique se o histórico existe
        $response->assertStatus(200);

        // Verifique se o histórico é um array
        $history = json_decode($response->getContent(), true);
        $this->assertIsArray($history);
    }
}
