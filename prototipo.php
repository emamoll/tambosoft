<?php 

include 'registrarConsumo.php';

?>
<!DOCTYPE html>
<HTML>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="estilo.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head> 
    <body>
        <form class="row" method="post" name="ppal">
            <div class="contenido row justify-content-center">
                <div class="row w-75 contenedor">
                    <h2 id="mensaje">Registrar un consumo</h2>
                </div>
                <div class="row w-75 ">
                    <input class="contenedor" type="text" id="Clock" name = "reloj" disabled >
                </div>
                <div class="row w-75 contenedor" id="primera">  <!-- Definir un width de 75% del padre, osea el container form-->
                    <label class="visually-hidden" for="alimentos">Preference</label>
                    <select class="form-select espacioIzquierda" id="alimentos" name="alimento" required oninvalid="this.setCustomValidity('Por favor seleccione un alimento')" oninput="setCustomValidity('')">
                      <option selected value="">Alimento *</option>
                      <option value="Alfalfa">Alfalfa</option>
                      <option value="Avena">Avena</option>
                      <option value="Trigo">Trigo</option> 
                    </select>
                </div>
                <div class="row w-75 contenedor">  <!-- Definir un width de 75% del padre, osea el container form-->
                    <label class="visually-hidden" for="categorias">Preference</label>
                    <select class="form-select espacioIzquierda bordes " id="categorias" name="categoria" required oninvalid="this.setCustomValidity('Por favor seleccione una categoria')" oninput="setCustomValidity('')">
                      <option selected value="">Categoria *</option>
                      <option value="Cria">Cría</option>
                      <option value="En Servicio">En Servicio</option>
                      <option value="Seca">Seca</option>
                    </select>
                </div>
                <div class="row w-75 contenedor">
                    <input class=" espacioIzquierda bordes  " type="number" id="Cantidad" placeholder="Cantidad  *" name="cantidad" required oninvalid="this.setCustomValidity('por favor ingrese una cantidad')" oninput="setCustomValidity('')">
                </div>
                <div class="row w-75 contenedor">
                    <button class="registrar btn btn-primary" id="boton">Registrar consumo </button>
                </div>
                <div class="row w-75 contenedor" id="modal" style="display:none"> <!-- div oculto -->
                       <h2 id="mensaje">¡Alimentación registrada con exito!</h2>
                </div>
            </div>
          </form>
          <script src="js.js"></script>
    </body>
    
</HTML>

