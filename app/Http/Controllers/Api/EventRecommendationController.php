<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\EventRecommendationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRecommendationController extends Controller
{
    protected $eventRecommendationService;

    public function __construct(EventRecommendationService $service)
    {
        $this->eventRecommendationService = $service;
    }

    // Method to train the model (run this periodically)
    public function trainModel()
    {
        try {
            $this->eventRecommendationService->trainModel();
            return response()->json(['message' => 'Model trained successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Model training failed', 'details' => $e->getMessage()], 500);
        }
    }

    // API Method to suggest events for the logged-in user
    public function suggestEvents()
    {
        $userId = auth()->id();
        try {
            $suggestions = $this->eventRecommendationService->suggestEvents($userId);

            if (empty($suggestions)) {
                return response()->json(['message' => 'No suggestions available'], 404);
            }

            return response()->json([
                'user_id' => $userId,
                'suggestions' => $suggestions
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch suggestions', 'details' => $e->getMessage()], 500);
        }
    }
}
