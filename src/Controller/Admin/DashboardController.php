<?php

namespace App\Controller\Admin;

use App\Entity\Alarm;
use App\Entity\Device;
use App\Entity\Maintenance;
use App\Entity\Notice;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ENR');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToCrud('Alarm', 'fa fa-tags', Alarm::class),
            MenuItem::linkToCrud('Device', 'fa fa-tags', Device::class),
            MenuItem::linkToCrud('Maintenance', 'fa fa-tags', Maintenance::class),
            MenuItem::linkToCrud('Notice', 'fa fa-tags', Notice::class),
            MenuItem::linkToCrud('User', 'fa fa-tags', User::class)

        ];
    }
}
