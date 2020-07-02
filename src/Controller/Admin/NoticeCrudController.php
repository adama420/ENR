<?php

namespace App\Controller\Admin;

use App\Entity\Notice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class NoticeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Notice::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextEditorField::new('pdf_file'),
            TextEditorField::new('image_name'),
            ImageField::new('image_file'),
            AssociationField::new('device')
        ];
    }

}
