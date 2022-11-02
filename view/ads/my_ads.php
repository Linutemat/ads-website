<?php /** @var array $templateData */
foreach ($templateData['ads'] as $ad): ?>
    <p>
    <h3><?= $ad['title'] ?></h3>
<a href="/ads/<?= $ad['id']?>/edit">
   <button>Edit</button>
</a>
<form method="post" action="/ads/<?=$ad['id']?>/delete">
    <button type="submit">Delete</button>
</form>
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