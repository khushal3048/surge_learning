<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Example Component</div>
    
                        <div class="card-body">
                            
                            <form id="frm_input" method="POST">

                                <input type="text" name="txt_num" id="txt_num">

                                <input type="submit" value="Click" name="btn_click">

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>

        <script>

            $(document).ready(function(){

                let frm_input = $('#frm_input');

                frm_input.on('submit', function (event){

                    event.preventDefault();
                    let txt_num = $('#txt_num').val();

                    $.ajax({
                        url: "/primeNumbers",
                        type: "POST",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            "num" : txt_num
                        },
                        success: function(response){
                            console.log(response);
                        },
                        error: function(response){
                            console.log(response);
                        }
                    });

                });

            });

        </script>
    </body>
</html>
