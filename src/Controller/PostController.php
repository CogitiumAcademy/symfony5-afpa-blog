<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('post/home.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[Route('/post/add', name: 'post_add')]
    public function addPost(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        return $this->render('post/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/post/{id}', name: 'post_view')]
    public function post($id): Response
    {
        return $this->render('post/view.html.twig', [
            'post' => [
                'title' => 'Le titre de l\'article',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris volutpat quam quis risus cursus rhoncus. Ut lacinia ac elit a finibus. Nullam orci orci, imperdiet et tincidunt eu, interdum in tortor. Nullam ornare dolor est, a hendrerit ante commodo vitae. Nulla et tortor finibus, ultricies lectus sit amet, cursus velit. Ut vel luctus lacus. Proin gravida maximus est, non placerat nunc rhoncus eu. Nam vitae nisl fermentum ligula pharetra dapibus ac pulvinar odio. Cras sed turpis vulputate, aliquet est non, sollicitudin nibh. Morbi dictum pellentesque mi id fermentum. Vivamus a pharetra felis. Praesent sit amet vulputate ex, et pulvinar quam.

                Nunc eget enim bibendum, dignissim nisl vehicula, vestibulum odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut quis bibendum urna. Nam vel dolor ut orci sollicitudin bibendum a ac purus. Nam tempus odio sit amet auctor vestibulum. Donec id lectus risus. Curabitur sed enim faucibus, laoreet mauris sodales, lacinia ex. Maecenas commodo orci id turpis suscipit efficitur. Aenean venenatis metus enim, vitae euismod risus posuere nec. Nulla facilisi. Suspendisse potenti. Donec viverra ipsum in dui consequat suscipit. Ut id sapien bibendum, venenatis ex eu, finibus elit. Nullam molestie massa sit amet tortor rhoncus hendrerit. Nulla rhoncus sem sed augue vehicula venenatis. Sed lobortis metus aliquam feugiat iaculis.
                
                Ut volutpat sagittis nunc et pellentesque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Pellentesque sit amet ullamcorper risus. Fusce a pellentesque nisi, eu sagittis mauris. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum sed varius justo. Ut porttitor, sem at mattis vestibulum, lectus leo facilisis nulla, molestie vehicula odio orci sit amet ex. Quisque mattis, nibh sed semper pellentesque, ligula lacus venenatis diam, ut ullamcorper magna arcu in arcu. Proin magna urna, interdum non feugiat id, pulvinar vitae tellus.
                
                Pellentesque nec ipsum libero. Donec ante erat, posuere quis massa vitae, viverra pulvinar felis. Pellentesque venenatis sem quis dui porta placerat. Etiam erat nulla, semper id eros et, sodales suscipit diam. Morbi nisi ante, vestibulum sit amet magna vel, sagittis venenatis leo. Curabitur tristique, ex et interdum sodales, quam libero ornare massa, non fermentum lorem nibh at risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                
                Proin nulla enim, semper non sodales vel, luctus eget erat. Phasellus commodo velit vel sapien tincidunt, eu commodo risus viverra. Mauris vel rutrum diam. Morbi sit amet ultricies sem, at pulvinar nisi. Maecenas eu felis non est luctus posuere. Proin ultrices libero eget vulputate tincidunt. Integer vitae ultricies libero, in ultricies neque. Integer et ultrices ligula. Fusce mattis ligula vel velit tincidunt varius.
                
                Proin dictum, quam a venenatis mollis, tellus ex efficitur dui, finibus consequat mauris ipsum porttitor purus. Vestibulum condimentum lorem diam, id rhoncus tortor elementum quis. Phasellus sed vestibulum arcu, eget molestie leo. Phasellus sollicitudin ligula vel porttitor laoreet. Mauris mattis pellentesque elit, quis egestas mauris semper eget. Ut eu ante aliquam, scelerisque libero ut, vehicula arcu. Etiam mattis elit vitae eros egestas congue.'
            ],
        ]);
    }

}
