<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/cart' => [
            [['_route' => 'app_cart', '_controller' => 'App\\Controller\\CartController::index'], null, null, null, false, false, null],
            [['_route' => 'get_cart', '_controller' => 'App\\Controller\\CartController::getCart'], null, null, null, false, false, null],
        ],
        '/api/cart/validate' => [[['_route' => 'validate_cart', '_controller' => 'App\\Controller\\CartController::validateCart'], null, ['POST' => 0], null, false, false, null]],
        '/api/orders' => [[['_route' => 'get_orders', '_controller' => 'App\\Controller\\OrderController::getOrders'], null, ['GET' => 0], null, false, false, null]],
        '/api/products' => [
            [['_route' => 'get_products', '_controller' => 'App\\Controller\\ProductController::getProducts'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'add_product', '_controller' => 'App\\Controller\\ProductController::addProduct'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/register' => [[['_route' => 'user_register', '_controller' => 'App\\Controller\\UserController::register'], null, ['POST' => 0], null, false, false, null]],
        '/api/login' => [[['_route' => 'user_login', '_controller' => 'App\\Controller\\UserController::login'], null, ['POST' => 0], null, false, false, null]],
        '/api/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\UserController::logout'], null, null, null, false, false, null]],
        '/api/user' => [
            [['_route' => 'user_get_current', '_controller' => 'App\\Controller\\UserController::getCurrentUser'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'user_update', '_controller' => 'App\\Controller\\UserController::updateUser'], null, ['PUT' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api/(?'
                    .'|cart/(?'
                        .'|add/([^/]++)(*:35)'
                        .'|remove/([^/]++)(*:57)'
                    .')'
                    .'|orders/([^/]++)(*:80)'
                    .'|products/([^/]++)(?'
                        .'|(*:107)'
                    .')'
                .')'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:145)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => 'add_product_to_cart', '_controller' => 'App\\Controller\\CartController::addProductToCart'], ['productId'], ['POST' => 0], null, false, true, null]],
        57 => [[['_route' => 'remove_product_from_cart', '_controller' => 'App\\Controller\\CartController::removeProductFromCart'], ['cartItemId'], ['DELETE' => 0], null, false, true, null]],
        80 => [[['_route' => 'get_order', '_controller' => 'App\\Controller\\OrderController::getOrder'], ['id'], ['GET' => 0], null, false, true, null]],
        107 => [
            [['_route' => 'get_product', '_controller' => 'App\\Controller\\ProductController::getProduct'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'update_product', '_controller' => 'App\\Controller\\ProductController::updateProduct'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_product', '_controller' => 'App\\Controller\\ProductController::deleteProduct'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        145 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
