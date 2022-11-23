<!-- footer -->
<div>
  &copy;
  <?php
  $curYear = date('Y');
  echo $curYear; // display the current year
  ?>
  PHP Motors, All rights reserved.
</div>
<div>
  All images used are believed to be in "Fair Use".
  Please notify the author if any are not and they will be removed.
</div>
<span>
  Last Updated:
  <?php
  $timestamp = filemtime("./");
  $date = date('d M, Y', $timestamp);
  echo $date; // display the last modified date
  ?>
</span>