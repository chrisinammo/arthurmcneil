var fabrikvideo = fbElement.extend({
			initialize: function(element, options) {
				this.plugin = 'fabrikvideo';
				this.strElement = element;
				this.setOptions(element, options);
				this.insertMovie();
			},
			
			//full quicktime js ref here
			//http://developer.apple.com/documentation/QuickTime/Conceptual/QTScripting_JavaScript/index.html#//apple_ref/doc/uid/TP40001526
			
			play: function(){
				if(this.getVideoObj()){
					this.video.Play();
				}
			},
			
			stop: function(){
				if(this.getVideoObj()){
					this.video.Stop();
				}
			},
			
			rewind: function(){
				if(this.getVideoObj()){
					this.video.Rewind();
				}
			},
			
			step: function(n){
				if(this.getVideoObj()){
					this.video.Step(n);
				}
			},
			
			getTime: function(){
				if(this.getVideoObj()){
					return this.video.GetTime();
				}
			},
			
			setTime: function(t){
				if(this.getVideoObj()){
					this.video.SetTime(t);
				}
			},
			
			getTimeScale: function(){
				if(this.getVideoObj()){
					return this.video.GetTimeScale();
				}
			},
			
			update: function(val){
				if (!this.options.editable) {
					this.element.innerHTML = val;
					return;
				}
				//@todo: video ajax update');
				if (this.options.file != '') {
					var c = $(this.options.element + '_placeholder');
					c.empty();
				}
				if (val != '') {
					val = this.options.livesite + val;
					var re = /\\/gi;
					val = val.replace(re, "/");
				}
				this.options.file = val;
				this.insertMovie();
			},
			
			getVideoObj: function(){
				this.video = $(this.options.element + '_placeholder').getElementsByTagName('embed')[0];
				return this.video;
			},
			
		insertMovie: function()
			{
				var c = $(this.options.element + '_placeholder');
				var n = this.options.element + "_object";
				
				if( this.options.file != '' ){
					str = '<OBJECT CLASSID="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B"';
					str += ' CODEBASE="http://www.apple.com/qtactivex/qtplugin.cab"';
					str += ' HEIGHT=' + this.options.height;
					str += ' WIDTH=' + this.options.width;
					str += ' ID = "' + n + '"' ;
					str += ' >';
					str += '<PARAM NAME="src" VALUE="' + this.options.file + '" >';
					str += '<EMBED';
					str += ' NAME = "' + n + '"';
					str += ' SRC="' + this.options.file + '"';
					str += ' HEIGHT=' + this.options.height + ' WIDTH=' + this.options.width ;
					str += ' AUTOPLAY = "' + this.options.autoplay + '"';
					str += ' CONTROLLER = "' + this.options.controller + '"';
					str += ' LOOP = "' + this.options.loop + '"';
					str += ' ENABLEJAVASCRIPT = "' + this.options.ENABLEJAVASCRIPT + '"';
					str += ' PLAYEVERYFRAME = "' + this.options.PLAYEVERYFRAME + '"';
					str += ' LOOP = "' + this.options.loop + '"';
					
					str += ' TYPE="video/quicktime"';
					str += ' PLUGINSPAGE="http://www.apple.com/quicktime/download/"';
					str += '/>';
					str += '</OBJECT>';
					
					
					c.setHTML(str);
				//this.video = eval('document.' + n);
					
					//this.video = $(this.options.element + '_placeholder').getElementsByTagName('embed')[0];


					/*
					var p = {
						'CLASSID':"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B",
						'CODEBASE':"http://www.apple.com/qtactivex/qtplugin.cab",
						'HEIGHT':this.options.height,
						'WIDTH':this.options.width,
						'ID':this.options.element + '_object'
					}
					var v = new Element('object', p);
					v.injectInside(c);
					
					var o = new Element('param', {'name':'src', 'value':this.options.file});
					o.injectInside(c);
					
					var p = {
						'NAME':this.options.element + '_object',
						'SRC':this.options.file,
						'HEIGHT': this.options.height,
						'WIDTH':this.options.width,
						'AUTOPLAY': this.options.autoplay,
						'CONTROLLER': this.options.controller,
						'ENABLEJAVASCRIPT': this.options.ENABLEJAVASCRIPT,
						'PLAYEVERYFRAME': this.options.PLAYEVERYFRAME,
						'LOOP':  this.options.loop,
						'TYPE':"video/quicktime",
						'PLUGINSPAGE':"http://www.apple.com/quicktime/download/"
					}
					
					var e = new Element('embed', p);
					e.injectInside(c);
					this.video = $(this.options.element + '_object');*/
					
					
				}
				
			}
		}
);