/**
 * @author Robert
*/
var fbImage = fbElement.extend({
	initialize: function(element, options) {
		this.setOptions(element, options);
		this.options.rootDir = options.rootDir;
    	this.folderDir = $(element + '_folder');
		this.imageDir = $(element + '_dd');
		this.hiddenField = $(element);
		this.image = $(element + '_img');
		this.imageFolderList = new Array();
		this.selectedFolder = '';
		if(this.folderDir){
			if(this.folderDir.options.length != 0){
				this.selectedFolder = (this.folderDir).getValue();
			}else{
				this.selectedFolder = '';
			}
		}
		if(this.imageDir.options.length != 0){
			this.selectedImage = (this.imageDir).getValue();
		}else{
			this.selectedImage = '';
		}
		this.aChangeFolder = this.changeFolder.bindAsEventListener(this);
		this.aShowImage = this.showImage.bindAsEventListener(this);
		
		
		$(this.folderDir).addEvent( 'change', this.aChangeFolder);
		$(this.imageDir).addEvent( 'change', this.aShowImage);
		this.showImage();
	},
	
	addImageListOption: function(folder, files){
		if(!this.imageOptionExists( folder )){
			var o = {
				'folder': folder,
				'files': files
				}
			this.imageFolderList.push(o);
		}
	},
				
	imageOptionExists: function( folder ){
		var found = this.imageFolderList.find( function (o){
			return (o.folder == folder);
		})
		if(found){
			return true;
		}else{
			return false;
		}
	},
  	
	changeFolder: function( e ){
		var event = new Event(e);
		var el = event.target;
		var folder =$( el.id.replace('_folder', '_dd'));
		this.selectedFolder = (el).getValue();
		folder.innerHTML = '';
		var url = 'index.php?option=com_fabrik&format=raw&format=raw&Itemid=' + this.options.Itemid + '&task=elementPluginAjax&plugin=fabrikImage&method=ajax_GetImages&element_id=' + this.options.id + '&f=' + encodeURIComponent(this.selectedFolder);
		var myAjax = new Ajax(url, { method:'post', 
		onComplete: function(r){
			var newImages = eval(r);
			newImages.each(function(i){
				var opt = new Element('option', {'value':i}).appendText(i);
				opt.injectInside(folder);
			});
			this.showImage();
			//this.element.value = this.selectedImage;
		}.bind(this)}).request();
	},
	
	showImage: function( e ){
		if(e){
			var event = new Event(e);
			var el = event.target;
		}else{
			var el = this.imageDir;
		}
		if(el.options.length == 0){
			this.image.src = '';
			this.selectedImage = '';
		}else{
			this.selectedImage = el.getValue();
			this.image.src = this.options.rootDir + '/' + this.selectedFolder + '/' + this.selectedImage;
		}
		this.hiddenField.value = this.selectedFolder + this.selectedImage;
	}	
});
