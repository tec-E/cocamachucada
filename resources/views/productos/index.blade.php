<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes bounce-smooth {
            0%, 100% {
                transform: translateY(-5%);
            }
            50% {
                transform: translateY(0);
            }
        }
        .animate-bounce-smooth {
            animation: bounce-smooth 0.6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-8 text-center">Productos Disponibles</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @forelse ($productos as $producto)
            <div class="bg-white rounded-xl shadow p-4 hover:shadow-2xl hover:scale-105 transform transition duration-300 hover:animate-bounce-smooth cursor-pointer">
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                         alt="{{ $producto->nombre }}"
                         class="w-full h-40 object-cover rounded mb-4">
                @endif

                <h2 class="text-xl font-semibold">{{ $producto->nombre }}</h2>
                <p class="text-gray-600">{{ $producto->descripcion }}</p>

                <p class="mt-2"><strong>Precio:</strong> Bs {{ number_format($producto->precio, 2) }}</p>
                <p><strong>Cantidad disponible:</strong> {{ $producto->cantidad }}</p>
                <p class="text-sm text-gray-500 mt-2">
                    <strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                </p>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">No hay productos disponibles.</p>
        @endforelse
    </div>
</div>
</body>
</html>
