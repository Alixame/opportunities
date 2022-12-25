## Estudo de Pacotes para Laravel

<a href="https://packagist.org/packages/alixame/formulario-contato">Link Pacote</a>

Basta utilizar o comando para realizar a instalação do pacote no projeto laravel
    
    composer require alixame/formulario-contato

Em seguida deve adicionar a linha no `psr-4` no arquivo `composer.json`

    "autoload": {
        "psr-4": {
            "Alixame\\FormularioContato\\": "vendor/alixame/formulario-contato/",
        }
    },

Em seguida deve adicionar no arquivo `config/app.php` a seguinte linha nos `provides`

    Alixame\FormularioContato\FormularioContatoServiceProvider::class


Por fim rode no seu terminal o comando para atualizar o autoload das classes

    composer update
