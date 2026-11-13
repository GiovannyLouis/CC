<?php

namespace App\Http\Controllers;

use App\Models\DetectedFace;
use App\Services\GeminiFaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class FaceBlurController extends Controller
{
    public function __construct(
        private readonly GeminiFaceService $geminiFaceService,
    ) {}

    public function index(): View
    {
        return view('face-blur.index');
    }

    public function detect(Request $request): JsonResponse
    {
        $request->validate([
            'image' => ['required', 'file', 'image', 'mimes:jpeg,jpg,png,webp', 'max:10240'],
        ]);

        try {
            $faces = $this->geminiFaceService->detectFaces($request->file('image'));

            return response()->json([
                'faces' => array_map(
                    static fn (DetectedFace $face): array => $face->toArray(),
                    $faces
                ),
                'total' => count($faces),
            ]);
        } catch (Throwable $e) {
            Log::error('Gemini face detection error', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => $e->getMessage(),
            ], 502);
        }
    }
}