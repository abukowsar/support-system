<div class="row play-video3 popup-gallery">
    <video class="stack__img iq-h-500 player" controls autuplay>
        <source src="{{ getSingleMedia($video, 'videos')}}" type="video/mp4" size="720">
    </video>
</div>

<script>
    (function ($) {
        "use strict";

        const players = Array.from(document.querySelectorAll('.player')).map(p => new Plyr(p));
    })(jQuery);
</script>
