<?php

namespace App\Controller\Admin3;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            //DateTimeField::new('created_at')->hideWhenCreating(),
            TextField::new('title'),
            AssociationField::new('category'),
            TextEditorField::new('content')->onlyOnForms(),
            ImageField::new('image')->hideOnForm(),
            TextField::new('image')->onlyOnForms(),
            BooleanField::new('active')->hideWhenCreating(),
        ];
    }
}
