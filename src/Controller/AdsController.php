<?php

declare(strict_types=1);

namespace Lina\AdsWebsite\Controller;

use Lina\AdsWebsite\Repository\AdsRepository;

class AdsController extends Controller
{
    public function showList(): void
    {
        $adsRepository = new AdsRepository();

        $this->render('./view/ads/list.php', ['ads' => $adsRepository->findAll()]);
    }

    public function showCreateAd(): void
    {
        $this->render('./view/ads/create.php');
    }
    public function handleCreateAd(): void
    {
        $ad = [
            'user_id' => $_SESSION['user_id'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'city' => $_POST['city'],
            'phone_number' => $_POST['phone_number'],
        ];
        $adsRepository = new AdsRepository();
        $adsRepository->create($ad);

        header('Location: /ads/list');
    }
    public function showMyAds(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /ads/list');
        }
        $ads = (new AdsRepository())->findAllByUserId($_SESSION['user_id']);

        $this->render('./view/ads/my_ads.php', ['ads' => $ads]);
    }

    public function showLikedAds(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /ads/list');
        }
        $likedAds = (new AdsRepository())->findLikedAdsByUserId($_SESSION['user_id']);
        $this->render('./view/ads/liked_ads.php', ['ads' => $likedAds]);
    }


    public function handleLike(int $id): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /ads/list');
        }
        $repository = new AdsRepository();
        $likedAd = $repository->findOneLikedAdById($id);
        if ($likedAd !== null) {
            header('Location: /ads/list');
            die;
        }
        $likedAd = $repository->findOneById($id);
        $repository->createNewLikedAd($likedAd['id']);
        header('Location: /ads/list');
    }
    public function handleUnlike(int $id): void
    {
        $adsRepository = new AdsRepository();
        $ad = $adsRepository->findOneLikedAdById($id);
        $adsRepository->unlike($ad['id']);
        header('Location: /ads/list');
    }
    public function showEdit($id): void
    {
        $ad = (new AdsRepository())->findOneById((int) $id);
        if ($_SESSION['user_id'] !== $ad['user_id']) {
            die;
        }
        $this->render('./view/ads/edit.php', ['ad' => $ad]);
    }
    public function handleEdit(int $id): void
    {
        $adsRepository = new AdsRepository();
        $ad = $adsRepository->findOneById($id);
        if ($_SESSION['user_id'] !== $ad['user_id']) {
            die;
        }
        $newAd = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'phone_number' => $_POST['phone_number'],
            'city' => $_POST['city'],
            'id' => $id,
        ];
        $adsRepository->update($newAd);

        header('Location: /ads/' . $id . '/edit');
    }
    public function handleDelete(int $id): void
    {
        $adsRepository = new AdsRepository();
        $ad = $adsRepository->findOneById($id);
        if ($_SESSION['user_id'] !== $ad['user_id']) {
            die;
        }
        $adsRepository->delete($id);
        header('Location: /ads/my');
    }
}
