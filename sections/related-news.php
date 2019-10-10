<!-- related news -->
<div id="related-news">
    <?php if (have_posts()): ?>
      <div class="content">
      
      </div>

      <div class="nav-pagination text-center padding-vertical-1 hide">
         <hr>
         <h5>Sem mais Notícias!</h5>
      </div>
    <?php else: ?>
    <div>
      <?php echo ('Nenhum resultado encontrado'); ?>
    </div>
    <?php endif; ?>
</div>


<script type="text/javascript">
   jQuery(document).ready(function($) {

      var contpage = 0;
      var npostspage = 2 ;
      var exclude = [];
      exclude[0] = <?php echo get_the_ID(); ?>;
      var posts = loadMore('news',contpage,npostspage,exclude); 
      var row = 0;

      //busca os post ao carregar a pagina
      while (row < posts.length) {

         var content = 
         '<div class="grid-container full post">\
               <div class="grid-x grid-margin-x">\
                  <div class="cell small-12">\
                     <div class="grid-container padding-vertical-2">\
                        <div class="grid-x grid-margin-x">\
                           <div class="cell small-12 medium-3 large-3 padding-bottom-2 text-center">\
                              <a href="' + posts[row]["link"] + '">\
                                 <img class="img-thumb" src="' + posts[row]["thumbimg"] + '">\
                              </a>\
                        </div>\
                        <div class="cell small-12 medium-9 large-9">\
                           <div class="middle-align">\
                                 <a href="' + posts[row]["link"] + '">\
                                 <h2>' + posts[row]["title"] + '</h2>\
                                 </a>\
                                 <p>' + posts[row]["short"] + '</p>\
                           </div>\
                        </div>\
                     </div>\
                  </div>\
               </div>\
            </div>\
         </div>';

        $("#related-news .content").append(content);
        var id = posts[row]["postid"];
        row = row + 1;
        exclude[row] = id;
      }
      var contexclude = row;
      
      //carrega posts ao chegar ao fim da pagina
      $(window).scroll(function() {

         if($(window).scrollTop() + window.innerHeight > $(document).height() - 50) {

            //contpage =  contpage + npostspage ; 
            var posts = loadMore('news',contpage,npostspage,exclude);
            if (posts.length != 0) {
               var row = 0;

               //busca os post ao carregar a pagina
               while (row < posts.length) {

                var content = 
                '<div class="grid-container full post">\
                      <div class="grid-x grid-margin-x">\
                         <div class="cell small-12">\
                            <div class="grid-container padding-vertical-2">\
                               <div class="grid-x grid-margin-x">\
                                  <div class="cell small-12 medium-3 large-3 padding-bottom-2 text-center">\
                                     <a href="' + posts[row]["link"] + '">\
                                        <img class="img-thumb" src="' + posts[row]["thumbimg"] + '">\
                                     </a>\
                               </div>\
                               <div class="cell small-12 medium-9 large-9">\
                                  <div class="middle-align">\
                                        <a href="' + posts[row]["link"] + '">\
                                        <h2>' + posts[row]["title"] + '</h2>\
                                        </a>\
                                        <p>' + posts[row]["short"] + '</p>\
                                  </div>\
                               </div>\
                            </div>\
                         </div>\
                      </div>\
                   </div>\
                </div>';

                $("#related-news .content").append(content);
                contexclude = contexclude + 1;
                exclude[contexclude] = posts[row]["postid"];
                row = row + 1;

               }

            } else {
               $("#related-news .nav-pagination").removeClass("hide");
            }
         }
      });

   }); 
</script>