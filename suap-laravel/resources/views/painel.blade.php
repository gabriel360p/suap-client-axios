<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<style>
    #body-app {
        display: none;
    }
</style>

<body onload="meusDados()" id="body-app">
    
    {{-- <button id="deslogar" class="btn btn-outline-success">Deslogar</button> --}}

    <a href="/logout" class="btn btn-outline-success">Deslogar</a>


    <pre>
        @php
            $session = session('UserSession');
            var_dump($session);
        @endphp
    </pre>

    <script src="js.cookie.js"></script>
    <script src="settings.js"></script>
    <script src="client.js"></script>
    <script>
        //inciando objeto do suap
        var suap = new SuapClient(SUAP_URL, CLIENT_ID, REDIRECT_URI, SCOPE);
        suap.init();

        //captura do evento ao clicar em deslogar
        // document.querySelector('button#deslogar').addEventListener('click', deslogar)
        var app = document.getElementById('body-app')

        function deslogar() { //logout do usuário
            suap.logout();
        }

        function meusDados() { //pegando os dados do usuário, daqui posso até mandar para um banco de dados
            if (suap.isAuthenticated()) {
                app.style.display = "block"

                var uri = window.location.hash  

                //definindo os scopos
                var scope = "identificacao email documentos_pessoais"
                var callback = function(response) {

                    let dados = response.data

                    Promise.all([

                        axios.post('http://localhost:8000/dados', dados)
                        .then(resp => {
                            console.log(resp)
                        })
                        .catch(err => {
                            console.log(err)
                        }),

                        axios.post('http://localhost:8000/suapToken', uri)
                        .then(resp => {
                            console.log(resp)
                        })
                        .catch(err => {
                            console.log(err)
                        })

                    ])
                };

                suap.getResource(scope, callback)
            }else{
                // window.location ='http://localhost:8000'
            }
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
