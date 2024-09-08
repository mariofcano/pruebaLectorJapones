<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Japanese text analyzer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            height: 150px;
            margin-bottom: 20px;
            border-radius: 5px;
            padding: 10px;
            border: 1px solid #ced4da;
        }

        .btn-analyze {
            width: 100%;
            background-color: #007bff;
            color: white;
        }

        .resultados {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Japanese Text Analyzer</h1>

        <!-- Formulario para ingresar el texto en japonés -->
        <form action="{{ route('analizar') }}" method="POST">
            @csrf
            <textarea name="texto_japones" placeholder="Type your Japanese paragraph here">{{ $entrada ?? '' }}</textarea>
            <button type="submit" class="btn btn-analyze">Analyze</button>
        </form>

        <!-- Mostrar resultados si existen -->
        @if(isset($resultados) && count($resultados) > 0)
            <div class="resultados">
                <h3>Results:</h3>
                <ul class="list-group">
                    @foreach($resultados as $resultado)
						<li class="list-group-item">
							<strong>{{ $resultado['palabra'] }}</strong>: 
							@if(is_array($resultado['significado']))
								{{ implode(', ', $resultado['significado']) }}
							@else
								{{ $resultado['significado'] }}
							@endif
						</li>

                    @endforeach
                </ul>
            </div>
        @elseif(isset($resultados))
            <div class="alert alert-warning mt-3">No results were found.</div>
        @endif
    </div>
</body>
</html>
