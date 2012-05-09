<?php

namespace Dime\TimetrackerBundle\Controller;

use Dime\TimetrackerBundle\Entity\Service,
    Dime\TimetrackerBundle\Form\ServiceType;

class ServicesController extends DimeController
{
    /**
     * get service repository
     *
     * @return Dime\TimetrackerBundle\Entity\ServiceRepository
     */
    protected function getServiceRepository()
    {
        return $this->getDoctrine()->getRepository('DimeTimetrackerBundle:Service');
    }

    /**
     * get a list of all services
     *
     * [GET] /services
     *
     * @return FOS\RestBundle\View\View
     */
    public function getServicesAction()
    {
        $services = $this->getServiceRepository();
        return $this->createView($services->findAll());
    }

    /**
     * get a service by its id
     * [GET] /services/{id}
     *
     * @param int $id
     * @return FOS\RestBundle\View\View
     */
    public function getServiceAction($id)
    {
        // find service
        $service = $this->getServiceRepository()->find($id);
        
        // check if it exists
        if ($service) {
            // send array
            $view = $this->createView($service);
        } else {
            // service does not exists send 404
            $view = $this->createView("Service does not exists.", 404);
        }
        return $view;
    }

    /**
     * create a new service
     * [POST] /services
     *
     * @return FOS\RestBundle\View\View
     */
    public function postServicesAction()
    {
        // create new service
        $service = new Service();

        // create service form
        $form = $this->createForm(new ServiceType(), $service);

        // convert json to assoc array from request content
        $data = json_decode($this->getRequest()->getContent(), true);

        return $this->saveForm($form, $data);
    }

    /**
     * modify service by its id
     * [PUT] /services/{id}
     *
     * @param int $id
     * @return FOS\RestBundle\View\View
     */
    public function putServicesAction($id)
    {
        // find service
        $service = $this->getServiceRepository()->find($id);
        
        // check if it exists
        if ($service) {
            // create form, decode request and save it if valid
            $view = $this->saveForm(
                $this->createForm(new ServiceType(), $service),
                json_decode($this->getRequest()->getContent(), true)
            );
        } else {
            // service does not exists send 404
            $view = $this->createView("Service does not exists.", 404);
        }
        return $view;
    }

    /**
     * delete service by its id
     * [DELETE] /services/{id}
     *
     * @param int $id
     * @return FOS\RestBundle\View\View
     */
    public function deleteServicesAction($id)
    {
        // find service
        $service = $this->getServiceRepository()->find($id);
        
        // check if it exists
        if ($service) {
            // remove service
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($service);
            $em->flush();
            
            // send status message
            $view = $this->createView("Service has been removed.");
        } else {
            // service does not exists send 404
            $view = $this->createView("Service does not exists", 404);
        }
        return $view;
    }
}
