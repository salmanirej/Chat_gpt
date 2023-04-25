<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class chatgptController extends Controller
{

    public function test()
    {
       
        try {
            //code...

            $content = "ما هو لارافيل";

            $client = new Client();

            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer sk-',
                    'Content-Type' => 'application/json; charset=utf-8',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' =>   $content,
                        ],
                    ],
                    'stream' => True,
                    'temperature' => 0.7,
                ],
            ]);

            $body = $response->getBody()->getContents();

            // تحويل JSON إلى مصفوفة أو كائن PHP
            $data = json_decode($body, true);

            // الآن يمكنك استخدام $data للتعامل مع الاستجابة
            return $body;
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }

    
    public function question(Request $request)
    {

        // $content='';
        try {
            //code...

            $content = $request->content;

            $client = new Client();

            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer sk-',
                    'Content-Type' => 'application/json; charset=utf-8',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' =>   $content,
                        ],
                    ],
                    'stream' => True,
                    'temperature' => 0.7,
                ],
            ]);

            $body = $response->getBody()->getContents();

            // تحويل JSON إلى مصفوفة أو كائن PHP
            $data = json_decode($body, true);

            // الآن يمكنك استخدام $data للتعامل مع الاستجابة
            return $body;
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }
    public function generateText(Request $request)
    {
        // Get the input text from the request
        $input = $request->input('input');

        // Create a new Guzzle client with the API base URL and API key
        $client = new Client([
            'base_uri' => 'https://api.chatgpt.com',
            'headers' => [
                'Authorization' => 'Bearer ' . env('CHATGPT_API_KEY'),
            ],
        ]);

        // Send a POST request to the API to generate the text
        $response = $client->post('/text-generation/generate', [
            'json' => [
                'input' => $input,
            ],
        ]);

        // Get the response body as a string
        $body = $response->getBody()->getContents();

        // Decode the JSON response into an associative array
        $result = json_decode($body, true);

        // Return the generated text
        return $result['text'];
    }
}
