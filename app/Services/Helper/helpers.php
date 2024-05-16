<?php

use Illuminate\Http\JsonResponse;

function getMessage(string $code = null): ?string
{
    return __("messages.$code");
}

function responseOk(): JsonResponse
{
    return response()->json([
        'status' => 'success',
    ]);
}

function responseFailed(string $message = null, int $code = 400): JsonResponse
{
    return response()->json([
        'message' => __($message) ?? __('Bad request'),
    ], $code);
}

function getModelNotFoundMessage(string $model): string
{
    return match ($model) {
        'App\Models\User' => __('User not found'),
        default => __('Entity not found')
    };
}
