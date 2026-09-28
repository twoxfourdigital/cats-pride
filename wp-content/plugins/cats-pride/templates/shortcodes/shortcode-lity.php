<a href="<?php echo $url; ?>" class="x-img image-center x-img-link x-img-none lity-link cp-lity">
  <?php if (isset($poster)) { ?>
    <img src="<?php echo $poster; ?>" alt="<?php echo $poster_alt; ?>">
  <?php } ?>
  <?php if ($play_button) { ?>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><defs><style>.cls-1{fill:#fff;opacity:0.75;}</style></defs><path class="cls-1" d="M25,0A25,25,0,1,0,50,25,25,25,0,0,0,25,0ZM17.78,37.5v-25L39.43,25Z"></path></svg>
  <?php } ?>
</a>
