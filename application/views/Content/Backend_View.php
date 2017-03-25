 
<div   ng-controller="homeController"> 
<div class="row">
		<div class="col-sm-2">&nbsp;</div>
		    <div class="col-sm-8 text-center">

			<div class="  col-sm-6  icon-home-div"  ng-repeat="menu in menus" >
  			<a class="icon-home-a" href="{{menu.menu_link_url}}">
          <div class="  text-center icon-home {{menu.menu_css}}"> </div>
          <div class="glyphicon-class">{{menu.menu_name}} </div>
        </a>
			</div>
			</div>
			</div>
		<div class="col-sm-2">&nbsp;</div>

</div>
</div>
