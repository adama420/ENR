<?php

namespace App\Controller\Admin;

use App\Entity\Alarm;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AlarmCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alarm::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextField::new('description'),
            TextField::new('slug'),
            ImageField::new('image'),
            TextEditorField::new('explanation'),
            TextField::new('subtitle'),
            TextEditorField::new('bullet_list'),
            AssociationField::new('device')

        ];
    }

}
