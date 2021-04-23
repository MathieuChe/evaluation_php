<?php

namespace eCommerce\Controller;

use eCommerce\Repository\ProductManager;
use Simplex\Templating;
use Symfony\Component\HttpFoundation\Response;

class AppController
{
    public function index()
    {
        $security = false;
        if (isset($_SESSION['security'])) {
            $security = $_SESSION['security'];
        }

        $products = (new ProductManager())->getProducts();

        $templating = new Templating();
        return new Response(
            $templating->render('eCommerce::home.php', ['security' => $security, 'products' => $products])
        );
    }
}
