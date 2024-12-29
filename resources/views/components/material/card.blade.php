<div class="card h-100">
    <img src="https://picsum.photos/200" class="card-img-top" alt="Cover"
         height="140">

    <div class="card-body">
        <h5 class="card-title" style="font-size: 21px">
            {{ Str::limit($material->title, 33, '...') }}
        </h5>
        <p class="card-text small">Some quick example text to build on the card title and
            make up the bulk of the card's content.</p>
    </div>

    <div class="card-footer">

    </div>
</div>
