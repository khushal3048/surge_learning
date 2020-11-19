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
                        <div class="card-header text-center">Full Stack Developer Challenge</div>
    
                        <div class="card-body">
                            
                            <form id="frm_input" method="POST">

                                <div class="form-group">
                                    <label for="txt_num">Enter Number : </label>
                                    <input class="form-control" type="text" name="txt_num" id="txt_num" placeholder="Enter prime number">
                                </div>

                                <input class="btn btn-success" type="submit" value="Click me" name="btn_click">

                            </form>

                            <div id="result"></div>

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
                    let result = $('#result');
                    let string = "";

                    $.ajax({
                        url: "/primeNumbers",
                        type: "POST",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            "num" : txt_num
                        },
                        success: function(response){
                            console.log(response);

                            if(response.status == 'error'){

                                result.addClass("mt-3");
                                string = "<h3 class='alert alert-danger'>"+ response.message +"</h3>";
                                result.html(string);

                            }else{
                                result.addClass("mt-4");
                                string = "<div class='alert alert-info'><h4 class='alert alert-heading text-center'>Result : </h4>";
                                string += "<h6>The set of prime numbers less than " + txt_num + " is : [ ";
                                for (let index = 0; index < response.prime.length; index++) {
                                    
                                    string += response.prime[index];
                                    if(index !== response.prime.length -1)
                                        string += ", ";
                                    
                                }
                                string += " ] </h6>";
                                if(response.median.length > 1){
                                    string += "<h6>The Meadians are : [ ";
                                }else{
                                    string += "<h6>The Meadian is : [ ";
                                }
                                for (let index = 0; index < response.median.length; index++) {
                                    
                                    string += response.median[index];
                                    if(index !== response.median.length -1)
                                        string += ", ";
                                    
                                }
                                string += " ]</h6></div>";
                                result.html(string);
                            }
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
