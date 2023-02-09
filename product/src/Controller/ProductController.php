<?php

namespace App\Controller;

use Mpdf\Mpdf;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    /**
     * @Route("/productList", name="list_product")
     */
    public function listp(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('product/listp.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/producPrint", name="print_product")
     */
    public function listprint(ProductRepository $productRepository): Response
    {


        $products = $productRepository->findAll();

        $html = $this->render('product/print.html.twig', [
            'products' => $products,
        ]);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        return new JsonResponse('GOOD');
    }

    /**
     * @Route("/getData", name="get_data")
     */
    public function get_data(ProductRepository $productRepository): Response
    {

        // dd($_POST);
        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        ## Search 
        $searchQuery = " ";
        if ($searchValue != '') {
            $searchQuery = " and ( designation like '%" . $searchValue . "%' )";
        }
        ## Total number of records without filtering
        $sel = " select count(*) as allcount from product ";
        $stmt = $this->getDoctrine()->getConnection()->prepare($sel);
        $test = $stmt->execute();
        $result = $test->fetch();
        $totalRecords = $result['allcount'];

        ## Total number of records with filtering
        $sel = "  select count(*) as allcount from product WHERE 1 
                   " . $searchQuery;
        $stmt = $this->getDoctrine()->getConnection()->prepare($sel);
        $test = $stmt->execute();
        $result = $test->fetch();
        $totalRecordwithFilter = $result['allcount'];



        ## Fetch records
        $sel = " select * from product 
                 WHERE 1 
          " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
        $stmt = $this->getDoctrine()->getConnection()->prepare($sel);
        $test = $stmt->execute();
        $empRecords = $test->fetchAll();

        $data = array();

        foreach ($empRecords as $row) {


            $data[] = array(
                "id"      => $row['id'],
                "designation"     => $row['designation'],
                "quantite"  => $row['qte'],



            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return new JsonResponse($response);
    }
}
