  <?php
// put this at the bottom of your page/script
                $exectime = microtime();
                $exectime = explode(" ", $exectime);
                $exectime = $exectime[1] + $exectime[0];
                $endtime = $exectime;
                $totaltime = ($endtime - $starttime);
                return  "we takes {$totaltime} seconds only to create this page for you ";
                
                
                ?>
