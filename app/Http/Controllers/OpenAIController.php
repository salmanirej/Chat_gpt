<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
 use OpenAI;
class OpenAIController extends Controller
{
    public function generateText(Request $request)
    {
        // استدعاء API مع البيانات المطلوبة
        $response = Http::withHeaders([
            'Authorization' => 'Bearer sk-',
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/engines/davinci-codex/completions', [
            'prompt' => $request->input('prompt'),
            'max_tokens' => 50,
        ]);

        // تحويل الرد النصي إلى مصفوفة لسهولة المعالجة
        $result = $response->json();

        // استخراج النص المعاد من الAPI
        $text = $result['choices'][0]['text'];

        // إرجاع النص كاستجابة
        return response()->json([
            'text' => $text,
        ]);
    }
  
}
