<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - SaludConnect</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card-registro { max-width: 550px; margin: 50px auto; border: none; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container">
    <div class="card card-registro p-4">
        <h3 class="text-center fw-bold text-primary mb-4">Crear Cuenta en SaludConnect</h3>
        
        <form action="LoginControlador.php?accion=registrar" method="POST" enctype="multipart/form-data">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="correo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono de Contacto</label>
                <input type="tel" name="telefono" class="form-control" placeholder="Ej: 261XxxXxx" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold text-secondary">¿Qué tipo de usuario sos?</label>
                <select name="rol" id="selector-rol" class="form-select border-primary" required>
                    <option value="" selected disabled>Seleccioná una opción...</option>
                    <option value="paciente">Soy Paciente (Busco atención médica)</option>
                    <option value="enfermero">Soy Enfermero Profesional (Ofrezco servicios)</option>
                </select>
            </div>

            <div id="campos-enfermero" style="display: none;" class="p-3 bg-light rounded border border-dashed mb-3">
                <h5 class="fw-bold text-primary mb-3">Datos Profesionales</h5>
                
                <div class="mb-3">
                    <label class="form-label">Número de Matrícula Profesional</label>
                    <input type="text" name="matricula" id="input-matricula" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Especialidad Principal</label>
                    <input type="text" name="especialidad" id="input-especialidad" class="form-control" placeholder="Ej: Pediatría, Cuidados Críticos, Inyectables">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tarifa Base por Consulta ($)</label>
                    <input type="number" name="tarifa" id="input-tarifa" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Adjuntar foto del Título o Matrícula (PDF o Imagen)</label>
                    <input type="file" name="documento" id="input-documento" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">Registrarme</button>
            
            <div class="text-center mt-3">
                <a href="login.php" class="small text-decoration-none">¿Ya tenés cuenta? Iniciá sesión</a>
            </div>
        </form>
    </div>
</div>

<script>
    const selectorRol = document.getElementById('selector-rol');
    const camposEnfermero = document.getElementById('campos-enfermero');
    
    // Capturamos los inputs para ponerlos o sacarlos como obligatorios
    const inputMatricula = document.getElementById('input-matricula');
    const inputEspecialidad = document.getElementById('input-especialidad');
    const inputTarifa = document.getElementById('input-tarifa');
    const inputDocumento = document.getElementById('input-documento');

    selectorRol.addEventListener('change', function() {
        if (this.value === 'enfermero') {
            // Mostramos los campos con un estilo bloque
            camposEnfermero.style.display = 'block';
            
            // Los hacemos requeridos obligatoriamente
            inputMatricula.required = true;
            inputEspecialidad.required = true;
            inputTarifa.required = true;
            inputDocumento.required = true;
        } else {
            // Si elige paciente, volvemos a ocultar todo
            camposEnfermero.style.display = 'none';
            
            // Le quitamos la obligatoriedad para que el formulario pueda enviarse limpio
            inputMatricula.required = false;
            inputEspecialidad.required = false;
            inputTarifa.required = false;
            inputDocumento.required = false;
        }
    });
</script>

</body>
</html>