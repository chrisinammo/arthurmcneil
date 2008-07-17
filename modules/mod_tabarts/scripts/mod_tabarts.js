window.addEvent("domready",function(){
	$ES(".gk_tabarts").each(function(el,i){
		var module_id = el.getProperty("id");
		var $G = $Gavick["gk_tabarts"+module_id]; 
		var modsArray = el.getElementsBySelector('.gk_tabarts_item');
		var animation = ($G["autoAnimation"] == 0) ? true : false;
		var actual = 0;
		var evnt = ($G["activator"] == 0) ? "click" : "mouseenter";
		var amount = modsArray.length;
		var timer = false;
		
		if($G["styleType"] == 1){
			var baseWidth = $E(".gk_tabarts_container2", el).getSize().size.x;
			el.setStyle("width",baseWidth+"px");
			var listTab = $E('.gk_tabartsmenu_ul',el);
			baseWidth -= listTab.getSize().size.x;
			baseWidth -= listTab.getStyle("margin-left").toInt();
			baseWidth -= listTab.getStyle("margin-right").toInt();
			baseWidth -= listTab.getStyle("padding-right").toInt();
			baseWidth -= listTab.getStyle("padding-left").toInt();
			baseWidth -= $E(".gk_tabarts_container0",el).getStyle("margin-left").toInt();
			baseWidth -= $E(".gk_tabarts_container0",el).getStyle("margin-right").toInt();
			baseWidth -= $E(".gk_tabarts_container0",el).getStyle("padding-left").toInt();
			baseWidth -= $E(".gk_tabarts_container0",el).getStyle("padding-right").toInt();
			
			$E(".gk_tabarts_container1",el).setStyle("width",baseWidth+"px");
			$E(".gk_tabarts_container0",el).setStyle("width",baseWidth+"px");
			$ES(".gk_tabarts_item", el).setStyle("width",baseWidth+"px");
		}
		$E('.gk_tabartsmenu_ul li',el).toggleClass("active");
		var param = ($G["animationType"] == 1) ? "width": "height";
		$E(".gk_tabarts_container2", el).setStyle(param, ((amount+1)*$E(".gk_tabarts_container1", el).getSize().size.x));
		$ES(".gk_tabarts_item", el).each(function(e){e.setStyle("width", $E(".gk_tabarts_container1", el).getSize().size.x + "px");});
		$ES('.gk_tabartsmenu_ul li', el).each(function(elm,j){
			elm.addEvent(evnt,function(){
			    actual = gk_tabarts_anim(j, actual, amount, modsArray, el, $G["animationTransition"], $G["animationSpeed"]);
				
				$ES('.gk_tabartsmenu_ul li', el).each(function(elmt){elmt.setProperty("class","");});
				$ES('.gk_tabartsmenu_ul li', el)[actual].toggleClass("active");
				
				if(timer){
					$clear(timer);	
					timer = (function(){
						actual = gk_tabarts_anim("right" , actual, amount, modsArray, el, $G["animationTransition"], $G["animationSpeed"]);
						$ES('.gk_tabartsmenu_ul li', el).each(function(elmt, i){elmt.setProperty("class","");});
						$ES('.gk_tabartsmenu_ul li', el)[actual].toggleClass("active");
					}).periodical($G["animationInterval"]);
				}
			});
		});
		
		if($E(".gk_tabarts_button_next", el)){
			$E(".gk_tabarts_button_next", el).addEvent("click",function(){
				actual = gk_tabarts_anim('right', actual, amount, modsArray, el, $G["animationTransition"], $G["animationSpeed"]);
				$ES('.gk_tabartsmenu_ul li', el).each(function(elmt){elmt.setProperty("class","");});
				$ES('.gk_tabartsmenu_ul li', el)[actual].toggleClass("active");
				
				if(timer){
					$clear(timer);
					timer = (function(){
						actual = gk_tabarts_anim("right" , actual, amount, modsArray, el, $G["animationTransition"], $G["animationSpeed"]);
						$ES('.gk_tabartsmenu_ul li', el).each(function(elmt, i){elmt.setProperty("class","");});
						$ES('.gk_tabartsmenu_ul li', el)[actual].toggleClass("active");
					}).periodical($G["animationInterval"]);
				}
			});
		}
		
		if($E(".gk_tabarts_button_prev", el)){
			$E(".gk_tabarts_button_prev", el).addEvent("click",function(){
				actual = gk_tabarts_anim('left', actual, amount, modsArray, el, $G["animationTransition"], $G["animationSpeed"]);	
				$ES('.gk_tabartsmenu_ul li', el).each(function(elmt){elmt.setProperty("class","");});
				$ES('.gk_tabartsmenu_ul li', el)[actual].toggleClass("active");
				
				if(timer){
					$clear(timer);	
					timer = (function(){
						actual = gk_tabarts_anim("right" , actual, amount, modsArray, el, $G["animationTransition"], $G["animationSpeed"]);
						$ES('.gk_tabartsmenu_ul li', el).each(function(elmt, i){elmt.setProperty("class","");});
						$ES('.gk_tabartsmenu_ul li', el)[actual].toggleClass("active");
					}).periodical($G["animationInterval"]);
				}
			});
		}

		if($G["autoAnimation"] == 1){
			timer = (function(){
				actual = gk_tabarts_anim("right" , actual, amount, modsArray, el, $G["animationTransition"], $G["animationSpeed"]);
				$ES('.gk_tabartsmenu_ul li', el).each(function(elmt, i){elmt.setProperty("class","");});
				$ES('.gk_tabartsmenu_ul li', el)[actual].toggleClass("active");
			}).periodical($G["animationInterval"]);
		}
	});
});

function gk_tabarts_anim(direct, actual, amount, modsArray, el, t, s){
	var transitions_tab = [
		0,0,0,0,0,0,0,0,0,0,0,
		Fx.Transitions.linear,
		Fx.Transitions.Quad.easeIn,
		Fx.Transitions.Quad.easeOut,
		Fx.Transitions.Quad.easeInOut,
		Fx.Transitions.Cubic.easeIn,
		Fx.Transitions.Cubic.easeOut,
		Fx.Transitions.Cubic.easeInOut,
		Fx.Transitions.Quart.easeIn,
		Fx.Transitions.Quart.easeOut,
		Fx.Transitions.Quart.easeInOut,
		Fx.Transitions.Quint.easeIn,
		Fx.Transitions.Quint.easeOut,
		Fx.Transitions.Quint.easeInOut,
		Fx.Transitions.Pow.easeIn,
		Fx.Transitions.Pow.easeOut,
		Fx.Transitions.Pow.easeInOut,
		Fx.Transitions.Expo.easeIn,
		Fx.Transitions.Expo.easeOut,
		Fx.Transitions.Expo.easeInOut,
		Fx.Transitions.Circ.easeIn,
		Fx.Transitions.Circ.easeOut,
		Fx.Transitions.Circ.easeInOut,
		Fx.Transitions.Sine.easeIn,
		Fx.Transitions.Sine.easeOut,
		Fx.Transitions.Sine.easeInOut,
		Fx.Transitions.Back.easeIn,
		Fx.Transitions.Back.easeOut,
		Fx.Transitions.Back.easeInOut,
		Fx.Transitions.Bounce.easeIn,
		Fx.Transitions.Bounce.easeOut,
		Fx.Transitions.Bounce.easeInOut,
		Fx.Transitions.Elastic.easeIn,
		Fx.Transitions.Elastic.easeOut, 
		Fx.Transitions.Elastic.easeInOut
	];
	
	var scr = new Fx.Scroll($E(".gk_tabarts_container1",el), {duration: s, wait: true, transition: transitions_tab[t]});
	
	if(direct == 'left'){
		(actual > 0) ? actual-- : actual = amount - 1;
		scr.toElement(modsArray[actual]);
	}else if(direct == 'right'){
		(actual < (amount-1)) ? actual += 1 : actual = 0;
		scr.toElement(modsArray[actual]);
	}else{
		actual = direct;
		scr.toElement(modsArray[actual]);
	}
	
	return actual;
}