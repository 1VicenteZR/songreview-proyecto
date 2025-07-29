<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 40px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .warning-box {
            background: #fff3cd;
            border: 2px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .comment-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
        }
        .rules-section {
            margin: 30px 0;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎵 SONG REVIEW APP</h1>
        <h2>NOTIFICACIÓN OFICIAL</h2>
        <h3>Comentario Eliminado</h3>
    </div>
    
    <div class="warning-box">
        <h3>⚠️ AVISO IMPORTANTE</h3>
        <p><strong>Su comentario ha sido eliminado por incumplir las normas de nuestra comunidad.</strong></p>
    </div>
    
    <h3>👤 INFORMACIÓN DEL USUARIO</h3>
    <p><strong>Nombre:</strong> {{ $usuario['nombre'] }}</p>
    <p><strong>Email:</strong> {{ $usuario['email'] }}</p>
    <p><strong>Fecha de notificación:</strong> {{ $fecha }}</p>
    
    <div class="comment-details">
        <h3>📝 DETALLES DEL COMENTARIO ELIMINADO</h3>
        <p><strong>Canción:</strong> {{ $cancion['titulo'] ?? 'No disponible' }}</p>
        <p><strong>Álbum:</strong> {{ $cancion['album']['titulo'] ?? 'No disponible' }}</p>
        <p><strong>Artista(s):</strong> 
            @if(isset($cancion['artistas']) && count($cancion['artistas']) > 0)
                @if(is_array($cancion['artistas']))
                    {{ implode(', ', array_column($cancion['artistas'], 'nombre')) }}
                @else
                    {{ $cancion['artistas']->pluck('nombre')->implode(', ') }}
                @endif
            @else
                No disponible
            @endif
        </p>
        <p><strong>Su comentario:</strong></p>
        <div style="background: #e9ecef; padding: 15px; border-radius: 5px; margin: 10px 0; font-style: italic;">
            "{{ $comentario['comentario'] }}"
        </div>
        <p><strong>Calificación otorgada:</strong> {{ $comentario['calificacion'] }}/5 estrellas</p>
    </div>
    
    <div class="rules-section">
        <h3>📋 NORMAS DE LA COMUNIDAD</h3>
        <h4>✅ Comportamientos Permitidos:</h4>
        <ul>
            <li>Comentarios respetuosos y constructivos</li>
            <li>Críticas musicales fundamentadas</li>
            <li>Intercambio de opiniones cordial</li>
            <li>Recomendaciones musicales relevantes</li>
        </ul>
        
        <h4>❌ Comportamientos Prohibidos:</h4>
        <ul>
            <li>Lenguaje ofensivo, discriminatorio o inapropiado</li>
            <li>Ataques personales a otros usuarios</li>
            <li>Spam o contenido irrelevante</li>
            <li>Promociones no autorizadas</li>
            <li>Contenido que incite al odio</li>
        </ul>
    </div>
    
    <div class="warning-box">
        <h4>⚡ ADVERTENCIA</h4>
        <p>El incumplimiento reiterado de estas normas puede resultar en:</p>
        <ul>
            <li>Eliminación de comentarios futuros</li>
            <li>Suspensión temporal de la cuenta</li>
            <li>Suspensión permanente en casos graves</li>
        </ul>
    </div>
    
    <h3>📞 CONTACTO</h3>
    <p>Si considera que esta eliminación fue un error, puede contactarnos en: soporte@songreviewapp.com</p>
    
    <div class="footer">
        <p><strong>Song Review App - Sistema de Gestión de Comentarios</strong></p>
        <p>Documento generado automáticamente el {{ $fecha }}</p>
        <p>© {{ date('Y') }} Song Review App. Todos los derechos reservados.</p>
    </div>
</body>
</html>
