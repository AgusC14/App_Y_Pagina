<?php
// publico/index.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .hero-section { background: linear-gradient(135deg, #0052cc 0%, #003399 100%); color: white; padding: 60px 0; margin-bottom: 40px; }
        .card-profesional { border: none; border-radius: 12px; transition: transform 0.2s; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card-profesional:hover { transform: translateY(-5px); }
        .navbar-brand { font-weight: bold; cursor: pointer; }
        #ai-assistant-btn { position: fixed; bottom: 20px; right: 20px; width: 60px; height: 60px; border-radius: 50%; z-index: 1000; }
        
        /* Estilo unificado de tarjetas corregido (padding en CSS) */
        .card-auth { max-width: 500px; margin: 60px auto; border: none; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); background-color: #ffffff; padding: 1.5rem; }
        
        /* Animación suave de transición entre pantallas */
        .seccion-dinamica { transition: opacity 0.25s ease-in-out; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-primary shadow-sm py-3">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <a class="navbar-brand m-0 p-0 fs-4" onclick="mostrarSeccion('inicio')">🩺 SaludConnect</a>
            
            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <span class="text-white me-3 fw-semibold small">Hola, <?php echo $_SESSION['usuario']; ?>!</span>
                    <a href="logout.php" class="text-white text-decoration-none small fw-normal">Salir</a>
                <?php else: ?>
                    <a href="#" onclick="mostrarSeccion('registro')" class="text-white text-decoration-none me-3 me-sm-4 small fw-normal">Creá tu cuenta</a>
                    <a href="#" onclick="mostrarSeccion('login')" class="text-white text-decoration-none small fw-normal">Ingresá</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div id="seccion-inicio" class="seccion-dinamica">
        <header class="hero-section text-center">
            <div class="container">
                <h1 class="display-4 fw-bold px-2">Encontrá tu enfermero a domicilio</h1>
                <p class="lead px-2">Profesionales validados y cerca de tu ubicación.</p>
                
                <div class="row justify-content-center mt-4 px-3">
                    <div class="col-12 col-lg-8 col-xl-6">
                        <div class="input-group shadow-sm">
                            <input type="text" class="form-control form-control-lg" placeholder="Ej: Inyectables, Curaciones...">
                            <button class="btn btn-warning fw-bold px-4 text-nowrap">Buscar Ahora</button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="container">
            <h2 class="mb-4 fw-bold px-2">Especialistas disponibles</h2>
            
            <div class="row px-2">
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card card-profesional h-100">
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Enfermero" style="height: 200px; object-fit: cover; border-radius: 12px 12px 0 0;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Lic. Agustín Cabañez</h5>
                            <p class="text-primary mb-1 fw-semibold">Especialista en Cuidados Críticos</p>
                            <p class="card-text text-muted small mb-2">Inyectables • Control de Presión • Curaciones</p>
                            <p class="small text-secondary">Más de 5 años de experiencia en centros públicos y privados.</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3">
                            <button class="btn btn-outline-primary w-100 fw-semibold">Contactar</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card card-profesional h-100">
                        <img src="https://images.unsplash.com/photo-1559839734-2b71f1536783?auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Enfermera" style="height: 200px; object-fit: cover; border-radius: 12px 12px 0 0;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Enf. María García</h5>
                            <p class="text-primary mb-1 fw-semibold">Especialista en Pediatría</p>
                            <p class="card-text text-muted small mb-2">Nebulizaciones • Extracciones • Vacunas</p>
                            <p class="small text-secondary">Atención domiciliaria especializada en recién nacidos y niños.</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3">
                            <button class="btn btn-outline-primary w-100">Contactar</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 bg-light d-flex align-items-center justify-content-center text-center p-4 border-primary" style="border: 2px dashed #0052cc; border-radius: 12px;">
                        <div>
                            <h5 class="fw-bold text-dark">¿Sos enfermero?</h5>
                            <p class="small text-muted px-3">Sumate a la red más grande de la zona y gestioná tus pacientes.</p>
                            <button onclick="mostrarSeccion('registro')" class="btn btn-primary btn-sm fw-bold px-3 py-2 shadow-sm">Registrarme ahora</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="seccion-login" class="seccion-dinamica container" style="display: none;">
        <div class="card card-auth mt-5 mb-5">
            <div class="d-flex align-items-center mb-4">
                <button onclick="mostrarSeccion('inicio')" class="btn btn-link text-decoration-none text-muted p-0 me-3 fs-3 line-height-1" style="margin-top: -6px;" title="Volver al inicio">←</button>
                <h2 class="fw-bold text-primary m-0">Iniciar Sesión</h2>
            </div>

            <form action="../app/controladores/LoginControlador.php?accion=login" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control py-2" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary">Contraseña</label>
                    <input type="password" name="contrasena" class="form-control py-2" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm fs-5">Ingresar</button>
                <div class="text-center mt-3">
                    <span class="small text-muted">¿No tenés cuenta? <a href="#" onclick="mostrarSeccion('registro')" class="text-decoration-none fw-semibold">Registrate</a></span>
                </div>
            </form>
        </div>
    </div>

    <div id="seccion-registro" class="seccion-dinamica container" style="display: none;">
        <div class="card card-auth mt-4 mb-5" style="max-width: 550px;">
            <div class="d-flex align-items-center mb-4">
                <button onclick="mostrarSeccion('inicio')" class="btn btn-link text-decoration-none text-muted p-0 me-3 fs-3 line-height-1" style="margin-top: -6px;" title="Volver al inicio">←</button>
                <h2 class="fw-bold text-primary m-0 fs-3">Crear Cuenta en SaludConnect</h2>
            </div>
            
            <form action="../app/controladores/LoginControlador.php?accion=registrar" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-secondary">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-secondary">Apellido</label>
                        <input type="text" name="apellido" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-secondary">Teléfono</label>
                        <input type="tel" name="telefono" class="form-control" placeholder="Ej: 261XXXXXXX" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-secondary">Localidad / Barrio</label>
                        <input type="text" name="localidad" class="form-control" placeholder="Ej: Godoy Cruz" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Contraseña</label>
                    <input type="password" name="contrasena" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">¿Qué tipo de usuario sos?</label>
                    <select name="rol" id="selector-rol" class="form-select border-primary fw-semibold" required>
                        <option value="" selected disabled>Seleccioná una opción...</option>
                        <option value="paciente">Soy Paciente (Busco atención médica)</option>
                        <option value="enfermero">Soy Enfermero Profesional (Ofrezco servicios)</option>
                    </select>
                </div>

                <div id="campos-enfermero" style="display: none;" class="p-3 bg-light rounded border mb-4">
                    <h5 class="fw-bold text-primary mb-3">Datos Profesionales</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold">Matrícula Profesional</label>
                            <input type="text" name="matricula" id="input-matricula" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold">Tarifa Base ($)</label>
                            <input type="number" name="tarifa" id="input-tarifa" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Especialidad</label>
                        <input type="text" name="especialidad" id="input-especialidad" class="form-control" placeholder="Ej: Pediatría, Curaciones">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Zonas de Cobertura Domiciliaria</label>
                        <input type="text" name="zona_cobertura" id="input-zona" class="form-control" placeholder="Ej: Godoy Cruz, Guaymallén, Ciudad">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Adjuntar Título (PDF/Imagen)</label>
                        <input type="file" name="documento" id="input-documento" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm fs-5">Registrarme</button>
                <div class="text-center mt-3">
                    <span class="small text-muted">¿Ya tenés cuenta? <a href="#" onclick="mostrarSeccion('login')" class="text-decoration-none fw-semibold">Iniciá sesión</a></span>
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-white border-top py-4 mt-5">
        <div class="container text-center">
            <p class="text-muted mb-0">© 2026 SaludConnect - Proyecto Software Development</p>
        </div>
    </footer>

    <button id="ai-assistant-btn" class="btn btn-primary shadow-lg d-flex align-items-center justify-content-center" onclick="alert('Iniciando Asistente SaludConnect...')">
        <span class="fs-4">💬</span>
    </button>

    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        function mostrarSeccion(seccion) {
            // Ocultamos todas las vistas primero
            document.getElementById('seccion-inicio').style.display = 'none';
            document.getElementById('seccion-login').style.display = 'none';
            document.getElementById('seccion-registro').style.display = 'none';

            // Encendemos sólo la que el usuario clickeó
            if (seccion === 'inicio') {
                document.getElementById('seccion-inicio').style.display = 'block';
            } else if (seccion === 'login') {
                document.getElementById('seccion-login').style.display = 'block';
            } else if (seccion === 'registro') {
                document.getElementById('seccion-registro').style.display = 'block';
            }
            
            // Scroll arriba suave instantáneo
            window.scrollTo({top: 0, behavior: 'smooth'});
        }

        // Mostrar u ocultar campos extras del formulario de registro según el Rol
        const selectorRol = document.getElementById('selector-rol');
        if(selectorRol) {
            const camposEnfermero = document.getElementById('campos-enfermero');
            const inputMatricula = document.getElementById('input-matricula');
            const inputEspecialidad = document.getElementById('input-especialidad');
            const inputTarifa = document.getElementById('input-tarifa');
            const inputZona = document.getElementById('input-zona');
            const inputDocumento = document.getElementById('input-documento');

            selectorRol.addEventListener('change', function() {
                if (this.value === 'enfermero') {
                    camposEnfermero.style.display = 'block';
                    if(inputMatricula) inputMatricula.required = true;
                    if(inputEspecialidad) inputEspecialidad.required = true;
                    if(inputTarifa) inputTarifa.required = true;
                    if(inputZona) inputZona.required = true;
                    if(inputDocumento) inputDocumento.required = true;
                } else {
                    camposEnfermero.style.display = 'none';
                    if(inputMatricula) inputMatricula.required = false;
                    if(inputEspecialidad) inputEspecialidad.required = false;
                    if(inputTarifa) inputTarifa.required = false;
                    if(inputZona) inputZona.required = false;
                    if(inputDocumento) inputDocumento.required = false;
                }
            });
        }
    </script>
</body>
</html>