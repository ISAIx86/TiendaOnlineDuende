<header>
<div class="container text-center">
    <div class="row">
        <div class="col-sm-8">
            <img src='../../resources/logo02.PNG' class='logotipo'/>
        </div>
        <div class="col-sm-4">
            <div class = "row">
                <div class = "col-6">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <h5 id="txt_usertag"><?php echo $loggedUser['Username']?></h5>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../../php/includes/usuarios/close_session_inc.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>