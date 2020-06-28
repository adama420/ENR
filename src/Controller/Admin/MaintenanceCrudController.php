<?php

namespace App\Controller\Admin;

use App\Entity\Maintenance;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MaintenanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Maintenance::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name_step'),
            TextField::new('title'),
            TextEditorField::new('explanation'),
            ImageField::new('image'),
            TextEditorField::new('bullet_list'),
            AssociationField::new('device')
        ];
    }

}
