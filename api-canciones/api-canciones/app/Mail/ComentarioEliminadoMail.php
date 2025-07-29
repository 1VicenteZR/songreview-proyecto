<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class ComentarioEliminadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $comentario;
    public $cancion;

    public function __construct($usuario, $comentario, $cancion)
    {
        $this->usuario = $usuario;
        $this->comentario = $comentario;
        $this->cancion = $cancion;
    }

    public function build()
    {
        // Generar PDF
        $pdf = Pdf::loadView('emails.comentario-eliminado-pdf', [
            'usuario' => $this->usuario,
            'comentario' => $this->comentario,
            'cancion' => $this->cancion,
            'fecha' => now()->format('d/m/Y H:i:s')
        ]);

        return $this->view('emails.comentario-eliminado')
                    ->subject('⚠️ Comentario Eliminado - Song Review App')
                    ->attachData($pdf->output(), 'notificacion-comentario-eliminado.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
