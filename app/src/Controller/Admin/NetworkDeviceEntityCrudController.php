<?php

namespace App\Controller\Admin;

use App\Component\NetworkDevice\NetworkDevice;
use App\Entity\NetworkDeviceEntity;
use App\Enum\SNMP\ReadingDataType;
use App\Form\Type\IpAddressType;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminRoute;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;

class NetworkDeviceEntityCrudController extends AbstractCrudController
{
    public function __construct(
        private readonly NetworkDevice $networkDeviceComponent,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return NetworkDeviceEntity::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            HiddenField::new('id'),
            TextField::new('name'),
            TextField::new('ipAddress', 'Ip Address')
                ->setFormType(IpAddressType::class),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $fetchDeviceSummaryAction = Action::new('network_device_entity_fetch_summary', 'Summary', 'fa fa-file')
            ->linkToCrudAction('fetchDeviceSummary');
        $fetchDeviceTrafficAction = Action::new('network_device_entity_traffic', 'Traffic', 'fa fa-envelope')
            ->linkToCrudAction('fetchDeviceTraffic');

        $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
        $actions->add(Crud::PAGE_DETAIL, $fetchDeviceSummaryAction);
        $actions->add(Crud::PAGE_DETAIL, $fetchDeviceTrafficAction);

        return $actions;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->overrideTemplate('crud/detail', 'admin/network_device/detail.html.twig');
    }

    #[AdminRoute(
        path: '{entityId}/fetch-summary',
        name: 'network_device_entity_fetch_summary',
    )]
    public function fetchDeviceSummary(int $entityId): Response
    {
        try {
            $this->networkDeviceComponent->refreshDataFromSnmp($entityId, ReadingDataType::Summary);
        } catch (\Throwable $exception) {
            $this->addFlash('error', $exception->getMessage());
        }

        return $this->redirectToRoute('admin_network_device_entity_detail', [
            'entityId' => $entityId,
        ]);
    }

    #[AdminRoute(
        path: '{entityId}/fetch-traffic',
        name: 'network_device_entity_traffic',
    )]
    public function fetchDeviceTraffic(int $entityId): Response
    {
        try {
            $this->networkDeviceComponent->refreshDataFromSnmp($entityId, ReadingDataType::Traffic);
        } catch (\Throwable $exception) {
            $this->addFlash('error', $exception->getMessage());
        }
        return $this->redirectToRoute('admin_network_device_entity_detail', [
            'entityId' => $entityId,
        ]);
    }
}
