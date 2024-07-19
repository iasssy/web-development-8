
<?php foreach (($resultsLists?:[]) as $itemList): ?>
<li>
  <a href="#" data-bs-toggle="collapse" class="nav-link align-middle">
    <!--<i class="bi bi-music-note"></i>-->
    <span class="ms-1 d-none d-sm-inline"><?= ($itemList['name']) ?></span> 
  </a>
</li>  
<?php endforeach; ?>