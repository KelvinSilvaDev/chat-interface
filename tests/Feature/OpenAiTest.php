<?php

namespace Tests;

use Tests\TestCase;

class OpenAiTest extends TestCase
{
    public function testOpenAIIntegration()
    {
        $response = $this->post('/send-message', ['message' => 'Qual é a capital do Brasil?']);

        // Verifique se a resposta é um JSON válido.
        $response->assertJson([
            'message' => 'A capital do Brasil é Brasília.',
        ]);
    }
}
