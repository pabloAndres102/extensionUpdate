<style>
    .carousel-card {
        display: inline-block;
        /* Hacer que el contenedor se ajuste al contenido */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }


    .carousel-card label {
        margin-top: 5px;
    }

    .carousel-card textarea,
    .carousel-card input[type="text"],
    .carousel-card input[type="url"] {
        width: 100%;
        margin-top: 5px;
    }

    .carousel-card textarea {
        height: 100px;
        /* Ajusta la altura del textarea según sea necesario */
    }
</style>

<center>
    <h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Create carousel'); ?></h1>
</center> <br>
<center><a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/templates'); ?>" class="btn btn-primary"><span class="material-icons">description</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Templates'); ?></a></center>


<form action=<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/carousel') ?> enctype="multipart/form-data" method="post">
    <div class="mb-3">
        <label for="edad" class="form-label"><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/widgettheme', 'Name'); ?> <?php echo htmlspecialchars($template['name']) ?></strong></label>
        <input type="text" class="form-control" id="templateName" name="templateName" placeholder=<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/widgettheme', 'Name'); ?> pattern="[a-z_]+" title="Por favor, ingresa solo letras minúsculas y guiones bajos" required>
    </div>

    <div class="mb-3">
        <label for="language" class="form-label"> <strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/cannedmsg', 'Language'); ?></strong></label>
        <select class="form-select" id="language" name="language" aria-label="Default select example" required>
            <option selected value="es">Español</option>
            <option value="af">Afrikáans</option>
            <option value="sq">Albanés</option>
            <option value="ar">Árabe</option>
            <option value="az">Azerí</option>
            <option value="bn">Bengalí</option>
            <option value="bg">Búlgaro</option>
            <option value="ca">Catalán</option>
            <option value="zh_CN">Chino (China)</option>
            <option value="zh_HK">Chino (Hong Kong)</option>
            <option value="zh_TW">Chino (Tailandia)</option>
            <option value="cs">Checo</option>
            <option value="nl">Holandés</option>
            <option value="en">Inglés</option>
            <option value="en_GB">Inglés (Reino Unido)</option>
            <option value="es_LA">Inglés (EE. UU.)</option>
            <option value="et">Estonio</option>
            <option value="fil">Filipino</option>
            <option value="fi">Finlandés</option>
            <option value="fr">Francés</option>
            <option value="de">Alemán</option>
            <option value="el">Griego</option>
            <option value="gu">Guyaratí</option>
            <option value="he">Hebreo</option>
            <option value="hi">Hindi</option>
            <option value="hu">Húngaro</option>
            <option value="id">Indonesio</option>
            <option value="ga">Irlandés</option>
            <option value="it">Italiano</option>
            <option value="ja">Japonés</option>
            <option value="kn">Canarés</option>
            <option value="kk">Kazajo</option>
            <option value="ko">Coreano</option>
            <option value="lo">Lao</option>
            <option value="lv">Letón</option>
            <option value="lt">Lituano</option>
            <option value="mk">Macedonio</option>
            <option value="ms">Malayo</option>
            <option value="mr">Maratí</option>
            <option value="nb">Noruego</option>
            <option value="fa">Persa</option>
            <option value="pl">Polaco</option>
            <option value="pt_BR">Portugués (Brasil)</option>
            <option value="pt_PT">Portugués (Portugal)</option>
            <option value="pa">Punyabí</option>
            <option value="ro">Rumano</option>
            <option value="ru">Ruso</option>
            <option value="sr">Serbio</option>
            <option value="sk">Eslovaco</option>
            <option value="sl">Esloveno</option>
            <option value="es_AR">Español (Argentina)</option>
            <option value="es_ES">Español (España)</option>
            <option value="es_MX">Español (México)</option>
            <option value="sw">Suajili</option>
            <option value="sv">Sueco</option>
            <option value="ta">Tamil</option>
            <option value="te">Telugu</option>
            <option value="th">Tailandés</option>
            <option value="tr">Turco</option>
            <option value="uk">Ucraniano</option>
            <option value="ur">Urdu</option>
            <option value="uz">Uzbeko</option>
            <option value="vi">Vietnamita</option>
        </select>
    </div>

    <input type="hidden" name="templateCat" value="MARKETING">
    <input type="hidden" id="numTarjetas" name="numTarjetas" value="0">


    <div class="mb-3">
        <label for="header" class="form-label"> <strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Header type'); ?></strong><small> (Card header)</small></label>
        <select class="form-select" id="header" name="header" aria-label="Default select example" required>
            <option value=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Without header'); ?></option>
            <option value="VIDEO"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Video'); ?></option>
            <option value="IMAGE"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Image'); ?></option>
        </select>
        <br>
        <div>
            <label for="cardBody"><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Body'); ?></strong><small> (Message bubble)</small></label>
            <textarea id="cardBody" name="cardBody" class="form-control z-depth-1" rows="3" maxlength="1024" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Remember that you can load a maximum of 5 variables'); ?>"></textarea>
            <button type="button" onclick="agregarVariable()" class="btn btn-primary"><span class="material-icons">visibility</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Agregar variable'); ?></button>
        </div>
        <br>
        <br>
        <div style="flex: 1;">
            <a href="#" id="showImageLink"><span class="material-icons">
                    question_mark
                </span>Ver ejemplo</a>
            <div id="imageContainer" style="display: none;">
                <img id="imageToShow" src="https://scontent.feoh3-1.fna.fbcdn.net/v/t39.2365-6/400516056_3407655096213958_4402509594423009060_n.png?stp=dst-webp&_nc_cat=102&ccb=1-7&_nc_sid=e280be&_nc_ohc=jsRvy7q2tQkAX9d7ic4&_nc_ht=scontent.feoh3-1.fna&oh=00_AfC2GImtpy-2GJqXhvhTEbS2cT-J32kN6UXdeQksS0aneA&oe=6626556E" alt="Imagen">
            </div>
        </div>
        <div class="mb-3" style="display: flex;">
            <div style="flex: 1;">
                <h3><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Tarjeta de carrusel'); ?></strong></h3>
                <button type="button" onclick="agregarTarjeta()" class="btn btn-primary"><span class="material-icons">add</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Agregar tarjeta'); ?></button>
                <div id="carouselContainer" style="display: flex; flex-wrap: wrap;"></div>
                <div class="notice-container">
                    <div class="notice">
                        <mark>
                            <span class="material-icons">error</span>
                            <span class="text">Tenga en cuenta que las imágenes cargadas en cada tarjeta son tomadas como ejemplos. Asegúrese de adjuntar la imagen correspondiente al enviar la el carrusel.</span>
                        </mark>
                    </div>
                </div>

            </div>
        </div>

    </div>


    </div>

    <button type="submit" class="btn btn-success"><span class="material-icons">send</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons', 'Create'); ?></button>
</form>
<script>
    var numTarjetas = 0; // Iniciar con 1 en lugar de 0

    function agregarTarjeta() {
        var container = document.getElementById('carouselContainer');
        // Crear el contenedor de la tarjeta
        var tarjetaDiv = document.createElement('div');
        tarjetaDiv.className = 'col-md-4'; // Bootstrap column class
        tarjetaDiv.id = 'tarjeta' + numTarjetas;

        // Crear la tarjeta
        var tarjeta = document.createElement('div');
        tarjeta.className = 'carousel-card';
        tarjeta.innerHTML = `
    <label for="textAreacard${numTarjetas}"><strong>Cuerpo de tarjeta</strong><small> (Card body)</small></label>
    <textarea id="textAreacard${numTarjetas}" name="textAreacard${numTarjetas}" class="form-control z-depth-1" rows="2" maxlength="1024" required></textarea>
    <label for="buttonquickcard${numTarjetas}"><strong>Boton de respuesta rapida</strong><small> (Card buttons)</small></label>
    <input class="form-control" type="text" id="buttonquickcard${numTarjetas}" name="buttonquickcard${numTarjetas}" maxlength="25" required>
    <label for="urlButton${numTarjetas}"><strong>Boton de enlace URL</strong><small> (Card buttons)</small></label>
    <input class="form-control" type="url" id="urlButton${numTarjetas}" name="urlButton${numTarjetas}" maxlength="500" required>
    <label for="archivo${numTarjetas}"><strong>Imagen de tarjeta</strong></label>
    <input type="file" id="archivo${numTarjetas}" name="archivo${numTarjetas}" class="form-control" required>
    <button type="button" onclick="eliminarTarjeta('tarjeta${numTarjetas}')" class="btn btn-danger">Eliminar</button>
`;


        // Agregar la tarjeta al contenedor
        tarjetaDiv.appendChild(tarjeta);

        // Obtener la tarjeta de ejemplo
        var exampleCard = document.getElementById('imageContainer').parentNode.parentNode;

        // Insertar la nueva tarjeta después de la tarjeta de ejemplo
        exampleCard.insertAdjacentElement('afterend', tarjetaDiv);

        numTarjetas++;
        document.getElementById('numTarjetas').value = numTarjetas;
    }

    function eliminarTarjeta(id) {
        var tarjeta = document.getElementById(id);
        tarjeta.parentNode.removeChild(tarjeta);
        document.getElementById('numTarjetas').value = numTarjetas;
    }
</script>
<script>
    function agregarVariable() {
        // Obtener el textarea y su contenido actual
        let textarea = document.getElementById('cardBody');
        let contenido = textarea.value;

        // Contar cuántas variables ya están presentes
        let numVariables = (contenido.match(/{{\d+}}/g) || []).length;

        // Verificar si ya se han agregado 5 variables
        if (numVariables < 5) {
            // Agregar la cadena {{n}} al contenido del textarea
            contenido += ' {{' + (numVariables + 1) + '}} ';
            // Actualizar el contenido del textarea
            textarea.value = contenido;
        } else {
            // Si ya se han agregado 5 variables, mostrar un mensaje de error
            alert('Solo se permiten hasta 5 variables.');
        }
    }
</script>
<script>
    document.getElementById('showImageLink').addEventListener('click', function(e) {
        e.preventDefault();
        var imageContainer = document.getElementById('imageContainer');
        if (imageContainer.style.display === 'none') {
            imageContainer.style.display = 'block';
        } else {
            imageContainer.style.display = 'none';
        }
    });
</script>