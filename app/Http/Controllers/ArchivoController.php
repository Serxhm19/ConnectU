<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    public function subirArchivo(Request $request)
    {
        if ($request->hasFile('archivo')) {
            // Procesar y guardar el archivo aquí
            $archivo = $request->file('archivo');

            // Por ejemplo, mover el archivo a una carpeta específica
            $rutaArchivo = $archivo->store('archivos');

            // Puedes devolver una respuesta apropiada, como una redirección o un JSON con detalles del archivo guardado
            return response()->json(['ruta' => $rutaArchivo], 200);
        } else {
            // Devuelve una respuesta de error si no se proporciona ningún archivo
            return response()->json(['error' => 'No se ha proporcionado ningún archivo'], 400);
        }
    }
}
