<?php

declare(strict_types=1);

$container["restaurantes_service"] = static function ($container): App\Service\RestaurantesService {
    return new App\Service\RestaurantesService($container["restaurantes_repository"]);
};
