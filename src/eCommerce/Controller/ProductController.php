<?php

namespace eCommerce\Controller;

use eCommerce\Repository\ProductManager;
use Simplex\Service\Form;
use Simplex\Templating;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{

    public function createProduct(Request $request): Response
    {
        $security = false;
        if (isset($_SESSION['security'])) {
            $security = $_SESSION['security'];
        }

        if ($request->getMethod() === Request::METHOD_POST) {
            $product = Form::handleSubmit($request);

            $product->setUser_id($_SESSION['security']['user']->getId());

            (new ProductManager())->addProduct($product);
            header('Location: /');
            exit;
        }

        $templating = new Templating();
        return new Response(
            $templating->render('eCommerce::myProducts.php', ['security' => $security])
        );
    }

    public function index(Request $request): Response
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

    public function getUserAllProducts(Request $request): Response
    {
        $security = false;
        if (isset($_SESSION['security'])) {
            $security = $_SESSION['security'];
        }

        $products = (new ProductManager())->getUserProducts($_SESSION['security']['user']->getId());

        $templating = new Templating();
        return new Response(
            $templating->render('eCommerce::myProducts.php', ['security' => $security, 'products' => $products])
        );
    }

    public function updateUserProduct(Request $request): Void
    {

        if ($request->getMethod() === Request::METHOD_POST) {

            $product = Form::handleSubmit($request);

            $product->setId($request->query->get('id'));

            (new ProductManager())->updateProduct($product);

            header('Location: /myProducts/list');

            exit;
        }
    }

    public function deleteUserProduct(Request $request): Void
    {
        if ($request->getMethod() === Request::METHOD_POST) {

            (new ProductManager())->deleteProduct($request->query->get('id'));

            header('Location: /myProducts/list');

            exit;
        }
    }
}
