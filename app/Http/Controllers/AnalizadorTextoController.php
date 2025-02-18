<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AnalizadorTextoController extends Controller
{
public function analizar(Request $request)
{
    // Texto que recibimos desde el formulario
    $texto = $request->input('texto_japones');

    // Llamamos a la función para tokenizar el texto
    $tokens = $this->tokenizarTexto($texto);

    // Procesamos los tokens obtenidos y consultamos la API de Jisho
    $resultados = [];
    foreach ($tokens as $token) {
        $significado = $this->obtenerSignificadoDesdeJisho($token['surface_form']);
        $resultados[] = [
            'palabra' => $token['surface_form'],
            'significado' => $significado
        ];
    }

    // Retornamos la vista con los resultados
    return view('analizador', ['resultados' => $resultados, 'entrada' => $texto]);
}



	private function tokenizarTexto($texto)
	{
		$output = [];
		$return_var = null;
		exec('"C:\Program Files\nodejs\node.exe" ' . base_path('tokenizer.cjs') . " '{$texto}'", $output, $return_var);

		// Elimina o comenta esta línea para que no interrumpa el flujo
		// dd($output, $return_var);

		// Decodificamos el JSON que devuelve el script
		$decoded_output = json_decode(implode('', $output), true);

		if ($decoded_output === null) {
			dd('Error: I can´t decode the JSON file');
			return [];
		}

		return $decoded_output;
	}


private function obtenerSignificadoDesdeJisho($palabra)
{
    // Uso Guzzle para hacer una solicitud a la API de Jisho
    $client = new Client();
    $respuesta = $client->get("https://jisho.org/api/v1/search/words?keyword=" . urlencode($palabra));

    // Respuesta de Jisho
    $data = json_decode($respuesta->getBody(), true);

    // verificar si no se devolvieron resultados
    if (empty($data['data'])) {
        return 'No results';  
    }

    return $data['data'][0]['senses'][0]['english_definitions'];
}

}
