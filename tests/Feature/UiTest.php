<?php

namespace Tests;

use Tests\TestCase;

class UiTest extends TestCase
{
    public function testUIElements()
    {
        $response = $this->get('/');

        // Verifique se a resposta não contém a sequência "&lt;input" que representa a tag HTML "<input".
        $response->assertDontSee('&lt;input');

        // Verifique se a resposta não contém a sequência "&lt;button" que representa a tag HTML "<button".
        $response->assertDontSee('&lt;button');
    }
    public function testConversationHistoryExists()
    {
        $response = $this->get('/message-history'); // Suponhamos que esta rota fornece o histórico de conversa.

        // Verificar se o JSON retornado não está vazio.
        $response->assertDontSee('[]', false);
    }
}
