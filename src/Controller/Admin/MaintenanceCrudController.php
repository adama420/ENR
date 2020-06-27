<?php

namespace App\Controller\Admin;

use App\Entity\Maintenance;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MaintenanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Maintenance::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
