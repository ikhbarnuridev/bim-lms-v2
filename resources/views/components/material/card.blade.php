<div class="card h-100">
    <img src="{{ $material->getCoverUrl() }}" class="card-img-top" alt="Cover"
         height="140">

    <div class="card-body">
        <h5 class="card-title" style="font-size: 21px">
            {{ Str::limit($material->title, 33, '...') }}
        </h5>
        <p class="card-text small">
            {{ Str::limit($material->description, 66, '...') }}
        </p>
    </div>

    <div class="card-footer border">
        <div class="d-flex align-items-center">
            <img class="avatar avatar-md me-3"
                 src="{{ $material->creator->getPhotoUrl() }}"
                 alt="{{ $material->creator->name }}"
            >
            <div class="d-flex flex-column">
                <span class="small">{{ $material->creator->name }}</span>
            </div>
        </div>
    </div>
</div>
