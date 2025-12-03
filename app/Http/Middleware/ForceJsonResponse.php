<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Force Accept header to application/json for API routes
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);

        // Ensure response is JSON
        if (!$response->headers->has('Content-Type') || 
            !str_contains($response->headers->get('Content-Type'), 'application/json')) {
            
            // If response is HTML, convert to JSON error
            if ($response->headers->get('Content-Type') === 'text/html' || 
                str_contains($response->getContent(), '<!DOCTYPE') ||
                str_contains($response->getContent(), '<html')) {
                
                $statusCode = $response->getStatusCode();
                
                return response()->json([
                    'success' => false,
                    'message' => $this->getMessageForStatusCode($statusCode),
                    'status_code' => $statusCode
                ], $statusCode);
            }
        }

        return $response;
    }

    /**
     * Get user-friendly message for HTTP status code
     */
    private function getMessageForStatusCode(int $statusCode): string
    {
        $messages = [
            400 => 'Permintaan tidak valid',
            401 => 'Tidak terautentikasi',
            403 => 'Akses ditolak',
            404 => 'Endpoint tidak ditemukan',
            405 => 'Method tidak diizinkan',
            419 => 'Sesi telah kedaluwarsa',
            422 => 'Data tidak valid',
            429 => 'Terlalu banyak permintaan',
            500 => 'Terjadi kesalahan pada server',
            503 => 'Layanan tidak tersedia',
        ];

        return $messages[$statusCode] ?? 'Terjadi kesalahan';
    }
}