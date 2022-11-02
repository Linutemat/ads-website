
<form method="post" action="/ads/create">
    Create new ad
    <div>
        <input type="text" name="title" placeholder="Title" required/>
    </div>
    <div>
        <textarea name="description" placeholder="Description" required></textarea>
    </div>
    <div>
        <input type="text" name="price" placeholder="Price" required/>
    </div>
    <div>
        <input type="tel" name="phone_number" placeholder="Phone Number"/>
    </div>
    <div>
        <input type="text" name="city" placeholder="City" required/>
    </div>
    <input type="submit">
</form>