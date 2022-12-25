## Pacote Oportunidades API para Laravel

<a href="https://packagist.org/packages/alixame/opportunities">Link Pacote</a>

Basta utilizar o comando para realizar a instalação do pacote no projeto laravel
    
    composer require alixame/opportunities

Em seguida deve adicionar a linha no `psr-4` no arquivo `composer.json`

    "autoload": {
        "psr-4": {
            "Alixame\\Opportunities\\": "vendor/alixame/opportunities/",
        }
    },

Em seguida deve adicionar no arquivo `config/app.php` a seguinte linha nos `provides`

    Alixame\Opportunities\OpportunitiesServiceProvider::class


Por fim rode no seu terminal o comando para atualizar o autoload das classes

    composer update
