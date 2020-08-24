<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\ProductRepository;
use App\Repository\StockRepository;
use App\Repository\FormatRepository;
use App\Repository\MaterialRepository;
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
        

        $query = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $product = $paginator->paginate(
            $query, // Requête contenant les données à paginer (ici nos produits)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );


        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $products = $productRepository->findSearch($data);

        return $this->render('product/index.html.twig', [
       
            'product' => $product,
            'minprice' => $firstrow[0],
            'products' => $products,
            'form' => $form->createView()
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


// Association prix
    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     * @param int $id
     * @param Product $product
     * @param StockRepository $stockRepository
     * @return Response
     */
    public function show(int $id, Product $product, StockRepository $stockRepository, FormatRepository $formatRepository, MaterialRepository $materialRepository): Response
    {
// $form = $this->createForm(ProductType::class, $product);
// $form = $this->handleRequest($request);
// if ($form->isSubmitted() &&$form->isValid()) {
//     $this->getDoctrine()->getManager()->flush();

//     return $this->redirectToRoute('product',['id'=>'$product'->get);

// }
// return $this->render('product/show.html.twig', [
//     'product' => $product,
//     'form' => $form->createView(),
//     ]);
// }


            // $stockRepository = $stockRepository->findall();

            // $unitPrice = $stockRepository->find(1)->getUnitPrice();
            // foreach ($stockRepository as $item) {
            //  dd($item);
            // $materialid= $item->getmaterial()->getid();
            // $formatid= $item->getformat()->getid();}

            // $radio1_value
            // $radio2_value

            //             if($materialid = $radio1_value && $formatId = $radio2_value ) {

                //     if ($formulaire->isSubmitted()) {
                //     return $this->redirectToRoute('product_index');
                // }

            //             }
            //             // $materialId[$key] = [$item1->getMaterialId()];
            //             // $formatId[$key] = [$item2->getFormatId()];
            
$unitPrice = $stockRepository->findall();
$formats = $formatRepository->findall();
$materials = $materialRepository->findall();
$stocks = $stockRepository->findall();

foreach ($unitPrice as $key => $item) {
    $unitPrice[$key] = [$item->getUnitPrice()];
    asort($unitPrice);
}
$firstrow = array_shift($unitPrice);


        return $this->render('product/show.html.twig', [
            'product' => $product,
            'defaultprice' =>$firstrow[0],
            'formats' => $formats,
            'materials' => $materials,
            'stocks' => $stocks,
            // 'idstock' => $combo->getUnitPrice()

                // 'idstock'=> $idstock,
                // 'qte'=> $qte

        ]);
    }

/**
 * @Route("/{id}/{format}/{matos}", name="ajax", methods={"GET"})
     * @param int $id
     * @param int $format
     * @param int $matos
 */
public function ajax($format, $matos, StockRepository $stockRepository){
    if (!empty($format)&&!empty($matos))
    {
        $stocks = $stockRepository->findAll();
        foreach($stocks as $id => $item) {
            if($item->getMaterial()->getId() == $matos && $item->getFormat()->getId() == $format) {

                $itemPrice = $item->getUnitPrice();
// dd($itemPrice);
                return $this->render('product/show.html.twig', [
                    'price' => $itemPrice,
                ]);
            }
        }
    }
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
