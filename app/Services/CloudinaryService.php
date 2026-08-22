<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    /**
     * Upload a file to Cloudinary.
     *
     * @param UploadedFile $file
     * @return string|null The secure URL of the uploaded file, or null on failure.
     */
    public static function upload(UploadedFile $file): ?string
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');
        $cloudinaryUrl = env('CLOUDINARY_URL');

        if ($cloudinaryUrl) {
            $parsed = parse_url($cloudinaryUrl);
            if ($parsed && isset($parsed['scheme']) && $parsed['scheme'] === 'cloudinary') {
                if (isset($parsed['user'])) {
                    $apiKey = $parsed['user'];
                }
                if (isset($parsed['pass'])) {
                    $apiSecret = $parsed['pass'];
                }
                if (isset($parsed['host'])) {
                    $cloudName = $parsed['host'];
                }
            }
        }

        if (!$cloudName || !$apiKey || !$apiSecret) {
            Log::error('Cloudinary credentials are not fully configured in the environment.');
            return null;
        }

        $timestamp = time();
        $paramsToSign = [
            'timestamp' => $timestamp,
        ];

        ksort($paramsToSign);

        // Build string to sign: key=value followed by api_secret
        $stringToSign = '';
        foreach ($paramsToSign as $key => $value) {
            $stringToSign .= "{$key}={$value}&";
        }
        $stringToSign = rtrim($stringToSign, '&') . $apiSecret;
        $signature = sha1($stringToSign);

        try {
            $response = Http::asMultipart()->post("https://api.cloudinary.com/v1_1/{$cloudName}/auto/upload", [
                'file' => fopen($file->getRealPath(), 'r'),
                'api_key' => $apiKey,
                'timestamp' => $timestamp,
                'signature' => $signature,
            ]);

            if ($response->successful()) {
                return $response->json('secure_url');
            }

            Log::error('Cloudinary upload failed: ' . $response->body());
        } catch (\Exception $e) {
            Log::error('Cloudinary upload exception: ' . $e->getMessage());
        }

        return null;
    }
}
