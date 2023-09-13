<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion de plantilla</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/emojionearea@3.4.2/dist/emojionearea.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/emojionearea@3.4.2/dist/emojionearea.min.js"></script>
    <!-- Incluye las librerías de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .hidden-content {
        display: none;
    }

    #nombrePaquete {
        display: none;
    }
</style>

<body>

    <div class="container">
        <center>
            <h1>Crear plantilla</h1>
        </center> <br>
        <form method="POST" action=<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/create') ?> enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="edad" class="form-label"><strong>Nombre <?php echo htmlspecialchars($template['name']) ?></strong></label>
                <input type="text" class="form-control" id="templateName" name="templateName" placeholder="Name" required>
            </div>

            <div class="mb-3">
                <label for="language" class="form-label"> <strong>Idioma</strong></label>
                <select class="form-select" id="language" name="language" aria-label="Default select example">
                    <option selected><strong>Language</strong></option>
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
                    <option value="es">Español</option>
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

            <br>

            <div class="mb-3">
                <label for="templateCat" class="form-label"> <strong>Categoria</strong></label>
                <select class="form-select" id="templateCat" name="templateCat" aria-label="Default select example">
                    <option selected><strong>Categoria</strong></option>
                    <option value="MARKETING">MARKETING</option>
                    <option value="UTILITY">UTILIDAD</option>
                    <option value="AUTHENTICATION">AUTENTICACION</option>
                </select>
            </div>

            <div class="mb-3 hidden-content">
                <label for="header" class="form-label"> <strong>Tipo de encabezado</strong></label>
                <select class="form-select" size="3" id="header" name="header" multiple="multiple" aria-label="Default select example">
                    <option value="TEXT">TEXTO</option>
                    <option value="VIDEO">VIDEO</option>
                    <option value="IMAGE">IMAGEN</option>
                </select>

                <label for="campoDeTexto" id="labelCampoDeTexto" class="form-label" hidden> <strong>Texto de header</strong> </label>
                <input type="text" id="campoDeTexto" name="campoDeTexto" class="form-control" maxlength="60" placeholder="Puede cargar una variable con &#123;&#123;1&#125;&#125;" hidden>

                <div id="nuevoInput" style="display: none;">
                    <label for="inputNuevo">Variable</label>
                    <input type="text" id="inputNuevo" name="inputNuevo" class="form-control">
                </div>


                <input type="file" name="archivo" id="archivo" class="form-control" hidden>

            </div>

            <div class="form-group shadow-textarea hidden-content">
                <label for="textAreaTexto"><strong>Cuerpo</strong></label>
                <textarea id="textAreaTexto" name="text" class="form-control z-depth-1" name="text" rows="3" placeholder="Si desea utilizar variables ingrese &#123;&#123;1&#125;&#125;,&#123;&#123;2&#125;&#125;,&#123;&#123;3&#125;&#125;,&#123;&#123;4&#125;&#125;,&#123;&#123;5&#125;&#125 y marque 'Mostrar variables'" maxlength="1024"></textarea>

                <label for="mostrarVariableCheckbox">
                    <input class="form-check-input" type="checkbox" id="mostrarVariableCheckbox" onchange="mostrarVariableCuerpo()" />
                    <strong>Mostrar Variable</strong>
                </label>

                <div id="variableCuerpo" style="display: none;">
                    <label for="variableCuerpoInput">Variable 1: </label>
                    <input type="text" id="variableCuerpoInput" name="variableCuerpo" class="form-control" />
                </div>

                <!-- Agregar cuatro inputs y cadenas adicionales -->
                <div id="variableCuerpo2" style="display: none;">
                    <label for="variableCuerpoInput2">Variable 2: </label>
                    <input type="text" id="variableCuerpoInput2" name="variableCuerpo2" class="form-control" />
                </div>

                <div id="variableCuerpo3" style="display: none;">
                    <label for="variableCuerpoInput3">Variable 3: </label>
                    <input type="text" id="variableCuerpoInput3" name="variableCuerpo3" class="form-control" />
                </div>

                <div id="variableCuerpo4" style="display: none;">
                    <label for="variableCuerpoInput4">Variable 4: </label>
                    <input type="text" id="variableCuerpoInput4" name="variableCuerpo4" class="form-control" />
                </div>

                <div id="variableCuerpo5" style="display: none;">
                    <label for="variableCuerpoInput5">Variable 5: </label>
                    <input type="text" id="variableCuerpoInput5" name="variableCuerpo5" class="form-control" />
                </div>
            </div>

            <div class="mb-3 hidden-content">
                <label for="edad" class="form-label"><strong>Pie de pagina</strong></label>
                <input type="text" class="form-control" id="footer" name="footer" maxlength="60">
            </div>

            <div class="form-check form-switch hidden-content">
                <label>
                    <input class="form-check-input" type="checkbox" id="mostrarInputs"> <strong> Agregar boton (Respuesta rapida) </strong>
                </label>
            </div>

            <br>
            <div id="inputsContainer" style="display: none;">
                <h5><strong>Respuesta rapida</strong></h5> <br>
                <label for="input1"><strong>Boton 1</strong></label>
                <input class="form-control" type="text" id="button1" name="button1" maxlength="25">
                <br>
                <label for="input2"><strong>Boton 2 (Opcional)</strong></label>
                <input class="form-control" type="text" id="button2" name="button2" maxlength="25">
                <br>
                <label for="input3"><strong>Boton 3 (Opcional)</strong></label>
                <input class="form-control" type="text" id="button3" name="button3" maxlength="25">
            </div>
            <br>

            <div class="form-check form-switch hidden-content">
                <label>
                    <input class="form-check-input" type="checkbox" id="mostrarInputscallback"> <strong> Agregar boton (Llamada a la accion) </strong>
                </label>
            </div>

            <div id="inputsContainercallback" style="display: none;"> <br>
                <h5><strong>Llamada a la accion</strong></h5>
                <label for="input1"><strong>Texto</strong></label>
                <input class="form-control" type="text" id="buttonCallbackText" name="buttonCallbackText" maxlength="25">
                <label for="input2"><strong>Codigo Pais</strong></label>
                <select class="form-select" id="buttoCallbackCountry" name="buttoCallbackCountry" aria-label="Default select example">
                    <option selected></option>
                    <option value="93">Afghanistan (93)</option>
                    <option value="358">Åland Islands (358)</option>
                    <option value="355">Albania (355)</option>
                    <option value="213">Algeria (213)</option>
                    <option value="1">American Samoa (1)</option>
                    <option value="376">Andorra (376)</option>
                    <option value="244">Angola (244)</option>
                    <option value="1">Anguilla (1)</option>
                    <option value="672">Antarctica (672)</option>
                    <option value="1">Antigua and Barbuda (1)</option>
                    <option value="54">Argentina (54)</option>
                    <option value="374">Armenia (374)</option>
                    <option value="297">Aruba (297)</option>
                    <option value="61">Australia (61)</option>
                    <option value="43">Austria (43)</option>
                    <option value="994">Azerbaijan (994)</option>
                    <option value="1">Bahamas (1)</option>
                    <option value="973">Bahrain (973)</option>
                    <option value="880">Bangladesh (880)</option>
                    <option value="1">Barbados (1)</option>
                    <option value="375">Belarus (375)</option>
                    <option value="32">Belgium (32)</option>
                    <option value="501">Belize (501)</option>
                    <option value="229">Benin (229)</option>
                    <option value="1">Bermuda (1)</option>
                    <option value="975">Bhutan (975)</option>
                    <option value="591">Bolivia (Plurinational State of) (591)</option>
                    <option value="599">Bonaire, Sint Eustatius and Saba (599)</option>
                    <option value="387">Bosnia and Herzegovina (387)</option>
                    <option value="267">Botswana (267)</option>
                    <option value="47">Bouvet Island (47)</option>
                    <option value="55">Brazil (55)</option>
                    <option value="246">British Indian Ocean Territory (246)</option>
                    <option value="246">United States Minor Outlying Islands (246)</option>
                    <option value="1">Virgin Islands (British) (1)</option>
                    <option value="1 340">Virgin Islands (U.S.) (1 340)</option>
                    <option value="673">Brunei Darussalam (673)</option>
                    <option value="359">Bulgaria (359)</option>
                    <option value="226">Burkina Faso (226)</option>
                    <option value="257">Burundi (257)</option>
                    <option value="855">Cambodia (855)</option>
                    <option value="237">Cameroon (237)</option>
                    <option value="1">Canada (1)</option>
                    <option value="238">Cabo Verde (238)</option>
                    <option value="1">Cayman Islands (1)</option>
                    <option value="236">Central African Republic (236)</option>
                    <option value="235">Chad (235)</option>
                    <option value="56">Chile (56)</option>
                    <option value="86">China (86)</option>
                    <option value="61">Christmas Island (61)</option>
                    <option value="61">Cocos (Keeling) Islands (61)</option>
                    <option value="57">Colombia (57)</option>
                    <option value="269">Comoros (269)</option>
                    <option value="242">Congo (242)</option>
                    <option value="243">Congo (Democratic Republic of the) (243)</option>
                    <option value="682">Cook Islands (682)</option>
                    <option value="506">Costa Rica (506)</option>
                    <option value="385">Croatia (385)</option>
                    <option value="53">Cuba (53)</option>
                    <option value="599">Curaçao (599)</option>
                    <option value="357">Cyprus (357)</option>
                    <option value="420">Czech Republic (420)</option>
                    <option value="45">Denmark (45)</option>
                    <option value="253">Djibouti (253)</option>
                    <option value="1">Dominica (1)</option>
                    <option value="1">Dominican Republic (1)</option>
                    <option value="593">Ecuador (593)</option>
                    <option value="20">Egypt (20)</option>
                    <option value="503">El Salvador (503)</option>
                    <option value="240">Equatorial Guinea (240)</option>
                    <option value="291">Eritrea (291)</option>
                    <option value="372">Estonia (372)</option>
                    <option value="251">Ethiopia (251)</option>
                    <option value="500">Falkland Islands (Malvinas) (500)</option>
                    <option value="298">Faroe Islands (298)</option>
                    <option value="679">Fiji (679)</option>
                    <option value="358">Finland (358)</option>
                    <option value="33">France (33)</option>
                    <option value="594">French Guiana (594)</option>
                    <option value="689">French Polynesia (689)</option>
                    <option value="262">French Southern Territories (262)</option>
                    <option value="241">Gabon (241)</option>
                    <option value="220">Gambia (220)</option>
                    <option value="995">Georgia (995)</option>
                    <option value="49">Germany (49)</option>
                    <option value="233">Ghana (233)</option>
                    <option value="350">Gibraltar (350)</option>
                    <option value="30">Greece (30)</option>
                    <option value="299">Greenland (299)</option>
                    <option value="1">Grenada (1)</option>
                    <option value="590">Guadeloupe (590)</option>
                    <option value="1">Guam (1)</option>
                    <option value="502">Guatemala (502)</option>
                    <option value="44">Guernsey (44)</option>
                    <option value="224">Guinea (224)</option>
                    <option value="245">Guinea-Bissau (245)</option>
                    <option value="592">Guyana (592)</option>
                    <option value="509">Haiti (509)</option>
                    <option value="672">Heard Island and McDonald Islands (672)</option>
                    <option value="379">Vatican City (379)</option>
                    <option value="504">Honduras (504)</option>
                    <option value="36">Hungary (36)</option>
                    <option value="852">Hong Kong (852)</option>
                    <option value="354">Iceland (354)</option>
                    <option value="91">India (91)</option>
                    <option value="62">Indonesia (62)</option>
                    <option value="225">Ivory Coast (225)</option>
                    <option value="98">Iran (Islamic Republic of) (98)</option>
                    <option value="964">Iraq (964)</option>
                    <option value="353">Ireland (353)</option>
                    <option value="44">Isle of Man (44)</option>
                    <option value="972">Israel (972)</option>
                    <option value="39">Italy (39)</option>
                    <option value="1">Jamaica (1)</option>
                    <option value="81">Japan (81)</option>
                    <option value="44">Jersey (44)</option>
                    <option value="962">Jordan (962)</option>
                    <option value="76">Kazakhstan (76)</option>
                    <option value="254">Kenya (254)</option>
                    <option value="686">Kiribati (686)</option>
                    <option value="965">Kuwait (965)</option>
                    <option value="996">Kyrgyzstan (996)</option>
                    <option value="856">Lao People's Democratic Republic (856)</option>
                    <option value="371">Latvia (371)</option>
                    <option value="961">Lebanon (961)</option>
                    <option value="266">Lesotho (266)</option>
                    <option value="231">Liberia (231)</option>
                    <option value="218">Libya (218)</option>
                    <option value="423">Liechtenstein (423)</option>
                    <option value="370">Lithuania (370)</option>
                    <option value="352">Luxembourg (352)</option>
                    <option value="853">Macao (853)</option>
                    <option value="389">North Macedonia (389)</option>
                    <option value="261">Madagascar (261)</option>
                    <option value="265">Malawi (265)</option>
                    <option value="60">Malaysia (60)</option>
                    <option value="960">Maldives (960)</option>
                    <option value="223">Mali (223)</option>
                    <option value="356">Malta (356)</option>
                    <option value="692">Marshall Islands (692)</option>
                    <option value="596">Martinique (596)</option>
                    <option value="222">Mauritania (222)</option>
                    <option value="230">Mauritius (230)</option>
                    <option value="262">Mayotte (262)</option>
                    <option value="52">Mexico (52)</option>
                    <option value="691">Micronesia (Federated States of) (691)</option>
                    <option value="373">Moldova (Republic of) (373)</option>
                    <option value="377">Monaco (377)</option>
                    <option value="976">Mongolia (976)</option>
                    <option value="382">Montenegro (382)</option>
                    <option value="1">Montserrat (1)</option>
                    <option value="212">Morocco (212)</option>
                    <option value="258">Mozambique (258)</option>
                    <option value="95">Myanmar (95)</option>
                    <option value="264">Namibia (264)</option>
                    <option value="674">Nauru (674)</option>
                    <option value="977">Nepal (977)</option>
                    <option value="31">Netherlands (31)</option>
                    <option value="687">New Caledonia (687)</option>
                    <option value="64">New Zealand (64)</option>
                    <option value="505">Nicaragua (505)</option>
                    <option value="227">Niger (227)</option>
                    <option value="234">Nigeria (234)</option>
                    <option value="683">Niue (683)</option>
                    <option value="672">Norfolk Island (672)</option>
                    <option value="850">Korea (Democratic People's Republic of) (850)</option>
                    <option value="1">Northern Mariana Islands (1)</option>
                    <option value="47">Norway (47)</option>
                    <option value="968">Oman (968)</option>
                    <option value="92">Pakistan (92)</option>
                    <option value="680">Palau (680)</option>
                    <option value="970">Palestine, State of (970)</option>
                    <option value="507">Panama (507)</option>
                    <option value="675">Papua New Guinea (675)</option>
                    <option value="595">Paraguay (595)</option>
                    <option value="51">Peru (51)</option>
                    <option value="63">Philippines (63)</option>
                    <option value="64">Pitcairn (64)</option>
                    <option value="48">Poland (48)</option>
                    <option value="351">Portugal (351)</option>
                    <option value="1">Puerto Rico (1)</option>
                    <option value="974">Qatar (974)</option>
                    <option value="383">Republic of Kosovo (383)</option>
                    <option value="262">Réunion (262)</option>
                    <option value="40">Romania (40)</option>
                    <option value="7">Russian Federation (7)</option>
                    <option value="250">Rwanda (250)</option>
                    <option value="590">Saint Barthélemy (590)</option>
                    <option value="290">Saint Helena, Ascension and Tristan da Cunha (290)</option>
                    <option value="1">Saint Kitts and Nevis (1)</option>
                    <option value="1">Saint Lucia (1)</option>
                    <option value="590">Saint Martin (French part) (590)</option>
                    <option value="508">Saint Pierre and Miquelon (508)</option>
                    <option value="1">Saint Vincent and the Grenadines (1)</option>
                    <option value="685">Samoa (685)</option>
                    <option value="378">San Marino (378)</option>
                    <option value="239">Sao Tome and Principe (239)</option>
                    <option value="966">Saudi Arabia (966)</option>
                    <option value="221">Senegal (221)</option>
                    <option value="381">Serbia (381)</option>
                    <option value="248">Seychelles (248)</option>
                    <option value="232">Sierra Leone (232)</option>
                    <option value="65">Singapore (65)</option>
                    <option value="1">Sint Maarten (Dutch part) (1)</option>
                    <option value="421">Slovakia (421)</option>
                    <option value="386">Slovenia (386)</option>
                    <option value="677">Solomon Islands (677)</option>
                    <option value="252">Somalia (252)</option>
                    <option value="27">South Africa (27)</option>
                    <option value="500">South Georgia and the South Sandwich Islands (500)</option>
                    <option value="82">Korea (Republic of) (82)</option>
                    <option value="34">Spain (34)</option>
                    <option value="94">Sri Lanka (94)</option>
                    <option value="249">Sudan (249)</option>
                    <option value="211">South Sudan (211)</option>
                    <option value="597">Suriname (597)</option>
                    <option value="47">Svalbard and Jan Mayen (47)</option>
                    <option value="268">Swaziland (268)</option>
                    <option value="46">Sweden (46)</option>
                    <option value="41">Switzerland (41)</option>
                    <option value="963">Syrian Arab Republic (963)</option>
                    <option value="886">Taiwan (886)</option>
                    <option value="992">Tajikistan (992)</option>
                    <option value="255">Tanzania, United Republic of (255)</option>
                    <option value="66">Thailand (66)</option>
                    <option value="670">Timor-Leste (670)</option>
                    <option value="228">Togo (228)</option>
                    <option value="690">Tokelau (690)</option>
                    <option value="676">Tonga (676)</option>
                    <option value="1">Trinidad and Tobago (1)</option>
                    <option value="216">Tunisia (216)</option>
                    <option value="90">Turkey (90)</option>
                    <option value="993">Turkmenistan (993)</option>
                    <option value="1">Turks and Caicos Islands (1)</option>
                    <option value="688">Tuvalu (688)</option>
                    <option value="256">Uganda (256)</option>
                    <option value="380">Ukraine (380)</option>
                    <option value="971">United Arab Emirates (971)</option>
                    <option value="44">United Kingdom of Great Britain and Northern Ireland (44)</option>
                    <option value="1">United States of America (1)</option>
                    <option value="598">Uruguay (598)</option>
                    <option value="998">Uzbekistan (998)</option>
                    <option value="678">Vanuatu (678)</option>
                    <option value="58">Venezuela (Bolivarian Republic of) (58)</option>
                    <option value="84">Vietnam (84)</option>
                    <option value="681">Wallis and Futuna (681)</option>
                    <option value="212">Western Sahara (212)</option>
                    <option value="967">Yemen (967)</option>
                    <option value="260">Zambia (260)</option>
                    <option value="263">Zimbabwe (263)</option>
                </select>
                <label for="input3"><strong>Numero telefono</strong></label>
                <input class="form-control" type="number" id="buttonCallbackPhone" name="buttonCallbackPhone" maxlength="20"> <br>

                <h5><strong>Ir al sitio web</strong></h5>
                <label for="input1"><strong>Texto</strong></label>
                <input class="form-control" type="text" id="buttonWebText" name="buttonWebText">
                <label for="input2"><strong>Url del sitio</strong></label>
                <input class="form-control" type="text" id="buttonWebUrl" name="buttonWebUrl">
            </div>
            <div class="authentication-div">

                <div class="form-check form-switch">
                    <div class="mb-3">
                        <label for="" class="form-label"> <strong>TIPO OTP</strong></label>
                        <select class="form-select" id="otp_type" name="otp_type" aria-label="Default select example">
                            <option selected></option>
                            <option value="ONE_TAP">AUTOCOMPLETAR</option>
                            <option value="COPY_CODE">COPIAR CODIGO</option>
                        </select>
                    </div>

                    <div id="nombrePaquete">
                        <input type="text" class="form-control" id="Nombrepaquete" name="Nombrepaquete" placeholder="Nombre del paquete">
                        <input type="text" class="form-control" id="Hashpaquete" name="Hashpaquete" placeholder="Hash del paquete">
                        <label for=""><strong> Boton autocompletado </strong></label>
                        <input type="text" class="form-control" id="buttonAutocompletar" name="buttonAutocompletar" placeholder="Autocompletar">
                    </div>
                    <div id="caducidad">
                        <label for="caducidad"><strong>Agrega la fecha de caducidad para el código</strong></label>
                        <input type="number" class="form-control" id="caducidad" name="caducidad" placeholder="Ingresa un valor entre 1 y 90" max="90">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Send</button> <br> <br>
            <center><a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/templates'); ?>" class="btn btn-primary">Templates</a></center>
        </form>

        <br>
        <br> <br> <br> <br> <br> <br> <br> <br> <br>
    </div>

    <script>
        $(document).ready(function() {
            $("#textAreaTexto").emojioneArea();
        });
        $("#textAreaTexto").emojioneArea({
            pickerPosition: "bottom" // Esto coloca el picker de emoticones en la parte inferior del textarea
        });

        function mostrarVariableCuerpo() {
            var desiredText = "{{1}}"; // Cambia esto por la cadena específica que deseas
            var inputValue = $("#textAreaTexto").val().toLowerCase();
            var mostrarVariableCheckbox = document.getElementById("mostrarVariableCheckbox");

            var variableInput = $("#variableCuerpo");
            if (inputValue.includes(desiredText) && mostrarVariableCheckbox.checked) {
                variableInput.show();
            } else {
                variableInput.hide();
            }

            var variableInput2 = $("#variableCuerpo2");
            var desiredText2 = "{{2}}"; // Cambia esto por la cadena específica que deseas
            if (inputValue.includes(desiredText2) && mostrarVariableCheckbox.checked) {
                variableInput2.show();
            } else {
                variableInput2.hide();
            }

            var variableInput3 = $("#variableCuerpo3");
            var desiredText3 = "{{3}}"; // Cambia esto por la cadena específica que deseas
            if (inputValue.includes(desiredText3) && mostrarVariableCheckbox.checked) {
                variableInput3.show();
            } else {
                variableInput3.hide();
            }

            var variableInput4 = $("#variableCuerpo4");
            var desiredText4 = "{{4}}"; // Cambia esto por la cadena específica que deseas
            if (inputValue.includes(desiredText4) && mostrarVariableCheckbox.checked) {
                variableInput4.show();
            } else {
                variableInput4.hide();
            }

            var variableInput5 = $("#variableCuerpo5");
            var desiredText5 = "{{5}}"; // Cambia esto por la cadena específica que deseas
            if (inputValue.includes(desiredText3) && mostrarVariableCheckbox.checked) {
                variableInput5.show();
            } else {
                variableInput5.hide();
            }
        }
    </script>

    <script>
        const otpSelect = document.getElementById('otp_type');
        const nombrePaqueteDiv = document.getElementById('nombrePaquete');

        otpSelect.addEventListener('change', function() {
            if (this.value === 'ONE_TAP') {
                nombrePaqueteDiv.style.display = 'block';
            } else {
                nombrePaqueteDiv.style.display = 'none';
            }
        });
    </script>

    <script>
        const selectElement = document.getElementById('header');
        const inputElement = document.getElementById('campoDeTexto');
        const labelElement = document.getElementById('labelCampoDeTexto');

        selectElement.addEventListener('change', () => {
            const selectedOption = selectElement.options[selectElement.selectedIndex].value;

            if (selectedOption === 'TEXT') {
                inputElement.removeAttribute('hidden');
                labelElement.removeAttribute('hidden');
            } else {
                inputElement.setAttribute('hidden', 'true');
                labelElement.setAttribute('hidden', 'true');
            }

        });

        const checkbox = document.getElementById('mostrarInputs');
        const inputsContainer = document.getElementById('inputsContainer');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                inputsContainer.style.display = 'block';
            } else {
                inputsContainer.style.display = 'none';
            }
        });


        const checkboxcallback = document.getElementById('mostrarInputscallback');
        const inputsContainercallback = document.getElementById('inputsContainercallback');

        checkboxcallback.addEventListener('change', function() {
            if (checkboxcallback.checked) {
                inputsContainercallback.style.display = 'block';
            } else {
                inputsContainercallback.style.display = 'none';
            }
        });
    </script>
    <script>
        const selectHeader = document.getElementById('header');
        const inputFile = document.getElementById('archivo');
        selectHeader.addEventListener('change', () => {
            const selectedOption = selectHeader.options[selectHeader.selectedIndex].value;
            const isFileOption = ['DOCUMENT', 'IMAGE', 'VIDEO'].includes(selectedOption);
            if (isFileOption) {
                inputFile.removeAttribute('hidden');
            } else {
                inputFile.setAttribute('hidden', 'true');
            }
        });
    </script>
    <script>
        document.getElementById('campoDeTexto').addEventListener('input', function() {

            const textoIngresado = this.value;
            const nuevoInput = document.getElementById('nuevoInput');

            if (textoIngresado.includes("{{1}}")) {
                nuevoInput.style.display = 'block';
            } else {

                nuevoInput.style.display = 'none';
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoriaSelector = document.getElementById('templateCat');

            const authenticationDiv = document.querySelector('.authentication-div');
            const elementosOcultos = document.querySelectorAll('.hidden-content');

            function toggleContenido() {
                const selectedOption = categoriaSelector.value;
                if (selectedOption === 'MARKETING' || selectedOption === 'UTILITY') {
                    elementosOcultos.forEach(element => {
                        element.style.display = 'block';
                    });
                } else {
                    elementosOcultos.forEach(element => {
                        element.style.display = 'none';
                    });
                }
            }

            function toggleAuthenticationDiv() {
                const selectedOption = categoriaSelector.value;
                if (selectedOption === 'AUTHENTICATION') {
                    authenticationDiv.style.display = 'block';
                } else {
                    authenticationDiv.style.display = 'none';
                }
            }
            categoriaSelector.addEventListener('change', toggleAuthenticationDiv);

            // Llamamos a la función para que se oculte/muestre en la carga inicial
            toggleAuthenticationDiv();

            // Asignamos el evento al selector de categoría
            categoriaSelector.addEventListener('change', toggleContenido);

            // Llamamos a la función para que se oculte/muestre en la carga inicial
            toggleContenido();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mostrarInputsCheckbox = document.getElementById('mostrarInputs');
            const mostrarInputscallbackCheckbox = document.getElementById('mostrarInputscallback');
            const formSwitchRespuesta = document.querySelector('.form-switch.hidden-content');
            const formSwitchLlamada = document.querySelectorAll('.form-check.form-switch.hidden-content')[1];

            mostrarInputsCheckbox.addEventListener('change', function() {
                if (mostrarInputsCheckbox.checked) {
                    formSwitchLlamada.style.display = 'none';
                } else {
                    formSwitchLlamada.style.display = 'block';
                }
            });

            mostrarInputscallbackCheckbox.addEventListener('change', function() {
                if (mostrarInputscallbackCheckbox.checked) {
                    formSwitchRespuesta.style.display = 'none';
                } else {
                    formSwitchRespuesta.style.display = 'block';
                }
            });
        });
    </script>
    <script>
        function validateForm() {
            // Obtiene el valor del campo templateName
            var templateName = document.getElementById('templateName').value;

            // Define una expresión regular para permitir solo letras minúsculas y guiones bajos
            var pattern = /^[a-z0-9_]+$/;

            // Realiza la validación
            if (!pattern.test(templateName)) {
                // El nombre de la plantilla no cumple con los requisitos
                alert("El nombre de la plantilla solo puede contener letras minúsculas y guiones bajos.");
                return false; // Evita que el formulario se envíe
            }

            // Si el nombre de la plantilla es válido, permite que el formulario se envíe
            return true;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>