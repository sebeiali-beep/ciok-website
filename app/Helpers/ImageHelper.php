<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Retourne l'URL d'une image en priorisant le format WebP.
     * Si le fichier .webp existe, il est retourné.
     * Sinon, l'image originale (.png/.jpg) est retournée.
     */
    public static function webp(string $path): string
    {
        // Enlever le slash initial s'il existe
        $path = ltrim($path, '/');

        // Construire le chemin WebP
        $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $path);

        // Vérifier si le WebP existe
        if ($webpPath && file_exists(public_path($webpPath))) {
            return asset($webpPath);
        }

        // Sinon retourner l'image originale
        return asset($path);
    }
}