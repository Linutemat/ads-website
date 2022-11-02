<?php
/** @var array $templateData */

$ad=$templateData['ad'];
?>
<form method="POST" action="/ads/<?=$ad['id']?>/edit">
    Edit ad
    <div>
        <input type="text" name="title" placeholder="Title" value="<?=$ad['title']?>" required/>
    </div>
    <div>
        <textarea name="description" placeholder="Description" required><?=$ad['description']?></textarea>
    </div>
    <div>
        <input type="text" name="price" placeholder="Price" value="<?= $ad['price'] ?>" required/>
    </div>
    <div>
        <input type="tel" name="phone_number" placeholder="Phone Number" value="<?= $ad['phone_number'] ?>"/>
    </div>
    <div>
        <input type="text" name="city" placeholder="City" value="<?= $ad['city'] ?>" required/>
    </div>
    <input type="submit">
</form>