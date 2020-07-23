<?php

declare(strict_types=1);

$container["restaurantes_repository"] = static function ($container): App\Repository\RestaurantesRepository {
    return new App\Repository\RestaurantesRepository($container["db"]);
};
