window.addEventListener('load', function () { /*Slider del main*/

    var url_api = 'http://api-rest-proyecto.com.devel';
    //var url_api ='http://apirestlaravel.erpsolutionscr.com';
    //var url_api ='https://erpsolutionscr.com/apirestlaravel/public'; Funciona adecuadamente

    var sliderT = document.querySelector('#slider');
    function cambiaImagen() {
        document.slider.src = imagenes[i];
        if (i >= (imagenes.length - 1)) {
            i = 0;
        } else {
            i ++;
        }
        setTimeout(function () {
            cambiaImagen()
        }, tiempo);
    }

    if (sliderT !== null) {

        var imagenes = [];
        imagenes[0] = '../img/1.jpeg';
        imagenes[1] = '../img/2.jpeg';
        imagenes[2] = '../img/3.jpeg';
        imagenes[3] = '../img/4.jpeg';
        imagenes[4] = '../img/5.jpeg';
        imagenes[5] = '../img/6.jpeg';
        var tiempo = 3000;
        var i = 0;
        document.slider.src = imagenes[0];
        cambiaImagen();
    }

    var selectPeso = document.querySelector('#birth_weight');
    if (selectPeso !== null) {
        for (let i = 15; i < 400; i += 0.5) {
            var option = document.createElement('option');
            option.value = i;
            option.innerHTML = i;
            selectPeso.append(option);
        }
    }
    var selectPesoVenta = document.querySelector('#weight');
    if (selectPesoVenta !== null) {
        for (let i = 50; i < 1500; i += 0.5) {
            var option = document.createElement('option');
            option.value = i;
            option.innerHTML = i;
            selectPesoVenta.append(option);
        }
    }
    var selectComision = document.querySelector('#auction_commission');
    if (selectComision !== null) {
        for (let i = 1; i < 20; i += 0.5) {
            var option = document.createElement('option');
            option.value = i;
            option.innerHTML = i;
            selectComision.append(option);
        }
    }

    /*Validación de formulario Cambio de contraseña*/
    const mostrarError = (element, error) => {
        const divError = document.createElement("div");
        divError.setAttribute("class", "error");
        divError.innerHTML = error;
        document.querySelector(element).parentElement.prepend(divError);
    }

    const mostrarErrorEmail = (element, error) => {

        const divError = document.createElement("div");
        divError.setAttribute("class", "errorMail");
        divError.innerHTML = error;
        document.querySelector(element).parentElement.prepend(divError);

    }


    var plantillaAuctionOptions = `
            <div id="options">
            <div class="mb-3">
            <label class="form-label" for="price_kg">Monto por kilogramo:</label>
                                <div><input class="form-control" id="price_kg" name="price_kg" type="text"></div>
                                </div>
            <div class="mb-3">
            <label class="form-label" for="auction_commission">Comisión de la subasta (Porcentaje): (Ejem: 5)</label>
                                <div><select class="form-control" id="auction_commission" name="auction_commission" type="text"></select></div>
                                </div>
            <div class="mb-3">
            <label class="form-label" for="auction_name">Nombre de la subasta:</label>
                                <div> <select class="form-control" id="auction_name" name="auction_name" required>
                                <option value="Subasta Ganadera Rio Blanco">Subasta Ganadera Rio Blanco</option>
                                <option value="Subasta ExpoPococí (Guápiles)">Subasta Expococí (Guápiles)</option>
                                <option value="Subasta de Valle la Estrella">Subasta de Valle la Estrella</option>
                                <option value="Cámara de Ganaderos Unidos del Sur" >Cámara de Ganaderos Unidos del Sur</option>
                                <option value="Subasta Ganadera UPAP">Subasta Ganadera UPAP</option>
                                <option value="Subasta Ganadera Sancarleña S.A.">Subasta Ganadera Sancarleña S.A.</option>
                                <option value="Subasta Ganadera Maleco Guatuso S.A.">Subasta Ganadera Maleco Guatuso S.A.</option>
                                <option value="Subasta Ganadera Montecillos, Upala">Subasta Ganadera Montecillos, Upala</option>
                                <option value="Grupo de Subastas Sarapiquí PJ">Grupo de Subastas Sarapiquí PJ</option>
                                <option value="Subasta Ganadera El Progreso de Nicoya">Subasta Ganadera El Progreso de Nicoya</option>
                                <option value="Subasta Cámara de Ganaderos de Santa Cruz">Subasta Cámara de Ganaderos de Santa Cruz</option>
                                <option value="Subasta Cámara de Ganaderos de Cañas">Subasta Cámara de Ganaderos de Cañas</option>
                                <option value="Subasta Limonal">Subasta Limonal</option>
                                <option value="Subasta de Tilarán">Subasta de Tilarán</option>
                                <option value="Subasta Cámara de Ganaderos de Hojancha">Subasta Cámara de Ganaderos de Hojancha</option>
                                <option value="Subasta de Ganadera Liberia 07">Subasta de Ganadera Liberia 07</option>
                                <option value="Subasta Ganadera AGAINPA">Subasta Ganadera AGAINPA</option>
                                <option value="Subasta Ganadera El Progreso">Subasta Ganadera El Progreso</option>
                                <option value="Subasta Ganadera de Parrita">Subasta Ganadera de Parrita</option>
                                <option value="Subasta Salamá (Neilly)">Subasta Salamá (Neilly)</option>
                                <option value="Subasta San Vito (Cotobruceña)">Subasta San Vito (Cotobruceña)</option>
                                <option value="Otro">Otro</option>
                            </select></div>
                                </div>
        </div>    

    `;


    var formUpdateUser = document.querySelector('#formUpdateUser');

    if (formUpdateUser !== null) {
        var inputPassCurrent = document.getElementById('passwordCurrent');
        var inputPassword1 = document.getElementById('password1');
        var inputPassword2 = document.getElementById('password2');
        var btnChangePassword = document.getElementById('btnChangePassword');

        var validacion = false;

        inputPassCurrent.addEventListener('keyup', function (e) {
            validacionPass = validarActual();
            //validarPassword();
        });
        inputPassword1.addEventListener('keyup', function (e) {
            validacionPass = validarPassword();
        });
        inputPassword2.addEventListener('keyup', function (e) {
            validacionPass = validarPassword();
        });

        formUpdateUser.addEventListener('submit', function (e) {
            if (!validacionPass) {
                alert("Debe corregir las contraseñas");
                e.preventDefault();
            }
           
            var valor;
            if (validacionPass) {
                valor = confirm("¿Esta seguro que desea cambiar su contraseña?");
                if (valor) {} else {
                    e.preventDefault();
                }
            }
        });

        function validarPassword() {
            var passCurrent = inputPassCurrent.value;
            var password1 = inputPassword1.value;
            var password2 = inputPassword2.value;

            // Patron para los numeros
            const patron1 = new RegExp("[0-9]+");

            // Patron para las letras
            const patron2 = new RegExp("[a-zA-Z]+");

            // Patron para las Correo
            const patron3 = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            for (let div of document.querySelectorAll("div[class=error]")) {
                div.remove();
            }
            for (let div of document.querySelectorAll("div[class=success]")) {
                div.remove();
            }
            if ( password1.length < 8 || password1.search(patron1) < 0 || password1.search(patron2) < 0 || password1 != password2 || password2.length < 8 || passCurrent == "" || password2.search(patron1) < 0 || password2.search(patron2) < 0) {
                if (passCurrent == "") {
                    mostrarError("input[name=passwordCurrent]", "Indicar tu contraseña actual");
                }
                if (password1.length < 6) {
                    mostrarError("input[name=password1]", "La longitud mínima tiene que ser de 8 caracteres");
                } else if (password1 != password2) {
                    mostrarError("input[name=password2]", "Las contraseñas no coinciden");
                } else if (password1.search(patron1) < 0 || password1.search(patron2) < 0) {
                    mostrarError("input[name=password1]", "La contraseña tiene que tener números y letras");
                } else if (password2.length < 6) {
                    mostrarError("input[name=password2]", "La longitud mínima tiene que ser de 8 caracteres");
                } else if (password2.search(patron1) < 0 || password2.search(patron2) < 0) {
                    mostrarError("input[name=password2]", "La contraseña tiene que tener numeros y letras");
                }
                return false;
            }
            return true;
        }

        function validarActual() {
            var passCurrent = document.getElementById("passwordCurrent").value;
            for (let div of document.querySelectorAll("div[class=error]")) {
                div.remove();
            }
            for (let div of document.querySelectorAll("div[class=success]")) {
                div.remove();
            }
            if (passCurrent == "") {
                if (passCurrent == "") {
                    mostrarError("input[name=passwordCurrent]", "Indicar tu contraseña actual");
                }
                return false;
            }
            return true;
        }

        function validarCorreos() {

            var email = inputEmail1.value;
            var email2 = inputEmail2.value;

            // Patron para los correos
            const patron3 = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            for (let div of document.querySelectorAll("div[class=errorMail]")) {
                div.remove();
            }
            for (let div of document.querySelectorAll("div[class=success]")) {
                div.remove();
            }
            if (! patron3.test(email) || ! patron3.test(email2) || email != email2) {
                if (! patron3.test(email)) {
                    mostrarErrorEmail("input[name=email]", "El correo no tienen el formato correcto");
                } else if (! patron3.test(email2)) {
                    mostrarErrorEmail("input[name=email2]", "El correo no tienen el formato correcto");
                } else if (email != email2) {
                    mostrarErrorEmail("input[name=email2]", "Los correos no coinciden");
                }
                return false;
            }
            return true;
        }

    }

    /***************************Validaciones mejoradas***************************************** */
    const mostrarErrorMejorado = (element, error, name) => {
        const divError = document.createElement("div");
        divError.setAttribute("class", "error");
        divError.setAttribute("id", "error" + name);
        divError.innerHTML = error;
        document.querySelector(element).parentElement.prepend(divError);
    }
    const borrarError = (name) => { // const div = document.querySelector("div[id=error"+name+"]");
        for (let div of document.querySelectorAll("div[id=error" + name + "]")) {
            div.remove();
        }

    }

    var formPurchaseAnimal = document.querySelector('#formPurchaseAnimal');

    if (formPurchaseAnimal !== null) {
        var inputNickname = document.getElementById('nickname');
        var inputCertification_name = document.getElementById('certification_name');
        var inputRegistration_number = document.getElementById('registration_number');
        var inputCode = document.getElementById('code');
        var inputPrice_total = document.getElementById('price_total');
        var inputPrice_kg = document.getElementById('price_kg');
        var inputAuction_commission = document.getElementById('auction_commission');
        var inputAuction_name = document.getElementById('auction_name');
        var inputDescription = document.getElementById('description');
        var btnRegister = document.getElementById('btnRegister');

        var inputPurchase_type = document.getElementById('purchase_type');

        var validacion = true;
        var validacion1 = true;
        var validacion2 = true;
        var validacion3 = true;
        var validacion4 = true;
        var validacion5 = true;
        var validacion6 = true;
        var validacion7 = true;
        var validacion8 = true;

        var auctionOptions = document.getElementById('action_options');
        var options = document.getElementById('options');

        if (inputPurchase_type.value == "Subasta" && options == null) {
            auctionOptions.innerHTML = plantillaAuctionOptions;
            auctionOptionsFunction();
        }

        inputPurchase_type.addEventListener('change', function (e) {

            if (inputPurchase_type.value == "Subasta") {
                auctionOptions.innerHTML = plantillaAuctionOptions;
                auctionOptionsFunction();
            } else {
                var options = document.getElementById('options');
                if (options != null) {
                    options.remove();
                    validacion5 = true;
                    validacion6 = true;
                    validacion7 = true;
                }
            }
        })

        btnRegister.addEventListener('focus', function (e) {
            if (inputNickname.value == '' || null) {} else {
                validacion = validarAlfaNumerico(name);
            }
            if (inputCertification_name.value == '' || null) {} else {
                validacion1 = validarAlfaNumerico(name);
            }
            if (inputRegistration_number.value == '' || null) {} else {
                validacion2 = validarAlfaNumerico(name);
            } validacion3 = validarAlfaNumerico('code');
            validacion4 = validarNumerico('price_total');

            var options = document.getElementById('options');
            if (options != null) {
                validacion5 = validarNumerico('price_kg');
                validacion6 = validarNumerico('auction_commission');
                validacion7 = validarAlfaNumerico('auction_name');
            }

            validacion8 = validarAlfaNumericoTextarea('description');
        });

        inputNickname.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (inputNickname.value == '' || null) {} else {
                validacion = validarAlfaNumerico(name);
            }

        });
        inputNickname.addEventListener('keyup', function (e) {
            if (! validacion) {
                var name = e.srcElement.getAttribute('name');
                if (inputNickname.value == '' || null) {} else {
                    validacion = validarAlfaNumerico(name);
                }
            }
        });
        inputCertification_name.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (inputCertification_name.value == '' || null) {} else {
                validacion1 = validarAlfaNumerico(name);
            }

        });
        inputCertification_name.addEventListener('keyup', function (e) {
            if (! validacion1) {
                var name = e.srcElement.getAttribute('name');
                if (inputCertification_name.value == '' || null) {} else {
                    validacion1 = validarAlfaNumerico(name);
                }
            }
        });
        inputRegistration_number.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (inputRegistration_number.value == '' || null) {} else {
                validacion2 = validarAlfaNumerico(name);
            }

        });
        inputRegistration_number.addEventListener('keyup', function (e) {
            if (! validacion2) {
                var name = e.srcElement.getAttribute('name');
                if (inputRegistration_number.value == '' || null) {} else {
                    validacion2 = validarAlfaNumerico(name);
                }
            }
        });
        inputCode.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion3 = validarAlfaNumerico(name);
        });
        inputCode.addEventListener('keyup', function (e) {
            if (! validacion3) {
                var name = e.srcElement.getAttribute('name');
                validacion3 = validarAlfaNumerico(name);
            }
        });
        inputPrice_total.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion4 = validarNumerico(name);
        });
        inputPrice_total.addEventListener('keyup', function (e) {
            if (! validacion4) {
                var name = e.srcElement.getAttribute('name');
                validacion4 = validarNumerico(name);
            }
        });

        inputDescription.addEventListener('keyup', function (e) {
            if (! validacion8) {
                var name = e.srcElement.getAttribute('name');
                validacion8 = validarAlfaNumericoTextarea(name);
            }
        });
        if (options != null) {
            auctionOptionsFunction();
        }
        formPurchaseAnimal.addEventListener('submit', function (e) {
            if (! validacion || ! validacion1 || ! validacion2 || ! validacion3 || ! validacion4 || ! validacion5 || ! validacion6 || ! validacion7 || ! validacion8) {
                alert("Debe corregir los datos ingresados");
                e.preventDefault();
            }

            var valor;
            if (validacion && validacion1 && validacion2 && validacion3 && validacion4 && validacion5 && validacion6 && validacion7 && validacion8) {
                valor = confirm("¿Esta seguro que desea registrar la compra?");
                if (valor) {} else {
                    e.preventDefault();
                }
            }
        });
    }

    var formUpdatePurchase = document.querySelector('#formUpdatePurchase');

    if (formUpdatePurchase !== null) {
     
        var inputPrice_total = document.getElementById('price_total');
        var inputPrice_kg = document.getElementById('price_kg');
        var inputAuction_commission = document.getElementById('auction_commission');
        var inputAuction_name = document.getElementById('auction_name');
        var inputDescription = document.getElementById('description');
        var btnRegister = document.getElementById('btnRegister');

        var inputPurchase_type = document.getElementById('purchase_type');

        var validacion = true;
        var validacion1 = true;
        var validacion2 = true;
        var validacion3 = true;
        var validacion4 = true;
        var validacion5 = true;
        var validacion6 = true;
        var validacion7 = true;
        var validacion8 = true;

        var auctionOptions = document.getElementById('action_options');
        var options = document.getElementById('options');

        if (inputPurchase_type.value == "Subasta" && options == null) {
            auctionOptions.innerHTML = plantillaAuctionOptions;
            auctionOptionsFunction();
        }

        inputPurchase_type.addEventListener('change', function (e) {

            if (inputPurchase_type.value == "Subasta") {
                auctionOptions.innerHTML = plantillaAuctionOptions;
                auctionOptionsFunction();
            } else {
                var options = document.getElementById('options');
                if (options != null) {
                    options.remove();
                    validacion5 = true;
                    validacion6 = true;
                    validacion7 = true;
                }
            }
        })

        btnRegister.addEventListener('focus', function (e) {
           
            validacion4 = validarNumerico('price_total');

            var options = document.getElementById('options');
            if (options != null) {
                validacion5 = validarNumerico('price_kg');
                validacion6 = validarNumerico('auction_commission');
                validacion7 = validarAlfaNumerico('auction_name');
            }

            validacion8 = validarAlfaNumericoTextarea('description');
        });

        inputPrice_total.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion4 = validarNumerico(name);
        });
        inputPrice_total.addEventListener('keyup', function (e) {
            if (! validacion4) {
                var name = e.srcElement.getAttribute('name');
                validacion4 = validarNumerico(name);
            }
        });

        inputDescription.addEventListener('keyup', function (e) {
            if (! validacion8) {
                var name = e.srcElement.getAttribute('name');
                validacion8 = validarAlfaNumericoTextarea(name);
            }
        });
        if (options != null) {
            auctionOptionsFunction();
        }
        formUpdatePurchase.addEventListener('submit', function (e) {
            if ( ! validacion4 || ! validacion5 || ! validacion6 || ! validacion7 || ! validacion8) {
                alert("Debe corregir los datos ingresados");
                e.preventDefault();
            }

            var valor;
            if ( validacion4 && validacion5 && validacion6 && validacion7 && validacion8) {
                valor = confirm("¿Esta seguro que desea registrar la compra?");
                if (valor) {} else {
                    e.preventDefault();
                }
            }
        });
    }

    var formUpdateSale = document.querySelector('#formUpdateSale');

    if (formUpdateSale !== null) {
     
        var inputPrice_total = document.getElementById('price_total');
        var inputPrice_kg = document.getElementById('price_kg');
        var inputAuction_commission = document.getElementById('auction_commission');
        var inputAuction_name = document.getElementById('auction_name');
        var inputDescription = document.getElementById('description');
        var btnRegister = document.getElementById('btnRegister');

        var inputSale_type = document.getElementById('sale_type');

        var validacion = true;
        var validacion1 = true;
        var validacion2 = true;
        var validacion3 = true;
        var validacion4 = true;
        var validacion5 = true;
        var validacion6 = true;
        var validacion7 = true;
        var validacion8 = true;

        var auctionOptions = document.getElementById('action_options');
        var options = document.getElementById('options');

        if (inputSale_type.value == "Subasta" && options == null) {
            auctionOptions.innerHTML = plantillaAuctionOptions;
            auctionOptionsFunction();
        }

        inputSale_type.addEventListener('change', function (e) {

            if (inputSale_type.value == "Subasta") {
                auctionOptions.innerHTML = plantillaAuctionOptions;
                auctionOptionsFunction();
            } else {
                var options = document.getElementById('options');
                if (options != null) {
                    options.remove();
                    validacion5 = true;
                    validacion6 = true;
                    validacion7 = true;
                }
            }
        })

        btnRegister.addEventListener('focus', function (e) {
           
            validacion4 = validarNumerico('price_total');

            var options = document.getElementById('options');
            if (options != null) {
                validacion5 = validarNumerico('price_kg');
                validacion6 = validarNumerico('auction_commission');
                validacion7 = validarAlfaNumerico('auction_name');
            }

            validacion8 = validarAlfaNumericoTextarea('description');
        });

        inputPrice_total.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion4 = validarNumerico(name);
        });
        inputPrice_total.addEventListener('keyup', function (e) {
            if (! validacion4) {
                var name = e.srcElement.getAttribute('name');
                validacion4 = validarNumerico(name);
            }
        });

        inputDescription.addEventListener('keyup', function (e) {
            if (! validacion8) {
                var name = e.srcElement.getAttribute('name');
                validacion8 = validarAlfaNumericoTextarea(name);
            }
        });
        if (options != null) {
            auctionOptionsFunction();
        }
        formUpdateSale.addEventListener('submit', function (e) {
            if ( ! validacion4 || ! validacion5 || ! validacion6 || ! validacion7 || ! validacion8) {
                alert("Debe corregir los datos ingresados");
                e.preventDefault();
            }

            var valor;
            if ( validacion4 && validacion5 && validacion6 && validacion7 && validacion8) {
                valor = confirm("¿Esta seguro que desea registrar la venta?");
                if (valor) {} else {
                    e.preventDefault();
                }
            }
        });
    }

    // Recarga los listeners y los objetos del DOM que fueron removidos para que vuelvan a funcionar
    function auctionOptionsFunction() {
        var inputPrice_kg = document.getElementById('price_kg');
        var inputAuction_commission = document.getElementById('auction_commission');
        var inputAuction_name = document.getElementById('auction_name');

        var selectComision = document.querySelector('#auction_commission');
        if (selectComision !== null) {
            for (let i = 1; i < 20; i += 0.5) {
                var option = document.createElement('option');
                option.value = i;
                option.innerHTML = i;
                selectComision.append(option);
            }
        }

        inputPrice_kg.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion5 = validarNumerico(name);
        });
        inputPrice_kg.addEventListener('keyup', function (e) {
            if (!validacion5) {
                var name = e.srcElement.getAttribute('name');
                validacion5 = validarNumerico(name);
            }
        });
        inputAuction_commission.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion6 = validarNumerico(name);
        });
        inputAuction_commission.addEventListener('keyup', function (e) {
            if (!validacion6) {
                var name = e.srcElement.getAttribute('name');
                validacion6 = validarNumerico(name);
            }
        });
        inputAuction_name.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion7 = validarAlfaNumerico(name);
        });
        inputAuction_name.addEventListener('keyup', function (e) {
            if (!validacion7) {
                var name = e.srcElement.getAttribute('name');
                validacion7 = validarAlfaNumerico(name);
            }
        });

    }

    function validarAlfaNumerico(name) {
        var valor = document.getElementById(name).value;

        borrarError(name);

        const patron3 = /^[a-zA-Z0-9,.\s\-\/À-ÿ\u00f1\u00d1]+$/u;
        if (! patron3.test(valor)) {
            mostrarErrorMejorado("input[name=" + name + "]", "El campo debe contener solo números y letras", name);
            return false;
        }
        return true;
    }
    function validarAlfaNumericoTextarea(name) {
        var valor = document.getElementById(name).value;

        borrarError(name);

        const patron3 = /^[a-zA-Z0-9,.\s\-\/À-ÿ\u00f1\u00d1]+$/u;
        if (! patron3.test(valor)) {
            mostrarErrorMejorado("textarea[name=" + name + "]", "El campo debe contener solo números y letras", name);
            return false;
        }
        return true;
    }

    function validarNumerico(name) {
        var valor = document.getElementById(name).value;

        borrarError(name);
        // Patron para los correos
        const patron = /^[0-9\.0-9]+$/u;
        if (! patron.test(valor)) {
            mostrarErrorMejorado("input[name=" + name + "]", "El campo debe contener solo números", name);
            return false;
        }

        return true;
    }

    function validarCorreo(name) {
        var valor = document.getElementById(name).value;

        borrarError(name);

        const patron3 = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (! patron3.test(valor)) {
            mostrarErrorMejorado("input[name=" + name + "]", "El campo debe contener un correo electrónico.", name);
            return false;
        }
        return true;
    }

    function validarPassLogin(name) {
        var valor = document.getElementById(name).value;

        borrarError(name);

        const patron3 = /^(([a-zA-Z-0-9]))+$/u;
        if (! patron3.test(valor)) {
            mostrarErrorMejorado("input[name=" + name + "]", "La constraseña debe ser alfanumérica.", name);
            return false;
        }
        
        return true;
    }


    var formRegisterAnimal = document.querySelector('#formRegisterAnimal');

    if (formRegisterAnimal !== null) {
        var inputNickname = document.getElementById('nickname');
        var inputCertification_name = document.getElementById('certification_name');
        var inputRegistration_number = document.getElementById('registration_number');
        var inputCode = document.getElementById('code');
        var btnRegister = document.getElementById('btnRegister');

        var validacion = true;
        var validacion1 = true;
        var validacion2 = true;
        var validacion3 = true;

        btnRegister.addEventListener('focus', function (e) {
            if (inputNickname.value == '' || null) {

            } else {
                validacion = validarAlfaNumerico(name);
            }
            if (inputCertification_name.value == '' || null) {

            } else {
                validacion1 = validarAlfaNumerico(name);
            }
            if (inputRegistration_number.value == '' || null) {

            } else {
                validacion2 = validarAlfaNumerico(name);
            } 
            validacion3 = validarAlfaNumerico('code');
        });

        inputNickname.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (inputNickname.value == '' || null) {} else {
                validacion = validarAlfaNumerico(name);
            }
        });
        inputNickname.addEventListener('keyup', function (e) {
            if (! validacion) {
                var name = e.srcElement.getAttribute('name');
                if (inputNickname.value == '' || null) {} else {
                    validacion = validarAlfaNumerico(name);
                }
            }
        });
        inputCertification_name.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (inputCertification_name.value == '' || null) {} else {
                validacion1 = validarAlfaNumerico(name);
            }
        });
        inputCertification_name.addEventListener('keyup', function (e) {
            if (! validacion1) {
                var name = e.srcElement.getAttribute('name');
                if (inputCertification_name.value == '' || null) {} else {
                    validacion1 = validarAlfaNumerico(name);
                }
            }
        });
        inputRegistration_number.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (inputRegistration_number.value == '' || null) {} else {
                validacion2 = validarAlfaNumerico(name);
            }
        });
        inputRegistration_number.addEventListener('keyup', function (e) {
            if (! validacion2) {
                var name = e.srcElement.getAttribute('name');
                if (inputRegistration_number.value == '' || null) {} else {
                    validacion2 = validarAlfaNumerico(name);
                }
            }
        });
        inputCode.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion3 = validarAlfaNumerico(name);
        });
        inputCode.addEventListener('keyup', function (e) {
            if (! validacion3) {
                var name = e.srcElement.getAttribute('name');
                validacion3 = validarAlfaNumerico(name);
            }
        });
        formRegisterAnimal.addEventListener('submit', function (e) {
            if (! validacion || ! validacion1 || ! validacion2 || ! validacion3) {
                alert("Debe corregir los datos ingresados");
                e.preventDefault();
            }

            var valor;
            if (validacion && validacion1 && validacion2 && validacion3) {
                valor = confirm("¿Esta seguro que registrar el animal?");
                if (valor) {} else {
                    e.preventDefault();
                }
            }
        });

        formRegisterAnimal.addEventListener("keydown", function(event) {

            if (event.key === "Enter") {
                event.preventDefault();
                validacion = validarAlfaNumerico('nickname');
                validacion1 = validarAlfaNumerico('certification_name');
                validacion2 = validarAlfaNumerico('registration_number');
                validacion3 = validarAlfaNumerico('code');

                if (! validacion || ! validacion1 || ! validacion2 || ! validacion3) {
                    alert("Debe corregir los datos ingresados");
                    event.preventDefault();
                }
            }
        });
    }

    var formDetailUpdate = document.querySelector('#form-detail-update');

    if (formDetailUpdate !== null) {
        var inputNickname = document.getElementById('nickname');
        var inputCertification_name = document.getElementById('certification_name');
        var inputRegistration_number = document.getElementById('registration_number');
        var inputCode = document.getElementById('code');
        var birth_weight = document.getElementById('birth_weight');
        var btnUpdateAnimal = document.getElementById('btnUpdateAnimal');

        var validacion = true;
        var validacion1 = true;
        var validacion2 = true;
        var validacion3 = true;
        var validacion4 = true;

        btnUpdateAnimal.addEventListener('focus', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (inputNickname.value == '' || null) {

            } else {
                validacion = validarAlfaNumerico(name);
            }
            if (inputCertification_name.value == '' || null) {

            } else {
                validacion1 = validarAlfaNumerico(name);
            }
            if (inputRegistration_number.value == '' || null) {

            } else {
                validacion2 = validarAlfaNumerico(name);
            } 
            validacion3 = validarAlfaNumerico('code');

            if (birth_weight.value == '' || null) {

            } else {
                validacion4 = validarNumerico(name);
            } 
        });

        inputNickname.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (inputNickname.value == '' || null) {} else {
                validacion = validarAlfaNumerico(name);
            }
        });
        inputNickname.addEventListener('keyup', function (e) {
            if (! validacion) {
                var name = e.srcElement.getAttribute('name');
                if (inputNickname.value == '' || null) {} else {
                    validacion = validarAlfaNumerico(name);
                }
            }
        });
        inputCertification_name.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (inputCertification_name.value == '' || null) {} else {
                validacion1 = validarAlfaNumerico(name);
            }
        });
        inputCertification_name.addEventListener('keyup', function (e) {
            if (! validacion1) {
                var name = e.srcElement.getAttribute('name');
                if (inputCertification_name.value == '' || null) {} else {
                    validacion1 = validarAlfaNumerico(name);
                }
            }
        });
        inputRegistration_number.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (inputRegistration_number.value == '' || null) {} else {
                validacion2 = validarAlfaNumerico(name);
            }
        });
        inputRegistration_number.addEventListener('keyup', function (e) {
            if (! validacion2) {
                var name = e.srcElement.getAttribute('name');
                if (inputRegistration_number.value == '' || null) {} else {
                    validacion2 = validarAlfaNumerico(name);
                }
            }
        });
        inputCode.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion3 = validarAlfaNumerico(name);
        });
        inputCode.addEventListener('keyup', function (e) {
            if (! validacion3) {
                var name = e.srcElement.getAttribute('name');
                validacion3 = validarAlfaNumerico(name);
            }
        });
        birth_weight.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            birth_weight = document.getElementById('birth_weight');
            if (birth_weight.value == '' || null) {} else {
                validacion4 = validarNumerico(name);
            }
        });
        birth_weight.addEventListener('keyup', function (e) {
            birth_weight = document.getElementById('birth_weight');
            if (! validacion4) {
                var name = e.srcElement.getAttribute('name');
                validacion4 = validarNumerico(name);
                if (birth_weight.value == '' || null) {} else {
                    validacion4 = validarNumerico(name);
                }
            }
        });



        formDetailUpdate.addEventListener('submit', function (e) {
            if (! validacion || ! validacion1 || ! validacion2 || ! validacion3 || ! validacion4) {
                alert("Debe corregir los datos ingresados");
                e.preventDefault();
            }

            var valor;
            if (validacion && validacion1 && validacion2 && validacion3 && validacion4) {
                valor = confirm("¿Esta seguro que registrar los cambios?");
                if (valor) {} else {
                    e.preventDefault();
                }
            }
        });

        formDetailUpdate.addEventListener("keydown", function(event) {

            if (event.key === "Enter") {
                event.preventDefault();
                validacion = validarAlfaNumerico('nickname');
                validacion1 = validarAlfaNumerico('certification_name');
                validacion2 = validarAlfaNumerico('registration_number');
                validacion3 = validarAlfaNumerico('code');
                validacion4 = validarNumerico('birth_weight');

                if (! validacion || ! validacion1 || ! validacion2 || ! validacion3 || ! validacion4) {
                    alert("Debe corregir los datos ingresados");
                    e.preventDefault();
                }
            }
        });
    }


    var formSearchAnimal = document.querySelector('#formSearchAnimal');

    if (formSearchAnimal !== null) {
        var inputFind_string = document.getElementById('find_string');
        var validacion = true;
        var btnSearch = document.getElementById('btnSearch');

        btnSearch.addEventListener('focus', function (e) {
            validacion = validarAlfaNumerico('find_string');

        });

        inputFind_string.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion = validarAlfaNumerico(name);
        });
        inputFind_string.addEventListener('keyup', function (e) {
            if (! validacion) {
                var name = e.srcElement.getAttribute('name');
                validacion = validarAlfaNumerico(name);
            }
        });

        formSearchAnimal.addEventListener('submit', function (e) {
            if (! validacion) {
                alert("Debe corregir los datos ingresados");
                e.preventDefault();
            }
        });
    }


    var formSaleAnimal = document.querySelector('#formSaleAnimal');

    if (formSaleAnimal !== null) {

        var inputPrice_total = document.getElementById('price_total');
        var inputPrice_kg = document.getElementById('price_kg');
        var inputAuction_commission = document.getElementById('auction_commission');
        var inputAuction_name = document.getElementById('auction_name');
        var inputDescription = document.getElementById('description');
        var btnRegister = document.getElementById('btnRegister');
        var inputSale_type = document.getElementById('sale_type');

        var validacion4 = true;
        var validacion5 = true;
        var validacion6 = true;
        var validacion7 = true;
        var validacion8 = true;

        var auctionOptions = document.getElementById('action_options');
        var options = document.getElementById('options');

        if (inputSale_type.value == "Subasta" && options == null) {
            auctionOptions.innerHTML = plantillaAuctionOptions;
            auctionOptionsFunction();
        }

        inputSale_type.addEventListener('change', function (e) {

            if (inputSale_type.value == "Subasta") {
                auctionOptions.innerHTML = plantillaAuctionOptions;
                auctionOptionsFunction();
            } else {
                var options = document.getElementById('options');
                if (options != null) {
                    options.remove();
                    validacion5 = true;
                    validacion6 = true;
                    validacion7 = true;
                }
            }
        })

        btnRegister.addEventListener('focus', function (e) {
            validacion4 = validarNumerico('price_total');

            var options = document.getElementById('options');
            if (options != null) {
                validacion5 = validarNumerico('price_kg');
                validacion6 = validarNumerico('auction_commission');
                validacion7 = validarAlfaNumerico('auction_name');
            }

            validacion8 = validarAlfaNumericoTextarea('description');
        });


        inputPrice_total.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion4 = validarNumerico(name);
        });
        inputPrice_total.addEventListener('keyup', function (e) {
            if (! validacion4) {
                var name = e.srcElement.getAttribute('name');
                validacion4 = validarNumerico(name);
            }
        });

        if (options != null) {
            auctionOptionsFunction();
        }

        inputDescription.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion8 = validarAlfaNumericoTextarea(name);
        });
        inputDescription.addEventListener('keyup', function (e) {
            if (! validacion8) {
                var name = e.srcElement.getAttribute('name');
                validacion8 = validarAlfaNumericoTextarea(name);
            }
        });

        formSaleAnimal.addEventListener('submit', function (e) {
            if (! validacion4 || ! validacion5 || ! validacion6 || ! validacion7 || ! validacion8) {
                alert("Debe corregir los datos ingresados");
                e.preventDefault();
            }

            var valor;
            if (validacion4 && validacion5 && validacion6 && validacion7 && validacion8) {
                valor = confirm("¿Esta seguro que desea registrar la venta?");
                if (valor) {} else {
                    e.preventDefault();
                }
            }
        });
    }

    var formRegisterInjectable = document.querySelector('#formRegisterInjectable');

    if (formRegisterInjectable !== null) {

        var inputInjectable_name = document.getElementById('injectable_name');
        var inputInjectable_brand = document.getElementById('injectable_brand');
        var inputDescription = document.getElementById('description');
        var btnRegister = document.getElementById('btnRegister');

        var validacion4 = true;
        var validacion5 = true;
        var validacion8 = true;

        btnRegister.addEventListener('focus', function (e) {
            validacion4 = validarAlfaNumerico('injectable_name');
            validacion5 = validarAlfaNumerico('injectable_brand');
            validacion8 = validarAlfaNumericoTextarea('description');
        });


        inputInjectable_name.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion4 = validarAlfaNumerico(name);
        });
        inputInjectable_name.addEventListener('keyup', function (e) {
            if (! validacion4) {
                var name = e.srcElement.getAttribute('name');
                validacion4 = validarAlfaNumerico(name);
            }
        });
        inputInjectable_brand.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion5 = validarAlfaNumerico(name);
        });
        inputInjectable_brand.addEventListener('keyup', function (e) {
            if (! validacion5) {
                var name = e.srcElement.getAttribute('name');
                validacion5 = validarAlfaNumerico(name);
            }
        });

        inputDescription.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion8 = validarAlfaNumericoTextarea(name);
        });
        inputDescription.addEventListener('keyup', function (e) {
            if (! validacion8) {
                var name = e.srcElement.getAttribute('name');
                validacion8 = validarAlfaNumericoTextarea(name);
            }
        });

        formRegisterInjectable.addEventListener('submit', function (e) {
            if (! validacion4 || ! validacion5 || ! validacion8) {
                alert("Debe corregir los datos ingresados.");
                e.preventDefault();
            }

            var valor;
            if (validacion4 && validacion5 && validacion8) {
                valor = confirm("¿Esta seguro que desea registrar la aplicación del inyectable?");
                if (valor) {} else {
                    e.preventDefault();
                }
            }
        });
    }

    var formRegisterIncident = document.querySelector('#formRegisterIncident');

    if (formRegisterIncident !== null) {


        var inputDescription = document.getElementById('description');
        var btnRegister = document.getElementById('btnRegister');

        var validacion8 = true;

        btnRegister.addEventListener('focus', function (e) {
            validacion8 = validarAlfaNumericoTextarea('description');
        });

        inputDescription.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion8 = validarAlfaNumericoTextarea(name);
        });
        inputDescription.addEventListener('keyup', function (e) {
            if (! validacion8) {
                var name = e.srcElement.getAttribute('name');
                validacion8 = validarAlfaNumericoTextarea(name);
            }
        });

        
        formRegisterIncident.addEventListener('submit', function (e) {
            if (! validacion8) {
                alert("Debe corregir los datos ingresados.");
                e.preventDefault();
            }

            var valor;
            if (validacion8) {
                valor = confirm("¿Esta seguro que desea registrar el incidente?");
                if (valor) {} else {
                    e.preventDefault();
                }
            }
        });
    }

    var formLogin = document.querySelector('#formLog');

    if (formLogin !== null) {

        var btnLogin = document.getElementById('btnLogin');
        var inputPassword = document.getElementById('password');
        var inputEmail = document.getElementById('email');

        var validacion1 = true;
        var validacion2 = true;

        btnLogin.addEventListener('focus', function (e) {
            validacion1 = validarCorreo('email');
            validacion2 = validarPassLogin('password');
        });

        inputEmail.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion1 = validarCorreo(name);
        });
        inputEmail.addEventListener('keyup', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (! validacion1) {
                validacion1 = validarCorreo(name);
            }
        });

        inputPassword.addEventListener('blur', function (e) {
            var name = e.srcElement.getAttribute('name');
            validacion2 = validarPassLogin(name);
        });

        inputPassword.addEventListener('keyup', function (e) {
            var name = e.srcElement.getAttribute('name');
            if (! validacion2) {
                validacion2 = validarPassLogin(name);
            }
        });

        formLogin.addEventListener('submit', function (e) {
            if (! validacion1 || ! validacion2) {
                alert("Debe corregir los datos ingresados.");
                e.preventDefault();
            }

        });
    }

    var uploadImage = document.getElementById('uploadImage');
    if (uploadImage != null) {

        var cargando = document.getElementById("cargando");
        cargando.style.display = 'none';

        uploadImage.onsubmit = async (e) => {

            e.preventDefault();

            var result;
            cargando.style.display = 'block'; 
            let response = await fetch(url_api+'/api/animals/upload', {
                method: 'POST',
                headers: {
                    'Authorization': uploadImage[5].value
                },
                body: new FormData(uploadImage)
            }).then((response) => response.json())
            .then((datos) => {
                result = datos;
                cargando.style.display = 'none';     
            })
            .catch(error => console.error('Error:', error))
            .finally(()=>{
              cargando.style.display = 'none';     
            });

            alert(result.message);
            window.location.href = window.location.href;
        };
    }

    var btnEnableForm = document.getElementById('btnEnableForm');
    if(btnEnableForm != null){
        
        var  btnEnableForm = document.querySelector('#btnEnableForm');
        var  btnUpdateAnimal = document.querySelector('#btnUpdateAnimal');
        var  btnDeleteAnimal = document.querySelector('#btnDeleteAnimal');
        var  btnImageDelete = this.document.querySelector('#btnImageDelete');
        
        btnUpdateAnimal.style.display = "none";
        btnDeleteAnimal.style.display = "none";
       
        btnEnableForm.addEventListener('click', function(e){
            e.preventDefault();
            var inputNickname = document.getElementById('nickname');
            var inputCertification_name = document.getElementById('certification_name');
            var inputRegistration_number = document.getElementById('registration_number');
            var inputCode = document.getElementById('code');
            var selectPeso = document.querySelector('#birth_weight');
            var birth_date = document.querySelector('#birth_date');
            var sex = document.querySelector('#sex');
            var father_id = document.querySelector('#father_id');
            var mother_id = document.querySelector('#mother_id');
            var race = document.querySelector('#race');
            var animal_state = document.querySelector('#animal_state'); 

            inputNickname.disabled = false;
            inputCertification_name.disabled = false;
            selectPeso.disabled = false;      
            birth_date.disabled = false;
            sex.disabled = false;
            father_id.disabled = false;
            mother_id.disabled = false;
            race.disabled = false;
            inputRegistration_number.disabled = false;
            inputCode.disabled = false;

            btnEnableForm.style.display = "none";
            btnUpdateAnimal.style.display = "inline";
            btnDeleteAnimal.style.display = "block";
        });

        
        if(btnImageDelete != null){
            btnImageDelete.addEventListener('click', function(e){
                valor = confirm("¿Esta seguro desea borrar la imagen?");
                if (valor) {

                } else {
                    e.preventDefault();
                }
            });
        }

        var btnDeleteAnimal = document.getElementById('btnDeleteAnimal');
        if(btnDeleteAnimal != null){
            btnDeleteAnimal.addEventListener('click', function(e){
                valor = confirm("¿Esta seguro desea borrar el registro?");
                    if (valor) {

                    } else {
                        e.preventDefault();
                    }
            });
        }

    }

    var btnDeleteRegister = document.getElementById('btnDeleteRegister');
    if(btnDeleteRegister != null){
        btnDeleteRegister.onclick = (e) => {
            valor = confirm("¿Esta seguro desea borrar el registro?");
                if (valor) {

                } else {
                    e.preventDefault();
                }
        }


        /*btnDeleteRegister.addEventListener('click', function(e){
            valor = confirm("¿Esta seguro desea borrar el registrobbb?");
                if (valor) {

                } else {
                    e.preventDefault();
                }
        });*/
    }

    function deleteRegister(node){
        return confirm("¿Esta seguro desea borrar el registro? xxxx");
    }

    //Actualización de compras
    var btnEnablePurchaseUpdate = document.getElementById('btnEnablePurchaseUpdate');
    if(btnEnablePurchaseUpdate != null){
        
        var  accordionUpdatePurchase = document.querySelector('#accordionUpdatePurchase');
        var  btnDeletePurchase = document.querySelector('#btnDeletePurchase');
        
        accordionUpdatePurchase.style.display = "none";
       
        btnEnablePurchaseUpdate.addEventListener('click', function(e){
            e.preventDefault();


            btnEnablePurchaseUpdate.style.display = "none";
            btnDeletePurchase.style.display = "block";
            accordionUpdatePurchase.style.display = "block";
        });

        
        var btnDeletePurchase = document.getElementById('btnDeletePurchase');
        if(btnDeletePurchase != null){
            btnDeletePurchase.addEventListener('click', function(e){
                valor = confirm("¿Esta seguro desea borrar el registro?");
                    if (valor) {

                    } else {
                        e.preventDefault();
                    }
            });
        }

    }



   
    
});


