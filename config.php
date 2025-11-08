<?php
// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir la librería de Google API (asegúrate de tener composer instalado)
require_once 'vendor/autoload.php';

// Crear instancia del cliente de Google
$google_client = new Google_Client();

// Configurar el ID de cliente de OAuth 2.0 (de Google Cloud Console)
$google_client->setClientId('453457364670-amodukq771bm3leu23ecqb9kmqg3gk8n.apps.googleusercontent.com');

// Configurar la clave secreta del cliente OAuth 2.0
$google_client->setClientSecret('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');

// Establecer la URI de redirección (debe coincidir exactamente con la registrada en Google Cloud Console)
$google_client->setRedirectUri('http://localhost/login_google.php');

// Solicitar permisos de email y perfil público
$google_client->addScope('email');
$google_client->addScope('profile');
