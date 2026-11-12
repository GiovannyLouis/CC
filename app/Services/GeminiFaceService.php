<?php

namespace App\Services;

use App\Models\DetectedFace;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class GeminiFaceService
{
    private string $apiKey;
    private string $model;

    public function __construct()
    {
        $this->apiKey = (string) config('services.gemini.api_key', '');
        $this->model = (string) config('services.gemini.model', 'gemini-2.5-flash');
    }

    /**
     * Send an uploaded image to Gemini and return an array of DetectedFace models.
     *
     * @return DetectedFace[]
     */
    public function detectFaces(UploadedFile $image): array
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('Gemini API key is missing. Set GEMINI_API_KEY in your .env file.');
        }

        $rawBytes = file_get_contents($image->getRealPath());
        if ($rawBytes === false) {
            throw new RuntimeException('Unable to read uploaded image file.');
        }

        $base64Image = base64_encode($rawBytes);
        $mimeType = $image->getMimeType() ?: 'image/jpeg';

        $endpoint = sprintf(
            'https://generativelanguage.googleapis.com/v1beta/models/%s:generateContent',
            $this->model
        );

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'inline_data' => [
                                'mime_type' => $mimeType,
                                'data' => $base64Image,
                            ],
                        ],
                        [
                            'text' => 'Detect every human face visible in this image, including foreground, background, side-profile, and partially occluded faces. '
                                . 'Return a JSON object with a "faces" array. Each item must include "box_2d" as [ymin, xmin, ymax, xmax] normalized on a 0 to 1000 integer scale, '
                                . 'and a "label" like "face_1", "face_2", etc. Return an empty "faces" array if no faces are present.',
                        ],
                    ],
                ],
            ],
            'generationConfig' => [
                'temperature' => 0.1,
                'responseMimeType' => 'application/json',
                'responseSchema' => [
                    'type' => 'OBJECT',
                    'properties' => [
                        'faces' => [
                            'type' => 'ARRAY',
                            'items' => [
                                'type' => 'OBJECT',
                                'properties' => [
                                    'box_2d' => [
                                        'type' => 'ARRAY',
                                        'items' => [
                                            'type' => 'INTEGER',
                                        ],
                                        'description' => 'Bounding box [ymin, xmin, ymax, xmax] normalized from 0 to 1000.',
                                    ],
                                    'label' => [
                                        'type' => 'STRING',
                                        'description' => 'Unique label such as face_1, face_2.',
                                    ],
                                ],
                                'required' => ['box_2d', 'label'],
                            ],
                        ],
                    ],
                    'required' => ['faces'],
                ],
            ],
        ];

        $response = Http::timeout(60)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'x-goog-api-key' => $this->apiKey,
            ])
            ->post($endpoint, $payload);

        if ($response->failed()) {
            $apiError = $response->json('error.message')
                ?? ('Gemini API failed with HTTP ' . $response->status());

            throw new RuntimeException($apiError);
        }

        $parts = $response->json('candidates.0.content.parts', []);

        if (empty($parts)) {
            $reason = $response->json('candidates.0.finishReason')
                ?? $response->json('promptFeedback.blockReason')
                ?? 'No response candidates returned';

            throw new RuntimeException('Gemini returned no usable output: ' . $reason);
        }

        // Skip any internal "thought" parts (used by Gemini 2.5 thinking models)
        $jsonText = '';
        foreach ($parts as $part) {
            if (($part['thought'] ?? false) === true) {
                continue;
            }
            if (isset($part['text']) && is_string($part['text'])) {
                $jsonText .= $part['text'];
            }
        }

        $jsonText = trim($jsonText);
        $jsonText = preg_replace('/^```(?:json)?\s*/i', '', $jsonText) ?? $jsonText;
        $jsonText = preg_replace('/\s*```$/', '', $jsonText) ?? $jsonText;

        $decoded = json_decode($jsonText, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            throw new RuntimeException('Gemini returned invalid JSON for bounding boxes.');
        }

        $rawFaces = $decoded['faces'] ?? (array_is_list($decoded) ? $decoded : []);

        $detectedFaces = [];
        foreach ($rawFaces as $index => $item) {
            if (!is_array($item)) {
                continue;
            }
            $face = DetectedFace::fromGeminiItem($item, count($detectedFaces));
            if ($face !== null) {
                $detectedFaces[] = $face;
            }
        }

        return $detectedFaces;
    }
}