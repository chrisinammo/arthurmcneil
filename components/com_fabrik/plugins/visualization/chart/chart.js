var fabrikGraph = new Class( {
	initialize: function(el, d){
		//todo doesnt seem to work with 1 record of data
		this.el =el;
		this.options = Object.extend({
			legend:       false,
			label: '',
			aChartKeys: {},
			axis_label: '',
			json: {}, 
			chartType: 'barChart',
			xticks:[]
			
		}, arguments[2] || {});
		
		this.json = d;

		window.addEvent('domready',function(e){
			this.render();
		}.bind(this))
	},
	
	render: function(){
		switch(this.options.chartType){
			case 'BarChart':
				this.graph = new Plotr.BarChart(this.el, this.options);
				break;
			case 'PieChart':
				this.graph = new Plotr.PieChart(this.el, this.options);
				break;
			case 'LineChart':
				this.graph = new Plotr.LineChart(this.el, this.options);
				break;
		}
		this.graph.addDataset(this.json);
		this.graph.render();
		if( this.options.legend == '1' ){
			this.graph.addLegend(this.el);
		} 
	}
});