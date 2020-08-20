<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Repository\StockRepository;
use App\Service\filter\FilterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{

    /**
     * @Route("/", name="product_index", methods={"GET"})
     * @param ProductRepository $productRepository
     * @param StockRepository $stockRepository
     * @return Response
     */
    public function index(Request $request, ProductRepository $productRepository, PaginatorInterface $paginator, StockRepository $stockRepository): Response
    {
        $unitPrice = $stockRepository->findall();
        foreach ($unitPrice as $key => $item) {
            $unitPrice[$key] = [$item->getUnitPrice()];
            asort($unitPrice);
        }
        $firstrow = array_shift($unitPrice);
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri

        $query  = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $product  = $paginator->paginate(
            $query, // Requête contenant les données à paginer (ici nos produits)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );
        // dd($pagination);
        return $this->render('product/index.html.twig', [
            // 'products' => $productRepository->findAll(),
            'product' => $product,
            'minprice' => $firstrow[0]
        ]);
    }



    /**
     * 
     */
    public function paginate(Request $request, PaginatorInterface $paginator) // Nous ajoutons les paramètres requis
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $query  = $this->getDoctrine()->getRepository(Product::class)->findAll();

        $pagination  = $paginator->paginate(
            $query, // Requête contenant les données à paginer (ici nos produits)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );
        dd($pagination);
        return $this->render('product/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     * @param int $id
     * @param Product $product
     * @param StockRepository $stockRepository
     * @return Response
     */
    public function show(int $id, Product $product, StockRepository $stockRepository): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'defaultprice' => $stockRepository->find(1)->getUnitPrice()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"DELETE"})
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }
}
