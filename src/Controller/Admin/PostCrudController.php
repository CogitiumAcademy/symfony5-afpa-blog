<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
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
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            //->renderContentMaximized()
            //->renderSidebarMinimized()
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            BooleanField::new('active')->hideWhenCreating(),
            DateTimeField::new('created_at')->hideWhenCreating(),
            TextField::new('image')->onlyOnForms(),
            ImageField::new('image')->hideOnForm()
                 ->setBasePath($_ENV["APP_CDN"]),
            // ImageField::new('image')
            //     ->setBasePath('uploads/posts')
            //     ->setUploadDir('public/uploads/posts')
            //     ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]'),
            TextField::new('title'),
            AssociationField::new('category'),
            TextEditorField::new('content')->onlyOnForms()->setFormType(CKEditorType::class),
            IntegerField::new('views'),
            AssociationField::new('comments')->hideOnForm(),
            AssociationField::new('tags'),
            AssociationField::new('likedbyusers'),
            // NumberField::new('price')->setNumDecimals(2),
            MoneyField::new('price')->setStoredAsCents(false)->setCurrency('EUR'),
        ];
    }
}
