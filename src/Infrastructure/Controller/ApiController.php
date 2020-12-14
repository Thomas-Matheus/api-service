<?php

namespace App\Infrastructure\Controller;

use App\Domain\Entity\Phone;
use App\Domain\Service\PersonService;
use App\Domain\Service\ShipOrderService;
use OpenApi\Annotations\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController.
 */
class ApiController extends AbstractController
{
    private PersonService $personService;
    private ShipOrderService $shipOrderService;

    /**
     * ApiController constructor.
     * @param PersonService $personService
     * @param ShipOrderService $shipOrderService
     */
    public function __construct(PersonService $personService, ShipOrderService $shipOrderService)
    {
        $this->personService = $personService;
        $this->shipOrderService = $shipOrderService;
    }

    /**
     * @Route("/api/people", name="get_person", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function getPeople(Request $request)
    {
        $criteria = [];

        if ($request->get('name')) {
            $criteria['name'] = filter_var($request->get('name'), FILTER_SANITIZE_STRING);
        }

        $personEntities = $this->personService->findBy($criteria);

        $data = [];

        foreach ($personEntities as $personEntity) {
            $data[] = json_decode($this->get('jms_serializer')->serialize($personEntity, 'json'), true);
        }

        return new JsonResponse($data);
    }

    /**
     * @Route("/api/people/{id}", name="get_person_id", methods={"GET"})
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function getPerson($id)
    {
        $personEntity = $this->personService->findById((int) $id);

        return new JsonResponse(json_decode($this->get('jms_serializer')->serialize($personEntity, 'json')));
    }

    /**
     * @Route("/api/person/{id}/phones", name="get_person_phones", methods={"GET"})
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function getPersonPhones($id)
    {
        $personEntity = $this->personService->findById((int) $id);

        if (!$personEntity) {
            return new JsonResponse(['message' => 'Person not found'], 404);
        }

        $data = [];
        /** @var Phone $phone */
        foreach ($personEntity->getPhones() as $phone) {
            $data[] = [
                'id' => $phone->getId(),
                'phone' => $phone->getPhone(),
            ];
        }

        return new JsonResponse($data);
    }

    /**
     * @Route("/api/orders/{id}", name="get_orders_id", methods={"GET"})
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function getShiporder($id)
    {
        $shipOrder = $this->shipOrderService->findById((int) $id);

        return new JsonResponse(json_decode($this->get('jms_serializer')->serialize($shipOrder, 'json'), true));
    }

    /**
     * @Route("/orders/person/{id}", name="get_orders_person_id", methods={"GET"})
     *
     * @param $personId
     *
     * @return JsonResponse
     */
    public function getPersonShiporders($personId)
    {
        $shipOrders = $this->shipOrderService->findBy(['orderPerson' => (int) $personId]);

        $data = [];
        foreach ($shipOrders as $shipOrder) {
            $data[] = json_decode($this->get('jms_serializer')->serialize($shipOrder, 'json'), true);
        }

        return new JsonResponse($data);
    }
}
