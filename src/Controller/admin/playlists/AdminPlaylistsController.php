<?php

namespace App\Controller\admin\playlists;

use App\Form\PlaylistType;
use App\Form\FormationType;
use App\Entity\Formation;
use App\Entity\Playlist;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;
class AdminPlaylistsController extends AbstractController
{
    #[Route('/admin/playlists/', name: 'admin.playlists')]
    public function index(): Response
    {
        $formations = $this->formationRepository->findAll();
        $categories = $this->categorieRepository->findAll();
        $playlists  = $this->playlistRepository->findAll() ;

        return $this->render('admin/playlists/admin.playlists.html.twig', [
            'controller_name' => 'AdminPlaylistController',
            'formations' => $formations,
            'playlists' => $playlists,
            'categories'=> $categories,
        ]);
    }
    const PAGE_PLAYLISTS = "admin/playlists/admin.playlists.html.twig";
    

    
    /**
     * @var PlaylistRepository
     */
    private $playlistRepository;
    
    /**
     * @var FormationRepository
     */
    private $formationRepository;
    
    /**
     * @var CategorieRepository
     */
    private $categorieRepository;
    
    public function __construct(
            PlaylistRepository $playlistRepository,
            CategorieRepository $categorieRepository,
            FormationRepository $formationRespository)
            {
        $this->playlistRepository = $playlistRepository;
        $this->categorieRepository = $categorieRepository;
        $this->formationRepository = $formationRespository;
    }
    
    /**
     * @Route("/admin/playlists/tri/{champ}/{ordre}", name="admin.playlists.sort")
     * @param type $champ
     * @param type $ordre
     * @return Response
     */
    public function sort($champ, $ordre): Response{
        if ($champ === "name") {
            $playlists = $this->playlistRepository->findAllOrderByName($ordre);
        } elseif ($champ === "count") {
            $playlists = $this->playlistRepository->findAllOrderByCount($ordre);
        }
        $categories = $this->categorieRepository->findAll();
        return $this->render(self::PAGE_PLAYLISTS, [
            'playlists' => $playlists,
            'categories' => $categories
        ]);
    }
	
    /**
     * @Route("/admin/playlists/recherche/{champ}/{table}", name="admin.playlists.findallcontain")
     * @param type $champ
     * @param Request $request
     * @param type $table
     * @return Response
     */
    public function findAllContain($champ, Request $request, $table=""): Response{
        $valeur = $request->get("recherche");
        $playlists = $this->playlistRepository->findByContainValue($champ, $valeur, $table);
        $categories = $this->categorieRepository->findAll();
        return $this->render(self::PAGE_PLAYLISTS, [
            'playlists' => $playlists,
            'categories' => $categories,
            'valeur' => $valeur,
            'table' => $table
        ]);
    }
    
    /**
     * @Route("/admin/playlists/playlist/{id}", name="admin.playlists.showone")
     * @param type $id
     * @return Response
     */
    public function showOne($id): Response{
        $playlist = $this->playlistRepository->find($id);
        $playlistCategories = $this->categorieRepository->findAllForOnePlaylist($id);
        $playlistFormations = $this->formationRepository->findAllForOnePlaylist($id);
        return $this->render("pages/playlist.html.twig", [
            'playlist' => $playlist,
            'playlistcategories' => $playlistCategories,
            'playlistformations' => $playlistFormations
        ]);
    }
       /**
     * @Route("/admin/playlists/delete/{id}", name="admin.playlists.delete")
     * @param Playlist $playlist
     * @return Response
     */
    public function delete(Playlist $playlist): Response {
        $totalVideos = count($playlist->getFormations());

        if ($totalVideos === 0) {
            $this->playlistRepository->remove($playlist, true);
        }   else {
            $this->addFlash('error', 'Impossible de supprimer la playlist car celle-ci n\'est pas vide');
        }
        return $this->redirectToRoute('admin.playlists');
    }
     /**
     * @Route("/admin/playlists/edit/{id}", name="admin.playlists.edit")
     * @param type $playlist
     * @return Response
     */

    public function edit(Request $request,Playlist $playlist): Response
    {
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('admin.playlists');
        }

        return $this->render('admin/playlists/admin.playlists_edit.html.twig', [
            'playlist' => $playlist,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/admin/playlists/add', name: 'admin.playlists.add')]
    public function add(Request $request): Response
    {
        $playlist = new Playlist();
        $form = $this->createForm(PlaylistType::class,$playlist );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($playlist);
            $entityManager->flush();

            return $this->redirectToRoute('admin.playlists');
        }

        return $this->render('admin/playlists/admin.playlists_add.html.twig', [
            'playlist' => $playlist,
            'form' => $form->createView(),
        ]);
    }
    
}



