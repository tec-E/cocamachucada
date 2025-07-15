<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use App\Filament\Resources\ProductoResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListProductos extends ListRecords
{
    protected static string $resource = ProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('generarPdf')
                ->label('Generar PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('primary')
                ->action(function () {
                    $productos = \App\Models\Producto::all();

                    $meses = [
                        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
                        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
                        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre',
                    ];

                    $hoy = Carbon::now();
                    $fechaLiteral = $hoy->day . ' de ' . $meses[$hoy->month] . ' de ' . $hoy->year;

                    $pdf = Pdf::loadView('pdf.rptproducto', [
                        'productos' => $productos,
                        'fechaLiteral' => $fechaLiteral,
                    ])->setPaper('letter', 'landscape');

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'reporte-categorias.pdf');
                }),
        ];
    }
}
