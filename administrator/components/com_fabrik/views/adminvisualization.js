var adminVisualization = new Class({
	
	initialize: function(){
		this.options = Object.extend({
		}, arguments[0] || {});
		this.watchSelector();
		this.setActive(this.options.sel)
	},
	
	watchSelector: function(){
		$('plugin').addEvent('change', function(e){
			var event = new Event(e);
			var sel = event.target;
			var opt = sel.getValue();
			$$('.pluginSettings').each(function(tab){
				if(opt == tab.id.replace('page-', '')){
					tab.setStyles({display:'block'});
				}else{
					tab.setStyles({display:'none'}); 
				}
			});			
		})
	},
	
	setActive: function(id){
		if($('page-' + id)){
			$('page-' + id).setStyle('display', 'block');
		}
	}
})


var chartElements = new Class({
	initialize: function(){
		this.options = Object.extend({}, arguments[0] || {});
		this.translate = Object.extend({
			'piechart':'Pie chart',
			'colourscheme':'Colour scheme',
			'radius':'Pie chart radius',
			'orientation':'Bar chart orientation',
			'legend':'Show legend',
			'axis':'Chart axis label',
			'elements':'Chart Elements',
			'add':'add',
			'label':'Label',
			'fillgraph':'Fill line graph',
			'colour':'Colour'
		}, arguments[1] || {});
		

		this.duplicateRowClick = this.duplicateRow.bindAsEventListener(this);
		this.deleteRowClick = this.deleteRow.bindAsEventListener(this);
		this.addChartClick = this.addNewChart.bindAsEventListener(this);
		this.deleteChartClick = this.deleteChart.bindAsEventListener(this);
		this.watchDeleteRow();
		if( $('addChart') ){
			$('addChart').addEvent('click', this.addChartClick );
		}
	},
	
	watchDeleteChartElements: function(){
		$$('.delGraphEl').each(function(a){
			a.removeEvents('click');
		});
		$$('.delGraphEl').each(function(a){
			//a.addEvent('click', this.deleteRow);
			a.addEvent('click',this.deleteChartClick);
		}.bind(this));		
	},
	
	watchAddChartElements: function(){
		$$('.addGraphEl').each(function(a){
			a.removeEvent('click', this.duplicateRowClick);
		}.bind(this));
		$$('.addGraphEl').each(function(a){
			a.addEvent('click', this.duplicateRowClick);
		}.bind(this));
	},
	
	duplicateRow: function(event){
		var e = new Event(event);
		var x = e.target.getParent().getParent().getNext();
		var clone = x.clone().injectAfter(x);
		this.watchDeleteChartElements();
		e.stop();
	},
	
	deleteChart: function(event){
		e = new Event(event);
		var x = e.target.getParent().getParent().getParent().remove();
		e.stop();
	},
	
	deleteRow: function(e){
		new Event(e).stop();
		e.target.parentNode.parentNode.remove();
		
	},
	
	watchDeleteRow: function(e){
		$$('tr .deleteChartElement').each(function(d){
			d.addEvent('click', this.deleteRowClick);
		}.bind(this));
	},
	
	watchDeletCharts: function(e){
		$$('.delGraph').each(function(a){
			a.removeEvent('click', this.deleteChartClick);
		}.bind(this));
		$$('.deleteRow').each(function(a){
			a.addEvent(_buildOptions, this.deleteChartClick);
		}.bind(this));
	},
	
	addNewChart: function(e){
		this.addChart();
		e = new Event(e).stop();
	},
	
	addChart: function(chartlabel, chartType, colourScheme, radius, orientation, fill, legend, axisLabel, activeElements, colours ){
		chartlabel = chartlabel? chartlabel: '';
		chartType = chartType ? chartType : 'BarChart';
		colourScheme = colourScheme ? colourScheme : 'blue';
		radius = radius ? radius : '0.4';
		orientation = orientation ? orientation : 'vertical';
		legend = legend ? legend : '0';
		axisLabel = axisLabel ? axisLabel : '';
		activeElements = activeElements ? activeElements : [];
		colours = colours ? colours : [];
		fill = fill ? fill : '';
		
		var counter = $$('.aChart').length;
		var pieChartTd = new Element('td', {'colspan':'2'}).adopt(
		new Element('select', {
			'id':'paramsgraph_type_' + counter,
			'class':'inputbox',
			'name':'params[graph_type][]'}).adopt(this._buildOptions( this.options.aCharts, chartType ))
		);
		
		var colourSchemeTd = new Element('td', {'colspan':'2'}).adopt(
			new Element('select', {
				'id':'paramsgraph_colour_scheme_' + counter,'class':'inputbox','name':'params[graph_colour_scheme][]'
			}).adopt(this._buildOptions( this.options.aCols, colourScheme ))
		);
		
		var radiusTd = new Element('td', {'colspan':'2'}).adopt(
			new Element('input', {'id':'paramspie_radius[]_' + counter, 'class':'text_area', 'size':'5', 'name':'params[pie_radius][]', 'value':radius})
		);
		
		var labelTd = new Element('td').adopt(
			new Element('input', {'id':'paramschart_label[]_' + counter, 'class':'text_area', 'size':'15', 'name':'params[chart_label][]', 'value':chartlabel})
		); 

		var pieOrientTd = new Element('td', {'colspan':'2'}).adopt(
		new Element('select', {
			'id':'paramsbar_orientation' + counter,
			'class':'inputbox',
			'name':'params[bar_orientation][]'}).adopt(this._buildOptions( this.options.aOrient, orientation ))
		);

		var legendTd = new Element('td', {'colspan':'2'}).adopt(
		new Element('select', {
			'id':'paramsgraph_show_legend' + counter,
			'class':'inputbox',
			'name':'params[graph_show_legend][]'}).adopt(this._buildOptions( this.options.alegend, legend ))
		);
		
		var fillTd = new Element('td', {'colspan':'2'}).adopt(
		new Element('select', {
			'id':'paramsfill_line_graph' + counter,
			'class':'inputbox',
			'name':'params[fill_line_graph][]'}).adopt(this._buildOptions( this.options.fillLine, fill ))
		);
		
		var axisTd = new Element('td', {'colspan':'2'}).adopt(
			new Element('select', {
			'id':'paramschart_axis_label_' + counter,'class':'inputbox','name':'params[chart_axis_label][]'
			}).adopt(this._buildOptions( this.options.elements, axisLabel ))
		);
		
		var delTd = new Element('td').adopt(
			new Element('a', {'class':'delGraph','href':'#'}).appendText("[-]")
		);
		
		var rows = [
			new Element('tr').adopt([ new Element('td').appendText(this.translate.label), labelTd, delTd ]),
			new Element('tr').adopt([ new Element('td').appendText(this.translate.piechart), pieChartTd ]),
			new Element('tr').adopt([ new Element('td').appendText(this.translate.colourscheme), colourSchemeTd ]),
			new Element('tr').adopt([ new Element('td').appendText(this.translate.radius), radiusTd ]),
			new Element('tr').adopt([ new Element('td').appendText(this.translate.orientation), pieOrientTd ]),
			new Element('tr').adopt([ new Element('td').appendText(this.translate.legend), legendTd ]),
			new Element('tr').adopt([ new Element('td').appendText(this.translate.fillgraph), fillTd ]),
			new Element('tr').adopt([ new Element('td').appendText(this.translate.axis), axisTd ]),
			new Element('tr').adopt(new Element('td', {'colspan':'3'}).adopt(new Element('a', {'href':'#', 'class':'addGraphEl'}).appendText(this.translate.add)))
		];
		if(activeElements.length == 0){
			activeElements.push(this.options.elements_id[0][0] );
		}
		
		
		activeElements.each(function(el, elCounter){
			
			var elOpts = this._buildOptions( this.options.elements_id, el );
			var calcOpts = this._buildOptions( this.options.calc_id, el);
			elOpts.extend(calcOpts);
			
			var dd = new Element('td').adopt([
				new Element('select', {
				'id':'paramschart_chart_elements_' + counter,'class':'inputbox','name':'params[chart_elements]['+ counter + '][]'
				}).adopt( elOpts ),
				
				new Element('label', {'for':'paramschart_chart_elements_colour_' + counter}).adopt().appendText(this.translate.colour),
				new Element('input', {
					'id':'paramschart_chart_elements_colour_' + counter,'class':'inputbox','size':7,'name':'params[chart_elements_colour]['+ counter + '][]','value':colours[elCounter]}
				),
			new Element('a', {'class':'delGraphEl', 'href':'#'}).appendText('[-]')
			]
			);
			var tr = new Element('tr').adopt([ new Element('td').appendText(this.translate.fields),dd ]);
			rows.push(tr);
		}.bind(this));
		
		//$('chartContainer').adopt(new Element('table', {'class':'adminform aChart'}).adopt(rows))
		new Element('table', {'class':'adminform aChart'}).adopt(rows).injectInside($('chartContainer'))
		this.watchAddChartElements();
		this.watchDeleteChartElements();
		this.watchDeletCharts();
	},
	
	_buildOptions: function( data, sel ){
		var opts = [];
		data.each(function(o){
			if(o[0] == sel){
				opts.push( new Element('option', {'value':o[0], 'selected':'selected'}).appendText(o[1]) );
			}else{
				opts.push( new Element('option', {'value':o[0]}).appendText(o[1]) );
			}
		});
		return opts;	
	}
});


