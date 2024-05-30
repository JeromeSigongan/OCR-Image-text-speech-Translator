<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class OCRController extends Controller

{
    public function processImage(Request $request)
    {
        // Validate the request input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Check if file upload was successful
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Get the file path of the uploaded image
            $imagePath = $request->file('image')->path();

            // Initialize Guzzle HTTP client
            $client = new Client();

            try {
                // Send a POST request to the OCR API endpoint
                $response = $client->request('POST', 'https://ocr-wizard.p.rapidapi.com/ocr', [
                    'headers' => [
                        'X-RapidAPI-Host' => 'ocr-wizard.p.rapidapi.com',
                        'X-RapidAPI-Key' => 'a31ecd4df6mshca5668d69618a2fp13ac72jsn8d62aabea9bc',
                        'Content-Type' => 'multipart/form-data',
                    ],
                    'multipart' => [
                        [
                            'name' => 'file',
                            'contents' => fopen($imagePath, 'r'), // Open the image file for reading
                        ],
                    ],
                ]);

                // Get the response body and decode JSON
                $body = json_decode($response->getBody()->getContents(), true);

                // Extract the fullText field
                $fullText = $body['body']['fullText'] ?? 'No text found';

                // Return the OCR result view with the extracted text
                return view('ocr-result', ['text' => $fullText]);

            } catch (\Exception $e) {
                // Handle any exceptions (e.g., API errors)
                return 'Error: ' . $e->getMessage();
            }
        } else {
            // Handle file upload error
            return 'Error: Failed to upload image';
        }
    }
    //
}
