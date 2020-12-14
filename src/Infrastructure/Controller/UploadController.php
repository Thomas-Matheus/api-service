<?php

namespace App\Infrastructure\Controller;

use App\Domain\Service\UploadService;
use App\Infrastructure\Form\UploadForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UploadController.
 */
class UploadController extends AbstractController
{
    private UploadService $uploadService;

    /**
     * UploadController constructor.
     * @param UploadService $uploadService
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * @Route("/upload", name="upload", methods={"POST", "GET"})
     *
     * @param Request $request
     * @return Response
     */
    public function upload(Request $request)
    {
        $form = $this->createForm(UploadForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->uploadService->consumerXml($form->getData());

            $message = [
                'result' => 'success',
                'content' => 'File uploaded',
            ];

            $this->get('session')->getFlashBag()->add($message['result'], $message['content']);
        }

        return $this
            ->render('upload/upload.html.twig', ['form' => $form->createView()]);
    }
}
