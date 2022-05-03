<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use App\Service\Command\Customers\PostCommand;
use App\Service\Command\Customers\PutCommand;
use App\Service\Command\Customers\DeleteCommand;
use App\Service\Query\CustomersQuery;

class CustomersController extends AbstractApiController
{
    /**
     * 
     * {@inheritDoc}
     * @see \App\Controller\AbstractApiController::post()
     * @Route("/api/customers", name="newCustomers", methods={"POST"})
     * @SWG\Tag(name="customers")
     * @SWG\Post(
     *   path="/api/customers",
     *   summary="Post to URL",
     *   @SWG\Parameter(
     *      name="body",
     *      in="body",
     *      description="JSON Payload",
     *      required=true,
     *      format="application/json",
     *      @SWG\Schema(
     *          type="object",
     *          
     *          @SWG\Property(
     *              property="name",
     *              type="string"
     *          ),
     *          
     *          @SWG\Property(
     *              property="coutry",
     *              type="string"
     *          ),
     *          
     *          @SWG\Property(
     *              property="phone",
     *              type="string"
     *          ),
     *          
     *      )
     *   )
     * )
     * @SWG\Response(
     *     response=200,
     *     description="API Result",
     * )
     * @param Request $request 
     */
    public function post(Request $request)
    {
        return $this->preparePost($request, new PostCommand());
    }
    /**
     *
     * {@inheritDoc}
     * @see \App\Controller\AbstractApiController::put()
     * @Route("/api/customers/{id}", name="editCustomers", methods={"PUT"})
     * @SWG\Tag(name="customers")
     * @SWG\Put(
     *   path="/api/customers/{id}",
     *   summary="Put to URL",
     *   @SWG\Parameter(
     *      name="body",
     *      in="body",
     *      description="JSON Payload",
     *      required=true,
     *      format="application/json",
     *      @SWG\Schema(
     *          type="object",
     *          
     *          @SWG\Property(
     *              property="name",
     *              type="string"
     *          ),
     *          
     *          @SWG\Property(
     *              property="coutry",
     *              type="string"
     *          ),
     *          
     *          @SWG\Property(
     *              property="phone",
     *              type="string"
     *          ),
     *          
     *      )
     *   )
     * )
     * @SWG\Response(
     *     response=200,
     *     description="API Result",
     * )
     * @param int $id
     * @param Request $request
     */
    public function put($id, Request $request)
    {
        return $this->preparePut($id, $request, new PutCommand());
    }
    /**
     *
     * {@inheritDoc}
     * @see \App\Controller\AbstractApiController::delete()
     * @Route("/api/customers/{id}", name="deleteCustomers", methods={"DELETE"})
     * @SWG\Tag(name="customers")
     * @SWG\Response(
     *     response=200,
     *     description="API Result",
     * )
     */
    public function delete($id, Request $request)
    {
        return $this->prepareDelete($id, new DeleteCommand());
    }

    /**
     * {@inheritDoc}
     * @see \App\Controller\AbstractApiController::getAll()
     * @Route("/api/customers", name="getAllCustomers", methods={"GET"})
     * @SWG\Tag(name="customers")
     * @SWG\Response(
     *     response=200,
     *     description="API Result",
     * )
     */
    public function getAll(CustomersQuery $query, Request $request)
    {
        return $this->prepareSearch($query, $request);
    }
    /**
     *
     * {@inheritDoc}
     * @see \App\Controller\AbstractApiController::findById()
     * @Route("/api/customers/{id}", name="getByIdCustomers", methods={"GET"})
     * @SWG\Tag(name="customers")
     * @SWG\Response(
     *     response=200,
     *     description="API Result",
     * )
     */
    public function getById(int $id, CustomersQuery $query)
    {
        try{
            $data = $query->findById($id);
            return $this->json($data, Response::HTTP_OK);
        } catch (\Exception $e){
            return $this->json($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}