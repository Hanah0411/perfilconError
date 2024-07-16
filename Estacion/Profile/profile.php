<?php
session_start(); // Inicia la sesión

// Depura el contenido de la sesión
var_dump($_SESSION);

// Verifica si el correo electrónico está almacenado en la sesión
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    echo "Error: Sesión no iniciada o correo electrónico no disponible.";
    exit;
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "parking";
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consultar datos del usuario
$query = "SELECT * FROM usuarios WHERE Correo = '$email'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $perfil = mysqli_fetch_assoc($result);
} else {
    echo "Error: No se encontró el perfil del usuario.";
    exit;
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
</head>
<body>
    <header class="header d-flex justify-content-between align-items-center">
        <div class="logo">
            <a href="https://campestreags.com">
                <img src="logo.png" height="50px" margin-right="10px">
            </a>
        </div>
        <nav class="ml-auto">
            <a href="/Estacion/Estacion/Index.html" class="mr-3">Dashboards <i class="bi bi-speedometer2"></i></a>
            <div class="dropdown mr-3">
                <a href="#" class="dropdown-toggle" id="levelsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Niveles <i class="bi bi-layers"></i></a>
                <div class="dropdown-menu" aria-labelledby="levelsDropdown">
                    <a class="dropdown-item" href="/Estacion/Estacion/Level/level.html">Nivel 1</a>
                    <a class="dropdown-item" href="/Estacion/Estacion/Level/level2.html">Nivel 2</a>
                    <a class="dropdown-item" href="/Estacion/Estacion/Level/level3.html">Nivel 3</a>
                    <a class="dropdown-item" href="/Estacion/Estacion/Level/level4.html">Nivel 4</a>
                </div>
            </div>
            <div class="dropdown mr-3">
                <a href="#" class="dropdown-toggle" id="basementsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sótanos <i class="bi bi-building"></i></a>
                <div class="dropdown-menu" aria-labelledby="basementsDropdown">
                    <a class="dropdown-item" href="/Estacion/Estacion/Level/level.html">Sótano 1</a>
                    <a class="dropdown-item" href="/Estacion/Estacion/Basement/basement2.html">Sótano 2</a>
                    <a class="dropdown-item" href="/Estacion/Estacion/Basement/basement3.html">Sótano 3</a>
                    <a class="dropdown-item" href="/Estacion/Estacion/Basement/basement4.html">Sótano 4</a>
                </div>
            </div>
            <div class="dropdown mr-3">
                <a href="#" class="dropdown-toggle" id="camerasDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cámaras <i class="bi bi-camera"></i></a>
                <div class="dropdown-menu" aria-labelledby="camerasDropdown">
                    <a class="dropdown-item" href="/Estacion/Estacion/Cameras/cameras.html">Niveles</a>
                    <a class="dropdown-item" href="/Estacion/Estacion/Sotanos/sotanos.html">Sótanos</a>
                </div>
            </div>
            <div class="user-icon">
                <a href="/Estacion/Estacion/Profile/profile.php">
                    <lord-icon
                    src="https://cdn.lordicon.com/bgebyztw.json"
                    trigger="hover"
                    colors="primary:#109173,secondary:#08a88a"
                    style="width:35px;height:35px">
                    </lord-icon>
                </a>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 text-center">
                <lord-icon
                src="https://cdn.lordicon.com/dxjqoygy.json"
                trigger="hover"
                colors="primary:#109173,secondary:#08a88a"
                style="width:100px;height:100px;cursor:pointer"
                data-toggle="modal" data-target="#profilePhotoModal">
                </lord-icon>
                <h2><?php echo $perfil['Nombre'] . ' ' . $perfil['Apellidos']; ?></h2>
                <a href="#">Ver el perfil</a>
                <div class="list-group mt-3">
                    <a href="#" class="list-group-item list-group-item-action active"><?php echo $perfil['Nombre'] . ' ' . $perfil['Apellidos']; ?></a>
                    <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#privacyModal">Privacidad <i class="fas fa-shield-alt"></i></a>
                    <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#changeAccountModal">Cambiar cuenta <i class="fas fa-exchange-alt"></i></a>
                    <a href="#" class="list-group-item list-group-item-action btn-red" data-toggle="modal" data-target="#logoutModal">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        Información del Usuario
                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#updateProfileModal">Actualizar Perfil <i class="fas fa-edit"></i></button>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> <?php echo $perfil['Nombre']; ?></p>
                        <p><strong>Apellidos:</strong> <?php echo $perfil['Apellido']; ?></p>
                        <p><strong>Correo Electrónico:</strong> <?php echo $perfil['Correo']; ?></p>
                        <p><strong>Teléfono:</strong> <?php echo $perfil['Numero_Telefono']; ?></p>
                        <p><strong>Fecha de Nacimiento:</strong> <?php echo $perfil['Fecha_Nacimiento']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Seleccionar Foto de Perfil -->
    <div class="modal fade" id="profilePhotoModal" tabindex="-1" aria-labelledby="profilePhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profilePhotoModalLabel">Seleccionar Foto de Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" class="form-control-file">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar <i class="fas fa-times"></i></button>
                    <button type="button" class="btn btn-primary">Subir Foto <i class="fas fa-upload"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Actualizar Perfil -->
    <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalLabel">Actualizar Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="inputName">Nombre</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Ingresa tu nombre">
                        </div>
                        <div class="form-group">
                            <label for="inputLastName">Apellidos</label>
                            <input type="text" class="form-control" id="inputLastName" placeholder="Ingresa tus apellidos">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Correo Electrónico</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Ingresa tu correo electrónico">
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">Teléfono</label>
                            <input type="tel" class="form-control" id="inputPhone" placeholder="Ingresa tu número telefónico">
                        </div>
                        <div class="form-group">
                            <label for="inputBirthdate">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="inputBirthdate">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar <i class="fas fa-times"></i></button>
                    <button type="button" class="btn btn-primary">Guardar Cambios <i class="fas fa-save"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Íconos Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Íconos Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.js"></script>
</body>
</html>

