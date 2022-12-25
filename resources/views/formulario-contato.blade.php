<!-- MyVendor\formulario-contato\src\resources\views\contato.blade.php -->
<!DOCTYPE html>
    <html lang="pt-BR">
    <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
          <title>Entre em Contato</title>
    </head>
        <body>
          <div style="width: 500px; margin: 0 auto; margin-top: 90px;">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if(Session::has('mensagem'))
                {{Session::get("mensagem")}}
            @endif
          <h3>Entre em Contato</h3>
          <form action="{{route('contato')}}" method="POST">
              @csrf
              <div class="form-group">
                <label for="inputExemplo1">Seu Nome</label>
                <input type="text" class="form-control" name="nome" id="inputExemplo1" placeholder="Seu Nome">
              </div>
              <div class="form-group">
                <label for="inputExemplo2">Email</label>
                <input type="email" class="form-control" name="email" id="inputExemplo2" placeholder="nome@email.com.br">
              </div>
              <div class="form-group">
                <label for="textAreaExemplo1">Digite sua Mensagem</label>
                <textarea class="form-control"name="mensagem" id="textAreaExemplo1" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Enviar</button>
         </form>
        </div>
    </body>
    </html>