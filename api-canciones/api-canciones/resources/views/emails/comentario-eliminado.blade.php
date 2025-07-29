<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .warning-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .comment-info {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎵 Song Review App</h1>
        <h2>Notificación de Comentario Eliminado</h2>
    </div>
    
    <div class="content">
        <p>Estimado/a <strong>{{ $usuario['nombre'] }}</strong>,</p>
        
        <div class="warning-box">
            <h3>⚠️ Su comentario ha sido eliminado</h3>
            <p>Le informamos que su comentario ha sido eliminado por incumplir nuestras normas de comunidad.</p>
        </div>
        
        <div class="comment-info">
            <h4>📝 Detalles del comentario eliminado:</h4>
            <p><strong>Canción:</strong> {{ $cancion['titulo'] ?? 'No disponible' }}</p>
            <p><strong>Su comentario:</strong></p>
            <blockquote style="background: #f1f1f1; padding: 15px; border-radius: 5px; margin: 10px 0;">
                "{{ $comentario['comentario'] }}"
            </blockquote>
            <p><strong>Calificación:</strong> {{ $comentario['calificacion'] }}/5 estrellas</p>
        </div>
        
        <h3>📋 Normas de la Comunidad</h3>
        <ul>
            <li>✅ Mantener el respeto hacia otros usuarios</li>
            <li>✅ Evitar lenguaje ofensivo o discriminatorio</li>
            <li>✅ Comentarios constructivos sobre la música</li>
            <li>❌ No spam o contenido irrelevante</li>
            <li>❌ No promociones no autorizadas</li>
        </ul>
        
        <div class="warning-box">
            <p><strong>Nota importante:</strong> Comentarios futuros que incumplan estas normas pueden resultar en la suspensión temporal o permanente de su cuenta.</p>
        </div>
        
        <p>Si considera que esta eliminación fue un error, puede contactarnos respondiendo a este correo.</p>
        
        <p>Gracias por su comprensión.</p>
        <p><strong>Equipo de Song Review App</strong></p>
    </div>
    
    <div class="footer">
        <p>Este es un mensaje automático, por favor no responda a este correo.</p>
        <p>© {{ date('Y') }} Song Review App. Todos los derechos reservados.</p>
    </div>
</body>
</html>
