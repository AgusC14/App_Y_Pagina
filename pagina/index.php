<?php
$usuario = "Agustín"; 
$titulo_sitio = "SaludConnect - Gestión de Enfermería";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_sitio; ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Estilos personalizados para mejorar el diseño base */
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .hero-section { 
            background: linear-gradient(135deg, #0052cc 0%, #003399 100%); 
            color: white; 
            padding: 60px 0; 
            margin-bottom: 40px;
        }
        .card-profesional { 
            border: none; 
            border-radius: 12px; 
            transition: transform 0.2s; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card-profesional:hover { transform: translateY(-5px); }
        .navbar-brand { font-weight: bold; }
        #ai-assistant-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            z-index: 1000;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">🩺 SaludConnect</a>
            <div class="navbar-nav ms-auto">
                <span class="nav-link text-white">Hola, <?php echo $usuario; ?>!</span>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Encontrá tu enfermero a domicilio</h1>
            <p class="lead">Profesionales validados y cerca de tu ubicación.</p>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Ej: Inyectables, Curaciones...">
                        <button class="btn btn-warning fw-bold px-4">Buscar Ahora</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <h2 class="mb-4 fw-bold">Especialistas disponibles</h2>
        <div class="row">
            
            <div class="col-md-4 mb-4">
                <div class="card card-profesional h-100">
                    <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Enfermero" style="height: 200px; object-fit: cover; border-radius: 12px 12px 0 0;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Lic. Agustín Cabañez</h5>
                        <p class="text-primary mb-1">Especialista en Cuidados Críticos</p>
                        <p class="card-text text-muted small">Inyectables • Control de Presión • Curaciones</p>
                        <p class="small">Más de 5 años de experiencia en centros públicos y privados.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3">
                        <button class="btn btn-outline-primary w-100">Contactar</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card card-profesional h-100">
                    <img src="https://images.unsplash.com/photo-1559839734-2b71f1536783?auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Enfermera" style="height: 200px; object-fit: cover; border-radius: 12px 12px 0 0;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Enf. María García</h5>
                        <p class="text-primary mb-1">Especialista en Pediatría</p>
                        <p class="card-text text-muted small">Nebulizaciones • Extracciones • Vacunas</p>
                        <p class="small">Atención domiciliaria especializada en recién nacidos y niños.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3">
                        <button class="btn btn-outline-primary w-100">Contactar</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 border-primary border-dashed bg-light d-flex align-items-center justify-content-center text-center p-4" style="border: 2px dashed #0052cc;">
                    <div>
                        <h5 class="fw-bold">¿Sos enfermero?</h5>
                        <p class="small">Sumate a la red más grande de la zona.</p>
                        <a href="#" class="btn btn-primary btn-sm">Registrarme ahora</a>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-white border-top py-4 mt-5">
        <div class="container text-center">
            <p class="text-muted mb-0">© 2026 SaludConnect - Proyecto Software Development</p>
            <small class="text-muted">Cumpliendo normas ISO de Gestión de Calidad e Integridad de Datos.</small>
        </div>
    </footer>

    <button id="ai-assistant-btn" class="btn btn-primary shadow-lg d-flex align-items-center justify-content-center" onclick="alert('Iniciando Asistente SaludConnect...')">
        <span class="fs-4">💬</span>
    </button>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>