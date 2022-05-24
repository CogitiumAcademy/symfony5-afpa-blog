<?php

namespace App\Controller\Admin3;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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

    public function createEntity(string $entityFqcn)
    {
        $post = new Post();
        $post->setActive(true);
        $post->setUser($this->getUser());

        return $post;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC'])
            //->renderContentMaximized()
            //->renderSidebarMinimized()
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('created_at')->hideWhenCreating(),
            ImageField::new('image')
                ->setBasePath('uploads/posts')
                ->setUploadDir('public/uploads/posts')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]'),
            TextField::new('title'),
            AssociationField::new('category'),
            TextEditorField::new('content')->onlyOnForms(),
            TextField::new('image')->onlyOnForms(),
            BooleanField::new('active')->hideWhenCreating(),
        ];
    }
}
