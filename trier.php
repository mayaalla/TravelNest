

<style>
   .dropdown-item{
       transition: 0.3s color  background-color;
   
   }
   .dropdown-item:hover{
      /* primary */
       background-color: #ff741d !important;
       cursor: pointer;
       color: white;
   }
   

</style>


<div class="row text-end">
               <div class="dropdown">
                  <button class="btn btn-primary bg-primary text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-sort"></i> Sort by
                  </button>
               <ul class="dropdown-menu py-0">
                  <li><a class="dropdown-item  py-2" id="sortByPricehl" href="#">Price high to low</a></li>
                  <li ><a class="dropdown-item py-2" id="sortByPricelh" href="#">Price low to high</a></li>
                  <li id="sortByStarshl"><a class="dropdown-item py-2"  href="#">Number of stars high to low</a></li>
                  <li id="sortByStarslh"><a class="dropdown-item py-2"  href="#">Number of stars low to high</a></li>
                  <li><a class="dropdown-item  py-2" id="sortByNote" href="#">Comment notes</a></li>
               </ul>
               </div>
</div>
            <script src="js/trier.js"></script>





