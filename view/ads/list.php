<?php /** @var array $templateData */
use Lina\AdsWebsite\Repository\AdsRepository;
$repository = new AdsRepository();
foreach ($templateData['ads'] as $ad): ?>
    <p>
    <h3><?= $ad['title'] ?></h3>
    <?= $likedAd = $repository->findOneLikedAdById($ad['id']);
    //print_r($ad['id']);
    ?>
    <?php if ($likedAd===null): ?>
<a href="/ads/<?=$ad['id']?>/like">
    <button>Like</button>
</a>
    <?php else: ?>
    <form method="post" action="/ads/<?=$ad['id']?>/unlike">
        <button type="submit">Unlike</button>
    </form>

    <?php endif; ?>
    <ul>
        <li>
            <?= $ad['description'] ?>
        </li>
        <li>
            Price: <?= $ad['price'] / 100 ?> eur
        </li>
        <li>
            City: <?= $ad['city'] ?>
        </li>
        <li>
            Contact phone: <?= $ad['phone_number'] ?>
        </li>
        <li>
            Created at: <?= $ad['created_at'] ?>
        </li>
        <li>
            Updated at: <?= $ad['updated_at'] ?>
        </li>
    </ul>
    </p>
<?php endforeach;?>